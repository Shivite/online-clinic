<?php
namespace App\Http\Controllers\Doctor;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use Illuminate\Support\Facades\Validator;
use App\User;
use App\Doctor;
use File;
use Image;
use Illuminate\Support\Facades\Storage;

use Brian2694\Toastr\Facades\Toastr;

class DoctorController extends Controller
{



    public function index()
    {
        //
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        //
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
      if(!Auth::user()->hasRole('doctor')) return abort(404);
        $user = User::findOrFail($id);
        return view('layouts.admin.doctor.edit')->with(['user'=>$user]);
    }

    public function update(Request $request, $id)
    {
      if(!Auth::user()->hasRole('doctor')) return abort(404);
      $this->validate($request,[
        'name' => 'required',
        'profile_pic' => 'image|mimes:jpeg,bmp,png,jpg|max:2048',
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
              Toastr::success('User updated Successfully :', 'Success');
              return view('layouts.admin.doctor.profile')->with('user', $user);            }
        }
        else{
          Toastr::error('Error in user update ! <br> Please Try later :', 'Error');
          return view('layouts.admin.user.index')
              ->with('users', $users);
        }

    }







    public function destroy($id)
    {
        //
    }

    public function profile(){
        $user = (Auth::user()->hasRole('doctor')) ? Auth::user() : '';
        return view('layouts.admin.doctor.profile')->with('user', $user);
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


        public function userRoleName($user){
          if ($user->hasRole('admin')) $roleName = 'admin';
          if ($user->hasRole('doctor')) $roleName = 'doctor';
          if ($user->hasRole('staff')) $roleName = 'staff';
          if ($user->hasRole('patient')) $roleName = 'patient';
          return $roleName;
        }

}
