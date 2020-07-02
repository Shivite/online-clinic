<?php

namespace App\Http\Controllers\Patient;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\PatientDetail;
use App\Department;
use File;
use Image;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Razorpay\Api\Api;

class PatientController extends Controller
{
    private $razorpayId= 'rzp_test_1z4vEE23O5vJ6R';
    private $razorpayKey= 'QQOe1YLieKNYPRwK4lL6x1fd' ;


    public function index( Request $request)
    {
        $patient = $request->session()->get('patient');
        return view('layouts.patient.registerpatient')->with('patient',$patient);
    }

   public function postResiterPatient(Request $request)
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

       if(empty($request->session()->get('patient'))){
           $patient = new PatientDetail();
           $patient->fill($validatedData);
           $request->session()->put('patient', $patient);
       }else{
           $patient = $request->session()->get('patient');
           $patient->fill($validatedData);
           $request->session()->put('patient', $patient);
       }
       return redirect('registration/department');

   }

   public function registerDepartment(Request $request)
    {
        $departments = Department::all();
        return view('layouts.patient.registerdepartment')->with(['departments' => $departments]);
    }

    public function postregisterDepartment(Request $request)
   {
       $patient = $request->session()->get('patient');
       $patient->disease = $request->diseaseId;
       $patient->department = $request->departmentId;
       $request->session()->put('patient', $patient);
       return response()->json([
         'success'=>true,
         'url'=> route('patient.reports', ['patient' => $patient ])
       ]);

   }
   public function registerReports( Request $request){
     $patient = $request->session()->get('patient');
     return view('layouts.patient.registerreports')->with(['patient' => $patient]);

   }

   public  function postRegisterReports(Request $request){
     $patient = $request->session()->get('patient');

     $request->validate([
       'uploadreport1' => 'image|mimes:jpeg,png,jpg |max:2048',
       'uploadreport2' => 'image|mimes:jpeg,png,jpg |max:2048',
       'uploadreport3' => 'image|mimes:jpeg,png,jpg |max:2048',
       'uploadreport4' => 'image|mimes:jpeg,png,jpg |max:2048',
       'uploadreport5' => 'image|mimes:jpeg,png,jpg |max:2048',
       'uploadreport6' => 'image|mimes:jpeg,png,jpg |max:2048',
       'uploadreport7' => 'image|mimes:jpeg,png,jpg |max:2048',
       'uploadreport8' => 'image|mimes:jpeg,png,jpg |max:2048',
       'uploadreport9' => 'image|mimes:jpeg,png,jpg |max:2048',
       'uploadreport10' => 'image|mimes:jpeg,png,jpg |max:2048',
    ]);
    if ($request->hasFile('uploadreport1')) $patient->uploadreport1 = $this->imageUpload($request->file('uploadreport1'), $patient);
    if ($request->hasFile('uploadreport2')) $patient->uploadreport2 = $this->imageUpload($request->file('uploadreport2'), $patient);
    if ($request->hasFile('uploadreport3')) $patient->uploadreport3 = $this->imageUpload($request->file('uploadreport3'), $patient);
    if ($request->hasFile('uploadreport4')) $patient->uploadreport4 = $this->imageUpload($request->file('uploadreport4'), $patient);
    if ($request->hasFile('uploadreport5')) $patient->uploadreport5 = $this->imageUpload($request->file('uploadreport5'), $patient);
    if ($request->hasFile('uploadreport6')) $patient->uploadreport6 = $this->imageUpload($request->file('uploadreport6'), $patient);
    if ($request->hasFile('uploadreport7')) $patient->uploadreport7 = $this->imageUpload($request->file('uploadreport7'), $patient);
    if ($request->hasFile('uploadreport8')) $patient->uploadreport8 = $this->imageUpload($request->file('uploadreport8'), $patient);
    if ($request->hasFile('uploadreport9')) $patient->uploadreport9 = $this->imageUpload($request->file('uploadreport9'), $patient);
    if ($request->hasFile('uploadreport10')) $patient->uploadreport10 = $this->imageUpload($request->file('uploadreport10'), $patient);
    $request->session()->put('patient', $patient);
    return view('layouts.patient.registerappintment')->with('patient', $patient);
   }



    public function postRegisterAppointment(Request $request)
    {

        $patient = $request->session()->get('patient');
        $patient->appointment = $request->appointment;
        $request->session()->put('patient', $patient);


        $api = new Api($this->razorpayId, $this->razorpayKey);
        $patient = $request->session()->get('patient');
        $department = Department::find($patient->department);
        $receiptId = Str::random(20);
        $order = $api->order->create(array(
          'receipt' => $receiptId,
          'amount' => $department->fee * 100,
          'currency' => 'INR'
          )
        );
        $response = [
                'orderId'=> $order['id'],
                'razorpayId' => $this->razorpayId,
                'amount' => $department->fee * 100,
                'name'=> $patient->name,
                'currency' => 'INR',
                'email' => $patient->email,
                'contactNumber' => $patient->number,
                'address' => $patient->address,
                'discription' => 'Appotment for ' .$department->name. 'Department!',
        ];
        return response()->json([
          'success'=>true,
          'values'=> $response,
        ]);
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

    public function imageUpload($img, $user )    {
        $number = mt_rand(1000000000, 9999999999);
        $folder = 'patient';
        $patientFolder = $user->email;
        if (isset($img))
        {
            $imgName = $number . '-' . time() . '.' . request()->uploadreport1->getClientOriginalExtension();
            if (!Storage::disk('public')
                ->exists($folder))
                  Storage::disk('public')->makeDirectory($folder);
            if (!Storage::disk('patient')
                ->exists($patientFolder))
                  Storage::disk('patient')->makeDirectory($patientFolder);
            $customImage = Image::make($img)->resize(150, 150)->save($imgName, 90);
            Storage::disk('patient')->put($patientFolder.'/'.  $imgName, $customImage);
        }
        else
        {
            $imgName = "doctor.png";
        }
        return $imgName;
    }

    public function razorPaymentComplete(Request $request){

      $_signatureStatus= $this->signatureVarify(  $request->rzp_paymentid,  $request->rzp_orderid,  $request->rzp_signature);

      if($_signatureStatus == true)
        return response()->json([
          'success'=>true,
          'url'=> route('payment.success')
        ]);
      else
        return response()->json([
          'success'=>false,
          'url'=> route('patient.fail')
        ]);
    }

    public function signatureVarify($pID, $oId, $sign){
      try{
        $api = new Api($this->razorpayId, $this->razorpayKey);
        $attributes  = array('razorpay_signature'  => $sign,  'razorpay_payment_id'  => $pID ,  'razorpay_order_id' => $oId);
        $order  = $api->utility->verifyPaymentSignature($attributes);
        return true;
      }
      catch(\Exception $e){
        return false;
      }
    }

}
