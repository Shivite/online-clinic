<?php
namespace App\Http\Controllers\Doctor;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use Illuminate\Support\Facades\Validator;
use App\User;
use App\Profile;
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
            $profile = Profile::where('user_id', $user->id)->first();
            if ($request->hasFile('profile_pic')) $profile->profile_pic = $this->imageUpload($request->file('profile_pic'), $user);
            if ($request->hasFile('sign')) $profile->sign = $this->imageUpload($request->file('sign'), $user);
            $profile->specialization = $request->specialization;
            $profile->about = $request->about;
            if($user->save() && $profile->save()){
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


}
