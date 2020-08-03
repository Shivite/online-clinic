<?php
namespace App\Http\Controllers\Patient;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Patient;
use App\Department;
use App\Report;
use App\Payment;
use App\Appointment;
use App\Priscription;

use File;
use Image;
   use Auth;
use Illuminate\Support\Facades\Storage;

use Illuminate\Support\Str;
use Razorpay\Api\Api;
use App\User;
use App\Role;
use Carbon\Carbon;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Brian2694\Toastr\Facades\Toastr;  
use Illuminate\Foundation\Auth\RegistersUsers;
class PatientController extends Controller
{
    public function __construct()  {
      $this->middleware('auth', ['only' => 'profie']);
    } 

    private $razorpayId= 'rzp_test_1z4vEE23O5vJ6R';
    private $razorpayKey= 'QQOe1YLieKNYPRwK4lL6x1fd' ;

    /*get available time slots starts */

    public function postRegisterGetAppointmentTimeSlots(Request $request){
        $patient = $request->session()->get('patient');
      /* get the doctor list with the selected department */
      $selectedDate = $request->appointment;
      $departmentUsers = Department::find($patient->department)->users()->get();
      $deptDocIds = [];
      foreach($departmentUsers as $deptUser){
          if(!empty($deptUser->doctor))
            array_push($deptDocIds, $deptUser->doctor->id);
      }
      if(empty($deptDocIds)){
        return response()->json(array('success' => false, 'error' => "Doctor assignment failed!"));  
      }

      foreach($deptDocIds as $deptDocId){
        $timeSlots = array('08:30','09:00','09:30','10:00','10:30','11:00','11:30','12:00','12:30','13:00','13:30',
        '14:00','14:30','15:00','15:30','16:00','16:30','17:00','17:30','18:00','18:30','19:00','19:30','20:00','20:30');
        $app = Appointment::select('doctor_id', 'start_time')
            ->where('doctor_id', $deptDocId )
            ->where('date', '=',$selectedDate)
            ->get()->toArray();
            foreach($app as $ap){
              if($index = array_search($ap['start_time'], $timeSlots)){
                unset($timeSlots[$index]);
              }
            }
            $doctorWiseAvailabilty[$deptDocId] = $timeSlots ;
      }
      $availableTimeSlots = array_unique(call_user_func_array('array_merge', $doctorWiseAvailabilty));
      asort($availableTimeSlots);
      $returnHTML = view('layouts.patient.time-slots')->with('availableTimeSlots', $availableTimeSlots)->render();
      return response()->json(array('success' => true, 'html'=>$returnHTML));
    }
    /*get available timeslot end*/

    /*book/appoint doctor to patient start*/

    /*generate order */
    public function postRegisterAppointment(Request $request){
      // dd($request->post());
      $validatedData = $request->validate([
            "appointmentDate" => "required",
            "appointmentTime" => "required",
       ]);
        $patient = $request->session()->get('patient');
        $patient->appointmentDate =  $request->appointmentDate;
        $patient->appointmentTime = $request->appointmentTime;
        
        $department = Department::find($patient->department);
        $request->session()->put('patient', $patient);
        
        /*api call for generate order and payment screen*/
        $api = new Api($this->razorpayId, $this->razorpayKey);
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
    /*end generating order*/

    /*book/appoint doctor to patient ends*/
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
            "altnumber" => "min:10|numeric",
            "password" => "required",
            "email" => "required|unique:users",
            "address" => "required",
            "pin" =>  "required|numeric",
            "legalgaurdian" =>  "required",
            "country" =>  "required",
            "state" =>  "required",
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


   /*
    public function postRegisterAppointment1(Request $request)
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
    */

   public function removeImage(Request $request)
    {
        $patient = $request->session()->get('patient');
        $patient->photo = null;
        return view('patient.create-step2',compact('patient', $patient));
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
            $customImage = Image::make($img)->save($imgName, 90);
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
      $newPatient->alt_number   =     $patient->altnumber     ;
      $newPatient->email    =     $patient->email     ;
      $newPatient->address    =     $patient->address     ;
      $newPatient->pin    =     $patient->pin     ;
      $newPatient->legalgaurdian    =     $patient->legalgaurdian     ;
      $newPatient->country    =     $patient->country     ;
      $newPatient->state    =     $patient->state     ;
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
          /*payment create first*/$payment = new Payment;
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
          /*payment create end*/
          $newPatient->user_id    =     $user->id;
          $user->departments()->attach($department);
          if($user->patient()->save($newPatient)){
              /*appointment insert*/
              $departmentUsers = Department::find($patient->department)->users()->get();
              $deptDocIds = [];
              foreach($departmentUsers as $deptUser){
                  if(!empty($deptUser->doctor))
                    array_push($deptDocIds, $deptUser->doctor->id);
              }
                // echo "<pre> dep doc-id"; print_r($deptDocIds);
              
              foreach($deptDocIds as $deptDocId){
                $freeTimeslot = Appointment::where('doctor_id', $deptDocId)
                ->where('start_time', $patient->appointmentTime)
                ->whereDay('date', '=', date("d", strtotime($patient->appointmentDate)))
                ->get()->toArray();
                if(empty($freeTimeslot)){
                  $appointment = new Appointment;
                  $appointment->patient_id = $newPatient->id;
                  $appointment->doctor_id = $deptDocId;
                  $appointment->patient_id = '1';
                  $appointment->date = date("Y-m-d", strtotime($patient->appointmentDate));
                  $appointment->start_time = $patient->appointmentTime;
                  $appointment->isBooked = "yes";
                  $appointment->isCancelled = 0;
                  if($appointment->Save()) break;
                }
                else{
                  Toastr::info('Success Response Our Team Will Contact You Soon!:', 'Success');
                }
              }//foreach end
              /*appointment insert end*/
            if(!empty($patient->reports)){
              foreach($patient->reports as $key => $value){
                $report = new Report;
                $report->report = $value;
                $report->save();
                $newPatient->reports()->attach($report);
              }
            }///!empty reprts check end
            $user->sendEmailVerificationNotification();
 
          }
      }
        
        return true;
    }/*registration process ends here*/

      public function registerComplete( Request $request){
        return view('layouts.patient.paymentsuccess');
      }

      public function registerFailure( Request $request){
        return view('layouts.patient.paymentfailure');
      }


      public function profile()
      {

        if(!Auth::user()->hasRole('patient')) return abort(404);
        $patient = Auth::user()->patient;
        $prescriptions = Priscription::select('priscriptions.*', 'users.name as doctorName', 'users.email as doctorEmail', 'doctors.sign as doctorSignature', 'doctors.specialization as doctorSpecialization')
            ->leftJoin('doctors', 'doctors.id', '=', 'priscriptions.doctor_id')
            ->leftJoin('users', 'users.id', '=', 'doctors.user_id')
            ->where('priscriptions.patient_id', $patient->id)
            ->get();

         $appointments = Appointment::where('patient_id',$patient->id)
        ->whereDate('date', '=', Carbon::today()->toDateString())
        ->where('status', '<>', 'success')
        ->get();
    
        return view('layouts.admin.patient.profile')->with(compact('patient','prescriptions','appointments'));
      }



      
}