<?php

namespace App\Http\Controllers\Patient;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\PatientDetail;
class PatientController extends Controller
{
    public function index( Request $request)
    {
        $patient = $request->session()->get('patient');
        // dd($patient);
        return view('layouts.patient.registerpatient')->with('patient',$patient);
    }

    public function postCreateStep1(Request $request)
   {
        // dd($request->post());
       $validatedData = $request->validate([
            "title" => "required",
            "name" => "required",
            "number" => "required|min:10|numeric",
            "alt_number" => "min:10|numeric",
            // "password" => "required",
            "email" => "required|unique:users",
            "address" => "required",
            "pin" =>  "required|min:10|numeric",
            "legalgaurdian" =>  "required",
            "country" =>  "required",
            "dob" =>  "required",
            // "docname" =>  "required",
            "age" =>  "required",
            "gender" =>  "required",
            "language" =>  "required",
            "religion" =>  "required",
            "occupaton" =>  "required",
            "marital" =>  "required",
       ]);
       // dd($request->post());
       if(empty($request->session()->get('patient'))){
           $patient = new PatientDetail();
           $patient->fill($validatedData);
           $request->session()->put('patient', $patient);
       }else{
           $patient = $request->session()->get('patient');
           $patient->fill($validatedData);
           $request->session()->put('patient', $patient);
       }
       // dd($request->session());
       return redirect('/registration/create-step2');

   }

   public function createStep2(Request $request)
    {
        $patient = $request->session()->get('patient');
        return view('layouts.patient.create-step2',compact('patient', $patient));
    }

    public function postCreateStep2(Request $request)
   {
       $patient = $patient->session()->get('patient');
       if(!isset($patient->photo)) {
           $request->validate([
               'photo' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
           ]);

           $fileName = "productImage-" . time() . '.' . request()->photo->getClientOriginalExtension();

           $request->photo->storeAs('photo', $fileName);

           $patient = $request->session()->get('patient');

           $patient->photo = $fileName;
           $request->session()->put('patient', $patient);
       }
       return redirect('/registration/create-step3');

   }

   public function removeImage(Request $request)
    {
        $patient = $request->session()->get('patient');
        $patient->photo = null;
        return view('patient.create-step2',compact('patient', $patient));
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
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
