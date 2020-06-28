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
use App\Profile;
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

      return (!Auth::user()->hasRole(['admin'])) ? abort(404) : '';
        $users = $this->allUsersExceptAdmin();
        return view('layouts.admin.user.index')
            ->with('users', $users);
    }

    public function create()
    {
        return (!Auth::user()->hasRole(['admin'])) ? abort(404) : '';
        $roles = Role::where('name', '<>', 'admin')->get();
        $departments = Department::all();
        return view('layouts.admin.user.create')->with(['roles' => $roles, 'departments' => $departments]);

    }

    public function store(Request $request)
    {
        return (!Auth::user()->hasRole(['admin'])) ? abort(404) : '';
        $user = new User();
        $this->validate($request,[
          'name' => 'required',
          'email' => 'required|unique:users|max:255',
          'password' => ['required', 'string', 'min:8', 'confirmed'],
          // 'password' => ['required', 'string', 'min:8', 'confirmed', 'regex:/^(?!.*(\w){1,}).+$/'],
          'sign' => 'image|mimes:jpeg,bmp,png,jpg|max:2048',
        ]);
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $role = Role::find($request->role);
        $department = Department::find($request->department);
        if ($user->save())
        {
            $profile = new Profile;
            $profile->user_id = $user->id;
            $profile->save();
            $user->roles()
                ->attach($role);
            $user->departments()
                    ->attach($department);
            $user->profile()->save($profile);
            $users = $this->allUsersExceptAdmin();
            Toastr::success('User created Successfully :', 'Success');
            return view('layouts.admin.user.index')
                ->with('users', $users);
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
        return (!Auth::user()->hasRole(['admin'])) ? abort(404) : '';
        if (Gate::denies('edit-users')) return redirect(route('admin.users.index'));
        $roles = Role::where('name', '<>', 'admin')->get();
        return view('layouts.admin.user.edit')
            ->with(['user' => $user, 'roles' => $roles]);

    }

    public function update(Request $request, $id)
    {
      // dd($request->post());
      if (!Auth::user()->hasAnyRole(['admin'])){
        Toastr::error('Do not have access rights!', 'Error');
        return redirect()->back();
      }
      $this->validate($request,[
          'name' => 'required',
          'profile_pic' => 'image|mimes:jpeg,bmp,png,jpg|max:2048',
          'sign' => 'image|mimes:jpeg,bmp,png,jpg|max:2048',
      ]);
      if($user = User::find($id)){
            $user->name = $request->name;
            $profile = Profile::where('user_id', $user->id)->first();
            if ($request->hasFile('profile_pic')) $profile->profile_pic = $this->imageUpload($request->file('profile_pic'), $user);
            if ($request->hasFile('sign')) $profile->sign = $this->imageUpload($request->file('sign'), $user);
            $profile->specialization = $request->specialization;
            $profile->about = $request->about;
            if($user->save() && $profile->save()){
              $users = $this->allUsersExceptAdmin();
              Toastr::success('User updated Successfully :', 'Success');
              return view('layouts.admin.user.index')
                  ->with('users', $users);
            }
        }
        else{
          Toastr::error('Error in user update ! <br> Please Try later :', 'Error');
          return view('layouts.admin.user.index')
              ->with('users', $users);
        }


    }

    public function destroy(User $user)
    {
      if (!Auth::user()->hasRole(['admin'])){
        Toastr::error('Do not have access rights!', 'Error');
        return redirect()->back();
      }
        $imgRoot = $this->userRoleName($user);

        (Storage::disk('public')->exists($imgRoot.'/profile' . $user->profile->profile_pic) && $user->profile->profile_pic != 'doctor.png' ) ?  Storage::disk('public')->delete($imgRoot . $user->profile->profile_pic):'';

        (Storage::disk('public')->exists($imgRoot.'/profile' . $user->profile->sign) && $user->profile->sign!= 'sign.png' ) ?  Storage::disk('public')->delete($imgRoot . $user->profile->sign):'';
          $docId = $user->profile->id;
          echo "done";
          if($user->roles()->detach() && $user->profile()->delete() &&  $user->delete()){
            echo "deleted";
            Toastr::success('User Successfully Deleted !', 'Success');
          }

          else
              Toastr::error('Something went wrong please try after some time!', 'Error');
          return redirect()->back();
    }
    //custom function

    public function imageUpload($img, $user )    {
        $folder = $this->userRoleName($user);
        if (isset($img))
        {
            $imgName = uniqid() . '.' . $img->getClientOriginalExtension();
            if (!Storage::disk('public')
                ->exists($folder))
            {
                Storage::disk('public')
                    ->makeDirectory($folder);
            }
            $customImage = Image::make($img)->resize(150, 150)
                ->save($imgName, 90);
            Storage::disk('public')->put($folder.'/profile/' . $imgName, $customImage);
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

    public function userRoleName($user){
      if ($user->hasRole('admin')) $roleName = 'admin';
      if ($user->hasRole('doctor')) $roleName = 'doctor';
      if ($user->hasRole('staff')) $roleName = 'staff';
      if ($user->hasRole('patient')) $roleName = 'patient';
      return $roleName;
    }
}
