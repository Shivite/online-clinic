<?php

namespace App\Http\Controllers\Patient;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Patient;
use App\Department;
use App\Report;
use App\Payment;
use File;
use Image;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Razorpay\Api\Api;
use App\User;
use App\Role;
use Carbon\Carbon;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Foundation\Auth\RegistersUsers;
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
     // echo "here"; die;
       $validatedData = $request->validate([
            "title" => "required",
            "name" => "required",
            "number" => "required|min:10|numeric",
            "alt_number" => "min:10|numeric",
            "password" => "required",
            "email" => "required|unique:users",
            "address" => "required",
            "pin" =>  "required|min:10|numeric",
            "legalgaurdian" =>  "required",
            "country" =>  "required",
            "dob" =>  "required",
            "docname" =>  "",
            "age" =>  "required",
            "gender" =>  "required",
            "language" =>  "required",
            "religion" =>  "required",
            "occupaton" =>  "required",
            "marital" =>  "required",
            'photo' => 'required |image|mimes:jpeg,png,jpg |max:2048 ',
            'proof' => 'required |image|mimes:jpeg,png,jpg  |max:2048 ',
       ]);

      if ($request->hasFile('photo')) $validatedData['photo'] = $this->imageUpload($request->file('photo'), 'profile', 'photo' );
      if ($request->hasFile('proof')) $validatedData['proof'] = $this->imageUpload($request->file('proof'), 'profile', 'proof');

       if(empty($request->session()->get('patient'))){
           $patient = new Patient();
           $patient->fill($validatedData);
           $patient->hashPassword = Hash::make($patient->password);
           $request->session()->put('patient', $patient);
       }else{
           $patient = $request->session()->get('patient');
           $patient->fill($validatedData);
           $patient->hashPassword = Hash::make($patient->password);
           $request->session()->put('patient', $patient);
       }
       // dd($patient);
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
    $report = array();
    if ($request->hasFile('uploadreport1')) $report["uploadreport1"] = $this->imageUpload($request->file('uploadreport1'), $patient, 'uploadreport1');
    if ($request->hasFile('uploadreport2')) $report["uploadreport2"] = $this->imageUpload($request->file('uploadreport2'), $patient, 'uploadreport2');
    if ($request->hasFile('uploadreport3')) $report["uploadreport3"] = $this->imageUpload($request->file('uploadreport3'), $patient, 'uploadreport3');
    if ($request->hasFile('uploadreport4')) $report["uploadreport4"] = $this->imageUpload($request->file('uploadreport4'), $patient, 'uploadreport4');
    if ($request->hasFile('uploadreport5')) $report["uploadreport5"] = $this->imageUpload($request->file('uploadreport5'), $patient, 'uploadreport5');
    if ($request->hasFile('uploadreport6')) $report["uploadreport6"] = $this->imageUpload($request->file('uploadreport6'), $patient, 'uploadreport6');
    if ($request->hasFile('uploadreport7')) $report["uploadreport7"] = $this->imageUpload($request->file('uploadreport7'), $patient, 'uploadreport7');
    if ($request->hasFile('uploadreport8')) $report["uploadreport8"] = $this->imageUpload($request->file('uploadreport8'), $patient, 'uploadreport8');
    if ($request->hasFile('uploadreport9')) $report["uploadreport9"] = $this->imageUpload($request->file('uploadreport9'), $patient, 'uploadreport9');
    if ($request->hasFile('uploadreport10')) $report["uploadreport10"] = $this->imageUpload($request->file('uploadreport10'), $patient, 'uploadreport10');
    $patient->reports = $report;
    $request->session()->put('patient', $patient);
    return view('layouts.patient.registerappintment')->with('patient', $patient);
   }



    public function postRegisterAppointment(Request $request)
    {

        $patient = $request->session()->get('patient');
        $patient->appointment = $request->appointment;

        $api = new Api($this->razorpayId, $this->razorpayKey);

        $department = Department::find($patient->department);

        $receiptId = Str::random(20);
        $order = $api->order->create(array(
          'receipt' => $receiptId,
          'amount' => ($department->fee * 100),
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
    }

    public function update(Request $request, $id)
    {
        //
    }


    public function destroy($id)
    {
        //
    }

    public function imageUpload($img, $user, $name )    {
      $patientFolder = ($user == 'profile') ? $user : $user->email;;
        $number = mt_rand(1000000000, 9999999999);
        $folder = 'patient';
        if (isset($img))
        {
            $imgName = $number . '-' . time() . '.' . request()->$name->getClientOriginalExtension();
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
      // echo "<pre>"; print_r($request->post());
      $order = array();
      $order['rzp_paymentid'] = $request->rzp_paymentid;
      $order['rzp_orderid'] = $request->rzp_orderid ;
      $order['rzp_signature'] = $request->rzp_signature ;
      $order['_token'] = $request->_token ;
      $order['description'] = $request->description ;
      $order['description'] = $request->description ;
      $order['email'] = $request->email ;
      $order['contactNumber'] = $request->contactNumber ;
      $order['description'] = $request->description ;
      $order['amount'] = $request->amount ;

      $patient = $request->session()->get('patient');

       $_signatureStatus= $this->signatureVarify(  $request->rzp_paymentid,  $request->rzp_orderid,  $request->rzp_signature);

      if($_signatureStatus == true){
        $patientregister = $this->patientRegister($patient, $order);
        if($patientregister){
          $request->session()->forget('patient');
          unset($patient);
          unset($order);
          return response()->json([
            'success'=>true,
            'url'=> route('payment.success')
          ]);
        }

      }

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

    protected function patientRegister($patient,  $order){
      $dob = new \DateTime($patient->dob);;
      $dob = $dob->format('Y-m-d H:i:s');
      $user = new User;
      $user->name = $patient->name;
      $user->email = $patient->email;
      $user->password = $patient->hashPassword;
      $role = Role::where('name', 'patient')->get();
      $department = Department::find($patient->department);
      $newPatient = new Patient;
      $newPatient->title = $patient->title;
      $newPatient->name  =      $patient->name     ;
      $newPatient->number   =     $patient->number     ;
      $newPatient->email    =     $patient->email     ;
      $newPatient->address    =     $patient->address     ;
      $newPatient->pin    =     $patient->pin     ;
      $newPatient->legalgaurdian    =     $patient->legalgaurdian     ;
      $newPatient->country    =     $patient->country     ;
      $newPatient->dob    =     $dob;
      $newPatient->docname    =     $patient->docname     ;
      $newPatient->age    =     $patient->age     ;
      $newPatient->gender   =     $patient->gender     ;
      $newPatient->language   =     $patient->language     ;
      $newPatient->religion   =     $patient->religion     ;
      $newPatient->occupaton    =     $patient->occupaton     ;
      $newPatient->marital    =     $patient->marital     ;
      $newPatient->photo    =     $patient->photo      ;
      $newPatient->proof    =     $patient->proof     ;
      if ($user->save())
      {
          $user->roles()->attach($role);

          // $user = User::find(2);
          $newPatient->user_id    =     $user->id;

          $user->patient()->save($newPatient);
          $user->departments()->attach($department);
          if(!empty($patient->reports)){
          foreach($patient->reports as $key => $value){
            $report = new Report;
            $report->report = $value;
            $report->save();
            $newPatient->reports()->attach($report);
          }}
          $user->sendEmailVerificationNotification();
        }
        // dd($order['contactNumber']);
        $payment = new Payment;
        $payment->contact = $order['contactNumber'] ;
        $payment->email = $order['email'] ;
        $payment->amount = $order['amount'] ;
        $payment->rzp_paymentid = $order['rzp_paymentid'] ;
        $payment->rzp_orderid = $order['rzp_orderid'] ;
        $payment->rzp_signature = $order['rzp_signature'] ;
        $payment->token = $order['_token'] ;
        $payment->description = $order['description'] ;
        $payment->save();
        $user->payments()->attach($payment);
        return true;
      }

      public function registerComplete( Request $request){
        return view('layouts.patient.paymentsuccess');
      }

      public function registerFailure( Request $request){
        return view('layouts.patient.paymentfailure');
      }
}
