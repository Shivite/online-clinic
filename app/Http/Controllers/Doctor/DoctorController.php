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



    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
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
    public function edit($id)
    {
        if (!Auth::User()->hasRole('doctor')) redirect()->back();
        $user = User::findOrFail($id);
        return view('layouts.admin.doctor.edit')->with(['user'=>$user]);

    }



    public function update(Request $request, $id)
    {
      echo "update"; die;
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
          dd($doctor);
          dd($user);
        }
        return ($user->save() && $doctor->save() ) ? json_encode(array('response' => 200,'success' => "Doctor updated Successfully")) : json_encode(array('response' => 401, 'errors' => 'Something went wrong please try after some time!'));
    }







    public function destroy($id)
    {
        //
    }

    public function profile(){
        $user = (Auth::user()->hasRole('doctor')) ? Auth::user() : '';

        return view('layouts.admin.doctor.profile')->with('user', $user);
    }

    public function imageUpload($img){

       if (isset($img)) {
           $imgName = uniqid() . '.' . $img->getClientOriginalExtension();
           if (!Storage::disk('public')->exists('doctor')) {
               Storage::disk('public')->makeDirectory('doctor');
           }
           $customImage = Image::make($img)->resize(150, 150)->save($imgName, 90);
           Storage::disk('public')->put('doctor/' . $imgName, $customImage);
       } else {
           $imgName = "doctor.png";
       }
       return $imgName;
   }



}
