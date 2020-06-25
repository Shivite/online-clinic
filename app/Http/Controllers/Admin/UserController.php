<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;

use Auth;
use Gate;
use File;
use Image;
use App\User;
use App\Role;
use App\Doctor;
use App\Department;
use Session;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{

    public function _construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $users = $this->allUsersExceptAdmin();
        return view('layouts.admin.user.index')
            ->with('users', $users);
    }

    public function create()
    {
        $roles = Role::where('name', '<>', 'admin')->get();
        $departments = Department::all();
        return view('layouts.admin.user.create')->with(['roles' => $roles, 'departments' => $departments]);

    }

    public function store(Request $request)
    {
        $user = new User();
        $this->validate($request,[
          'name' => 'required',
          'email' => 'required|unique:users|max:255',
          'password' => ['required', 'string', 'min:8', 'confirmed', 'regex:/^(?!.*(\w){1,}).+$/'],
          'sign' => 'image|mimes:jpeg,bmp,png,jpg|max:2048',
        ]);

        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $role = Role::find($request->role);
        if ($user->save())
        {
            $user->roles()
                ->attach($role);
            if ($user->hasRole('doctor'))
            {
                $doctor = new Doctor();
                $doctor->user_id = $user->id;
                $doctor->department_id = $request->department;
                $doctor->save();
                $users = $this->allUsersExceptAdmin();
                Toastr::success('User created Successfully :', 'Success');
                return view('layouts.admin.user.index')
                    ->with('users', $users);
            }
        }
        else{
          Toastr::error('Error in user creation ! <br> Please Try later :', 'Error');
          return view('layouts.admin.user.index')
              ->with('users', $users);
        }
    }
    public function show($id)
    {
        //

    }

    public function edit(user $user)
    {
        if (Gate::denies('edit-users')) return redirect(route('admin.users.index'));
        $roles = Role::where('name', '<>', 'admin')->get();
        return view('layouts.admin.user.edit')
            ->with(['user' => $user, 'roles' => $roles]);

    }

    public function update(Request $request, $id)
    {
        $this->validate($request,[
          'name' => 'required',
          'email' => 'required|max:255',
          'profile_pic' => 'image|mimes:jpeg,bmp,png,jpg|max:2048',
          'sign' => 'image|mimes:jpeg,bmp,png,jpg|max:2048',
        ]);

        $user = User::find($id);
        $user->name = $request->name;
        $user->email = $request->email;

        if ($user->hasRole('doctor'))
        {
            $doctor = Doctor::where('user_id', $user->id)
                ->first();

            if ($request->hasFile('profile_pic')) $doctor->profile_pic = $this->imageUpload($request->file('profile_pic'));
            if ($request->hasFile('sign')) $doctor->sign = $this->imageUpload($request->file('sign'));

            $doctor->specialization = $request->specialization;
            $doctor->about = $request->about;
        }
        if($user->save() && $doctor->save()){
          $users = $this->allUsersExceptAdmin();
          Toastr::success('User updated Successfully :', 'Success');
          return view('layouts.admin.user.index')
              ->with('users', $users);
        }

    }
    public function destroy(User $user)
    {
        $imgRoot = ($user->hasRole('doctor')) ? 'doctor/profile' : 'patient/profile';

        (Storage::disk('public')->exists($imgRoot . $user->doctor->profile_pic) && $user->doctor->profile_pic!= 'doctor.png' ) ?  Storage::disk('public')->delete($imgRoot . $user->doctor->profile_pic):'';

        (Storage::disk('public')->exists($imgRoot . $user->doctor->sign) && $user->doctor->sign!= 'sign.png' ) ?  Storage::disk('public')->delete($imgRoot . $user->doctor->sign):'';
          $docId = $user->doctor->id;;
          if($user->doctor()->delete() && $user->roles()->detach() && $user->delete())
              Toastr::success('User Successfully Deleted !', 'Success');
          else
              Toastr::error('Something went wrong please try after some time!', 'Error');
          return redirect()->back();
    }
    //custom function
  
    public function imageUpload($img)
    {
        if (isset($img))
        {
            $imgName = uniqid() . '.' . $img->getClientOriginalExtension();
            if (!Storage::disk('public')
                ->exists('doctor/profile'))
            {
                Storage::disk('public')
                    ->makeDirectory('doctor/profile');
            }
            $customImage = Image::make($img)->resize(150, 150)
                ->save($imgName, 90);
            Storage::disk('public')->put('doctor/profile/' . $imgName, $customImage);
        }
        else
        {
            $imgName = "doctor.png";
        }
        return $imgName;
    }

    public function allUsersExceptAdmin()
    {
        return $users = User::whereHas('roles', function ($q)
        {
            $q->where('name', '<>', 'admin');
        })
            ->get();
    }

}
