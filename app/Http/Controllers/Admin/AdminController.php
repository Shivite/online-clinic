<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use App\Appointment;
use App\Department;
use App\doctor;
Use \DateTime;
use App\Patient;
use Brian2694\Toastr\Facades\Toastr;  
class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

     public function __construct()
     {
         $this->middleware('auth');
     }

     public function appointments(){
        $appointments = [];
        $appointments = Appointment::All();
        
        return view('layouts.admin.appointment.appointments')->with(compact('appointments'));
    }
    /*reschedule appointment */
    public function reappointment(Appointment $appointment){
        $department = $appointment->doctor->user->departments[0];
        $departmentUsers = Department::find($department->id)->users()->get();
        $doctors = [];
        $i = 0;
        $timeSlots = array('08:30','09:00','09:30','10:00','10:30','11:00','11:30','12:00','12:30','13:00','13:30',
        '14:00','14:30','15:00','15:30','16:00','16:30','17:00','17:30','18:00','18:30','19:00','19:30','20:00','20:30');
        foreach($departmentUsers as $deptUser){
            if(!empty($deptUser->doctor)){
                // if($deptUser->doctor->id == $appointment->doctor_id) continue;
                $doctors[$i]['name'] =  $deptUser->doctor->user->name;
                $doctors[$i]['id']   =  $deptUser->doctor->id;
                $i++;
            }
        }
        return view('layouts.admin.appointment.reschedule')->with(compact('appointment', 'doctors', 'department', 'timeSlots'));
    }

    public function getTimeSlot(Request $request){
        // dd($request->post());
        if (!Auth::user()->hasRole(['admin']))  return abort(404);
        if(isset($request->appointment)){
            $appointment = Appointment::find($request->appointment);
            if(empty($appointment) || $appointment->reschedule_req != 1){
                Toastr::error('Appointment not requested for schedule! :', 'Error');
                return redirect()->back();
            }
            $appDate = $appointment->date;
        }
        $date = new \DateTime($request->appointmentDate);
        $appDate = $date->format("Y-m-d");
    
         $timeSlots = array('08:30','09:00','09:30','10:00','10:30','11:00','11:30','12:00','12:30','13:00','13:30',
        '14:00','14:30','15:00','15:30','16:00','16:30','17:00','17:30','18:00','18:30','19:00','19:30','20:00','20:30');
        $app = Appointment::select('start_time')
            ->where('doctor_id', $request->doctorId )
            ->where('date', '=',$appDate)
            ->get()->toArray();
         
            foreach($app as $ap){
              if($index = array_search($ap['start_time'], $timeSlots)){
                unset($timeSlots[$index]);
              }
            }
            $returnHTML = view('layouts.admin.appointment.time-slots')->with('timeSlots', $timeSlots)->render();
            return response()->json(array('success' => true, 'html'=>$returnHTML));
  
    }
    
    /* reeschedule appointments --- (Alopathy on request) */
    public function reScheduleAppointment(Request $request){
        if (!Auth::user()->hasRole(['admin']))  return abort(404);
        if(isset($request->patient_id)){
            $patient = patient::find($request->patient_id);
        }else{
            $appointment = Appointment::find($request->appointment);
            $patient = Patient::find($appointment->patient_id);
        }
        /* schedule first alopathy appointment */
        if(isset($request->islopathy)){
            $date = DateTime::createFromFormat('m/d/Y',$request->appointment_date);
            $appDate = $date->format("Y-m-d");
            $appointment = new Appointment;
            $action = 'created';
            $appointment->patient_id = $request->patient_id;
            $appointment->date = $appDate ;
            $appointment->isalopathy = true;
            $patient->is_alopathy = true;
            $patient->is_department_change = 'success';
        }
        /* reschedule appointment on doctor request */
        else{
            $appointment = Appointment::find($request->appointment);
            $date = DateTime::createFromFormat('d/m/Y',$request->appointment_date);
            $appDate = $date->format("Y-m-d");
            if(empty($appointment) || $appointment->reschedule_req != 1){
                Toastr::error('Appointment not requested for schedule! :', 'Error');
                return redirect()->back();
            }
            $appointment->reschedule_req = false;
            $appointment->reschedule_status = true;
            $appointment->date = $appDate ;
            $appointment->isalopathy = false;
            $patient->is_alopathy = null;
            $action = ' reschdule ';
        }
        $appointment->doctor_id = $request->newdoctor;
        $appointment->start_time = $request->timeslot;
        if($appointment->save()){
            $patient->assinged_doc = $appointment->doctor_id;
            $patient->save();
            Toastr::success('Appointment '.$action.' successfully! :', 'Success');
            return redirect()->back();
        }
 
    }

    /* list only alopathy patients */
    public function  oncologyPatient(){
        if (!Auth::user()->hasRole(['admin']))  return abort(404);
        $deptusers = Department::find(3)->users;
        $userId = [];
        $alopathy = true;
        foreach($deptusers as $deptUser){
            if($deptUser->hasRole('patient')){
                array_push($userId, $deptUser->patient->id);
            }
        }
        $patients = Patient::whereIn('id', $userId)
        ->where('is_alopathy', true)
        ->where('is_department_change', 'requested')
        ->get();
        return view('layouts.admin.patient.index')->with(compact('patients', 'alopathy'));
    }
    /*end */

    /* show only non alopathy transfered patient*/
    public function  requestedTransfer(){
        if (!Auth::user()->hasRole(['admin']))  return abort(404);
        $transfered = true;
        $patients = Patient::select('patients.*', 'users.name as docName')
            ->join('doctors', 'patients.assinged_doc', '=','doctors.id')
            ->join('users', 'doctors.user_id', '=', 'users.id')
        ->where('patients.is_department_change', 'requested')
        ->where('patients.is_alopathy', null)
        ->where('patients.is_department_change', 'requested')
        ->get();
        // dd($patients);
        return view('layouts.admin.patient.transfer.index')->with(compact('patients'));
    }
    /*show alopathy patients end */

    /* Post approve deparment on doctor request*/
    public function postApproveDepartment( Patient $patient){
        if (!Auth::user()->hasRole(['admin']))  return abort(404);
        $patient->dept_change_status = 'success';
        $patient->is_department_change = null;
        $patient->save();
        Toastr::success('Department change approved successfuly! :', 'Success');
        return redirect()->back();
    }
    /*
    /* list alopathy doctors */
    public function getAppointAlopathyDoctor(Patient $patient){
        if (!Auth::user()->hasRole(['admin']))  return abort(404);

        $departmentUsers = Department::find(3)->users()->get();
        $doctors = [];
        $i = 0;
        foreach($departmentUsers as $deptUser){
           
            if(!empty($deptUser->doctor)){
                $doctors[$i]['name'] =  $deptUser->doctor->user->name;
                $doctors[$i]['id']   =  $deptUser->doctor->id;
                $i++;
            }
        }
        return view('layouts.admin.appointment.alopathappointment')->with(compact('doctors', 'patient'));
       
    }

    public function departmentFee(){
        $departments = Department::all();
        return view('layouts.admin.department-fee')->with(compact('departments'));
    }
    public function departmentFeeUpdate(Request $request){
        if (!Auth::user()->hasRole(['admin']))  return abort(404);
        if(!empty(($request->dept && $request->fee))){
            $department = Department::find($request->dept);
            $department->fee = $request->fee;
            if($department->save()){
                Toastr::error('Department fee updated successfully! :', 'success');
                return redirect()->back();               
            }else{
                Toastr::error('Error in action. Please try after some time! :', 'Error');
                return redirect()->back();
            }
        }
        
    }
    /* alopathy doctor assignemnt done */
     public function index()
    {
      return  view('layouts.admin.dashboard');
    }
    
    public function create()
    {    }

    public function store(Request $request)
    {    }

    public function show($id)
    {    }

    public function edit($id)
    {    }

    public function update(Request $request, $id)
    {    }

    public function destroy($id)
    {    }
}