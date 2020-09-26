<?php
namespace App\Http\Controllers\Doctor;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use Illuminate\Support\Facades\Validator;
use App\User;
use App\Doctor;
use App\Patient;
use App\Department;
use App\Appointment;
use App\Priscription;
use File;
use DB;
use Image;
use Mail;
use PDF;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;
use App\Mail\sendPrescriptionMail;
use Brian2694\Toastr\Facades\Toastr;

class DoctorController extends Controller
{

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
              return redirect()->back();
            }
        }
        else{
          Toastr::error('Error in user update ! <br> Please Try later :', 'Error');
          return redirect()->back();
        }

    }

    public function profile(){
        $user = (Auth::user()->hasRole('doctor')) ? Auth::user() : '';
        $appointments = [];
        $fromDate = Carbon::now()->subDay()->startOfWeek()->toDateString(); // or ->format(..)
        $tillDate = Carbon::now()->subDay()->endOfWeek()->toDateString();
        $appointments['today'] = Appointment::select('patients.name','appointments.*')
            ->join('patients', 'appointments.patient_id', '=','patients.id')
            ->where('appointments.doctor_id', $user->doctor->id)
            ->whereDate('appointments.date', '=', Carbon::today()->toDateString())
            ->get();
        // $completed = $pending= $totalApps = 0;
        // foreach($appointments['today'] as $app){
        //     ($app->status == 'completed') ? $completed++ : $pending++ ;
        //     $totalApps++;
        // }
        // $appointments['today']['totalCompleted'] = $completed;
        // $appointments['today']['totalPending'] = $pending;
        // $appointments['today']['totalApp'] = $totalApps;
        // // dd($appointments['today']);
            

        $appointments['currentWeek'] = Appointment::select('patients.name','appointments.*')
            ->join('patients', 'appointments.patient_id', '=','patients.id')
            ->where('appointments.doctor_id', $user->doctor->id)
            ->whereBetween( DB::raw('date(date)'), [$fromDate, $tillDate] )
            ->get();
            // dd($appointments['currentWeek']);
        $appointments['currentMonth'] = Appointment::select('patients.name','appointments.*')
            ->join('patients', 'appointments.patient_id', '=','patients.id')
            ->where('appointments.doctor_id', $user->doctor->id)
            ->whereYear('appointments.date', Carbon::now()->year)
            ->whereMonth('appointments.date', Carbon::now()->month)
            ->get();
        return view('layouts.admin.doctor.profile')->with(compact('user', 'appointments'));
        
        
    }



    public function rescheduleAppointment(Appointment $appointment){
        if(!Auth::user()->hasRole('doctor') && empty($appointment)) return abort(404);
        $appointment->reschedule_req = true;
        if($appointment->save()){
            Toastr::success('Request processed successfully', 'Successful');
            return back();           
        }
        else{
            Toastr::error('Please try after some time!', 'Error');
            return back();           
        }
       
    }

    public function patientProfile($patientId){
        if(!Auth::user()->hasRole('doctor')) return abort(404);
        $patient = Patient::find($patientId);
        //today appointments
        $appointments = Appointment::where('patient_id',$patientId)
        ->where('doctor_id', Auth::user()->doctor->id)
        ->whereDate('date', '=', Carbon::today()->toDateString())
        ->where('status', '<>', 'success')
        ->where('is_active', '==', 1)
        ->get();
        //fetch all prescription
        $prescriptions = Priscription::select('priscriptions.*', 'users.name as doctorName', 'users.email as doctorEmail', 'doctors.sign as doctorSignature', 'doctors.specialization as doctorSpecialization')
            ->leftJoin('doctors', 'doctors.id', '=', 'priscriptions.doctor_id')
            ->leftJoin('users', 'users.id', '=', 'doctors.user_id')
            ->where('priscriptions.patient_id', $patientId)
            ->get();
        $departments = Department::all();
        return view('layouts.admin.doctor.patientprofile')->with(compact('patient','departments', 'prescriptions', 'appointments'));
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

    /* new prescription stor for patient by doctor */
    public function patientNewPrescriptionStore( Request $request){
        if(!Auth::user()->hasRole('doctor')) return abort(404);
        if(!empty($request->prescription)){
            $patient = Patient::find($request->patientId);
            if($patient->assinged_doc != Auth::user()->doctor->id){
                Toastr::error('Access Denied! :', 'Error');
                return redirect()->back();
            }
            $prescription = New Priscription;
            $prescription->patient_id = $request->patientId;
            $prescription->doctor_id = Auth::user()->doctor->id;
            $prescription->prescription = $request->prescription;
            $doctor =Auth::user()->doctor;;
            if($prescription->save()){
                $data = array(
                    "docName" => Auth::user()->name,
                    "specialization" => (is_null($doctor->specialization))?'':$doctor->specialization,
                    "prescription" => $request->prescription,
                    "sign" => $doctor->sign,
                );
                // $data = ['data'=>$data];
                // $pdf = PDF::loadView('layouts.email.prescriptionEmailTemplate', $data);
                // $pdf->set_option('isRemoteEnabled', TRUE);
                // Mail::send('layouts.email.prescriptionEmailTemplate', $data, function($message)use($data,$pdf) {
                // $message->to('test@gmail.com', 'ravin')
                // ->subject("Prescription PR Medication")
                // });
                $emails = [$patient->user->email , Auth::user()->email];
                // Mail:: to($emails)->send(new sendPrescriptionMail($data));
                Toastr::success('Prescription created Successfully :', 'Success');
                return redirect()->back();
            }
        }
        
    }
    /* new patient prescription store end*/

    /*appointment conmplete from doctor abouve video*/
  
    public function appointmentComplete(Appointment $appointment){
        if (!Auth::user()->hasAnyRole(['doctor'])) return  abort(404) ;
        if(!empty($appointment)){
            $appointment->status = 'success';
            if($appointment->save()){
                Toastr::success('Prescription created Successfully :', 'Success');
            }
        }
        else{
            Toastr::error('Somthing went wrong please try after some time! :', 'Error');
        }
        return redirect()->back();
    }
    /*apointment complete endd*/

    /* doctor search to patinet bu id*/
    public function patientList(){
        if (!Auth::user()->hasRole(['doctor'])) return  abort(404) ;
        return view('layouts.admin.doctor.partial.patientlist');
    }
    
    public function searchWithId(Request $request){
        
        if (!Auth::user()->hasRole(['doctor'])) return  abort(404) ;
        if(empty($request->patientId)){
            Toastr::error('Somthing Went Wrong :', 'Error');
        }else{
            
            $appointments = Appointment::where('doctor_id', Auth::user()->id)
            ->where('patient_id', $request->patientId)->get();
            if(count($appointments)){
                return redirect()->route('doctor.patient.profile', $request->patientId);
            }
            Toastr::error('Not authorized to access this patient data :', 'Error');
            return redirect()->back();
        }
    }
    /* doctor search to patinet bu id end */

    /*department change / check for covid or alopathy else null*/
    public function changeDepartment(Request $request, Patient $patient){
        if (!Auth::user()->hasAnyRole(['doctor','admin'])) return  abort(404) ;
        if($patient->assinged_doc != Auth::user()->doctor->id){
            Toastr::error('Access Denied! :', 'Error');
            return redirect()->back();
        }
        $user = $patient->user ;
        $depId = $patient->user->departments[0];
        if($request->department_ == $depId->id){
            Toastr::error('Patient is already in the selected department :', 'Error');
                return redirect()->back();
        }
        
        if($user->departments()->detach($depId)){
               $user->departments()->attach($request->department_);
               $patient->is_alopathy = ($request->department_ == 3) ? true : null;;
               $patient->is_covid = ($request->department_ == 1) ? true : null;;
               $patient->is_department_change = 'requested';
               $patient->dept_change_by = Auth::user()->id;  
               $patient->save();
               Toastr::success('Patient Department Changed Successfully :', 'Success');
                return redirect()->back();
        }
        
    }
    /*change department end */

    public function distroy($id){}
    public function show(){ }
}