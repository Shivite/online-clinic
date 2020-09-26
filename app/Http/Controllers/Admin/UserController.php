<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use DB;
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

    public function index() //list all patient and doctor
    {

      if (!Auth::user()->hasAnyRole(['admin','staff'])) return  abort(404) ;
        $users = $this->allDoctorsUsers();
        // dd($users);
        return view('layouts.admin.user.index')
            ->with('users', $users);
    }

    public function create()
    {
      // echo "here"; die;
      if (!Auth::user()->hasRole(['admin'])) return  abort(404) ;
        $roles = Role::where('name','doctor')->get();
        $departments = Department::all();
        return view('layouts.admin.user.create')->with(['roles' => $roles, 'departments' => $departments]);

    }

    public function store(Request $request)
    {
      if (!Auth::user()->hasRole(['admin'])) return  abort(404) ;

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
            // $user = User::find(6);
            $user->roles()->attach($role);
            if($role->name == 'doctor')
              $doctor = new Doctor;
            $doctor->user_id = $user->id;
            $user->departments()
                    ->attach($department);
            $user->doctor()->save($doctor);
            $users = $this->allDoctors();
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
        if (!Auth::user()->hasRole(['admin']))  return abort(404);
        if (Gate::denies('edit-users')) return redirect(route('admin.users.index'));
        $roles = Role::where('name', '<>', 'admin')->get();
        return view('layouts.admin.user.edit')
            ->with(['user' => $user, 'roles' => $roles]);

    }

    public function update(Request $request, $id)
    {
      // dd($request->post());
      if (!Auth::user()->hasAnyRole(['admin','doctor'])){
        Toastr::error('Do not have access rights!', 'Error');
        return redirect()->back();
      }
      // dd($request->file());
      $this->validate($request,[
          'name' => 'required',
          'profile->pic' => 'image|mimes:jpeg,bmp,png,jpg|max:2048',
          'sign' => 'image|mimes:jpeg,bmp,png,jpg|max:2048',
      ]);
      if($user = User::find($id)){
            $user->name = $request->name;
            $doctor = Doctor::where('user_id', $user->id)->first();
            if ($request->hasFile('profile_pic')) $doctor->profile_pic = $this->imageUpload($request->file('profile_pic'), $user);
            if ($request->hasFile('sign')) $doctor->sign = $this->imageUpload($request->file('sign'), $user);
            $doctor->specialization = $request->specialization;
            $doctor->about = $request->about;
            if($user->save() && $doctor->save()){
              $users = $this->allDoctors();
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
        if($imgRoot == 'doctor'){
          (Storage::disk('public')->exists($imgRoot.'/doctor' . $user->doctor->profile_pic) && $user->doctor->poctor_pic != 'doctor.png' ) ?  Storage::disk('doctor')->delete($imgRoot . $user->Doctor->Doctor_pic):'';
          (Storage::disk('public')->exists($imgRoot.'/doctor' . $user->doctor->sign) && $user->doctor->sign!= 'sign.png' ) ?  Storage::disk('public')->delete($imgRoot . $user->doctor->sign):'';
          $docId = $user->Doctor->id;
          if($user->Doctor()->delete() && $user->roles()->detach() &&   $user->delete())
            Toastr::success('Doctor Successfully Deleted !', 'Success');
            else
                Toastr::error('Something went wrong please try after some time!', 'Error');
        }
        // dd($user->patient);
        if($imgRoot == 'patient'){
          //folder wise deletion
          if(Storage::disk('patient')->exists($user->email)){
              Storage::disk('patient')->deleteDirectory($user->email);
          }
          //photo delete
          if(Storage::disk('patient')->exists('profile/'. $user->patient->photo) &&         $user->patient->photo != 'patient.png' )
              Storage::disk('patient')->delete( 'profile/'.$user->patient->photo);
          //profile delete
          if(Storage::disk('patient')->exists('profile/'. $user->patient->proof) &&         $user->patient->proof != 'proof.png' )
              Storage::disk('patient')->delete( 'profile/'.$user->patient->proof);


        if($user->patient->delete() &&   $user->roles()->detach() &&  $user->delete())
            Toastr::success('Patient Successfully Deleted !', 'Success');
        else
            Toastr::error('Something went wrong please try after some time!', 'Error');
        }

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
            Storage::disk('public')->put($folder.'/profile/'. $imgName, $customImage);
        }
        else
        {
            $imgName = "doctor.png";
        }
        return $imgName;
    }

      public function allDoctors()
      {
          return $users = User::whereHas('roles', function ($q)
          {
              $q->where('name',  'doctor');
          })
              ->get();
      }
    public function allDoctorsUsers(){
        return DB::table('doctors')
                ->select('users.*','departments.name as departmentName')
                ->join('users','users.id','=','doctors.user_id')
                ->join('department_user', 'department_user.user_id','=','users.id')
                ->join('departments', 'departments.id','=','department_user.department_id')

                
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