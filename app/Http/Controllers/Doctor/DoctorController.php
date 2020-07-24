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
              return view('layouts.admin.doctor.profile')->with('user', $user);            }
        }
        else{
          Toastr::error('Error in user update ! <br> Please Try later :', 'Error');
          return view('layouts.admin.user.index')
              ->with('users', $users);
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
        $patient = Patient::find($patientId);
        
        $appointments = Appointment::where('patient_id',$patientId)->where('doctor_id', Auth::user()->id)
        ->whereDate('date', '=', Carbon::today()->toDateString())
        ->get();
    //    dd($appointments);
        $prescriptions = Priscription::select('priscriptions.*', 'users.name as doctorName', 'users.email as doctorEmail', 'doctors.sign as doctorSignature', 'doctors.specialization as doctorSpecialization')
            ->leftJoin('doctors', 'doctors.id', '=', 'priscriptions.doctor_id')
            ->leftJoin('users', 'users.id', '=', 'doctors.user_id')
            ->get();
            // dd($prescriptions);
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
        if (!Auth::user()->hasRole(['doctor']))  return abort(404);
        if(!empty($request->prescription)){
             $patient = Patient::find($request->patientId);
            $prescription = New Priscription;
            $prescription->patient_id = $request->patientId;
            $prescription->doctor_id = Auth::user()->id;
            $prescription->prescription = $request->prescription;
            $doctor = Doctor::find(Auth::user()->id);
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
                Mail:: to($emails)->send(new sendPrescriptionMail($data));
                Toastr::success('Prescription created Successfully :', 'Success');
                return redirect()->back();
            }
        }
        
    }
    /* new patient prescription store end*/


    public function distroy($id){}
}