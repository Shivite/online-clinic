<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use Gate;
use File;
use Image;
use App\User;
use App\Role;
use App\Doctor;
use App\Department;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Brian2694\Toastr\Facades\Toastr;
class UserController extends Controller
{

  public function _construct(){
    $this->middleware('auth');
  }

  protected function validator(array $data)
  {
    return $validator = Validator::make($data, $this->rules($data));
  }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::whereHas('roles', function($q)
        {
            $q->where('name', '<>' ,'admin');
        })->get();

        return view('layouts.admin.user.index')->with('users',$users);
    }

    public function create()
    {
        $roles = Role::where('name', '<>' ,'admin')->get();
        $departments = Department::all();

        return view('layouts.admin.user.create')->with(['roles'=>$roles, 'departments' => $departments]);

    }



    public function store(Request $request)
    {
          $user = new User();
          // dd($request->post());
          $optionalInputs       =     array('_token');
          $validator = Validator::make($request->all(), $this->rules($request, $optionalInputs));
          if ($validator->fails()) {
               $errors     = $validator->errors();
               return json_encode(array('response' => 400, 'errors' => $errors));
          }
          $user->name= $request->name;
          $user->email= $request->email;
          $user->password= Hash::make($request->password);
          $role = Role::find($request->role);
          if($user->save()){
            $user->roles()->attach($role);
            if($user->hasRole('doctor')){
              $doctor = new Doctor();
              $doctor->user_id= $user->id;
              $doctor->department_id= $request->department;
              $doctor->save();
            }
            return json_encode(array('response' => 200,'success' => "User created Successfully"));
          }
          else return json_encode(array('response' => 401, 'errors' => 'Something went wrong please try after some time!'));
    }
    public function show($id)
    {
        //
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(user $user)
    {
        if(Gate::denies('edit-users')) return redirect(route('admin.users.index'));
        $roles = Role::where('name', '<>', 'admin')->get();
        return view('layouts.admin.user.edit')->with(['user'=>$user,'roles'=>$roles]);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
      $rules = array(
          'name' => 'required',
          'email' => 'required|max:255',
          'profile_pic' => 'image|mimes:jpeg,bmp,png,jpg|max:2048',
          'sign' => 'image|mimes:jpeg,bmp,png,jpg|max:2048',
      );
      $validator = Validator::make($request->all(), $rules);
      if ($validator->fails()) {
            $errors           =     $validator->errors();
            return json_encode(array('response' => 400, 'errors' => $errors));
      }
      $user =  User::find($id);
      $user->name = $request->name;
      $user->email = $request->email;


      if($user->hasRole('doctor')){
        $doctor = Doctor::where('user_id', $user->id)->first();

        if($request->hasFile('profile_pic'))
            $doctor->profile_pic = $this->imageUpload($request->file('profile_pic'));
        if($request->hasFile('sign'))
            $doctor->sign = $this->imageUpload($request->file('sign'));

        $doctor->specialization = $request->specialization;
        $doctor->about = $request->about;
        // dd($doctor);
        // dd($user);
      }
      return ($user->save() && $doctor->save())? json_encode(array('response' => 200,'success' => "User updated Successfully")) : json_encode(array('response' => 401, 'errors' => 'Something went wrong please try after some time!'));
    }

    public function passwordUpdate( Request $request, User $user){
        $optionalInputs       =     array('_token');
        $validator = Validator::make($request->all(), $this->rules($request, $optionalInputs));
        if ($validator->fails()) {
            $errors           =     $validator->errors();
            return json_encode(array('response' => 400, 'errors' => $errors));
        }
        if (!(Hash::check($request->old_password, Auth::user()->password))) {
            return json_encode(array('response' => 400,'errors' => "Old password does not matched"));
        }

        if(strcmp($request->old_password, $request->password) == 0){
            return json_encode(array('response' => 400,'error' => "New Password cannot be same as your current password"));
        }
        $user = Auth::user();
        $user->password = Hash::make($request->password);
        if($user->save()){
            return json_encode(array('response' => 200,'success' => "Password udpated Successfully"));
        }else{
        return json_encod(array('response' => 400));
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {

        $imgRoot = ($user->hasRole('doctor')) ? 'doctor/profile' : 'patient/profile';


        (Storage::disk('public')->exists($imgRoot . $user->doctor->profile_pic) && $user->doctor->profile_pic!= 'doctor.png' ) ?  Storage::disk('public')->delete($imgRoot . $user->doctor->profile_pic):'';

        (Storage::disk('public')->exists($imgRoot . $user->doctor->sign) && $user->doctor->sign!= 'sign.png' ) ?  Storage::disk('public')->delete($imgRoot . $user->doctor->sign):'';
         $docId = $user->doctor->id;;

        $user->doctor()->delete();
        $user->roles()->detach();
        $user->delete();
        

        Toastr::success('User Successfully Deleted !', 'Success');
        return redirect()->back();
    }
    //custom function

    public function rules($request, $optionalInputs)
    {
        $inputs = array();
        foreach($request->post() as $key => $val){
          if(in_array($key, $optionalInputs)) continue;
          $inputs[$key] = 'required';
          if($key == 'password')
          $inputs[$key] .= '|confirmed';
        }
        if($request->hasFile('image'))
            $inputs['image'] = 'required|image|mimes:jpeg,bmp,png,jpg';
        return $inputs;
    }


        public function imageUpload($img){
           if (isset($img)) {
               $imgName = uniqid() . '.' . $img->getClientOriginalExtension();
               if (!Storage::disk('public')->exists('doctor/profile')) {
                   Storage::disk('public')->makeDirectory('doctor/profile');
               }
               $customImage = Image::make($img)->resize(150, 150)->save($imgName, 90);
               Storage::disk('public')->put('doctor/profile/' . $imgName, $customImage);
           } else {
               $imgName = "doctor.png";
           }
           return $imgName;
       }




}
