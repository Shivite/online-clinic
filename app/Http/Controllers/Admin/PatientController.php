<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use Gate;
use App\User;
use App\Patient;
use App\AnalysisFirst;
use App\AnalysisSecond;
use App\AnalysisThird;
use App\AnalysisFourth;
use App\AnalysisFifth;
use App\AnalysisSixth;
use App\AnalysisSeventh;
use App\AnalysisEight;
use App\Payment;
use App\Symptom;
use App\Report;
use Image;
use Illuminate\Support\Facades\Storage;
use Brian2694\Toastr\Facades\Toastr;
class PatientController extends Controller
{
    public function _construct()
    {
        $this->middleware('auth');
        $analysisData = [];
    }

    public function index()
    {
      if (!Auth::user()->hasAnyRole(['admin','staff'])) return  abort(404) ;
        $patients = Patient::all();

        return view('layouts.admin.patient.index')
            ->with('patients', $patients);
    }

    public function edit($id)
    {

      if (!Auth::user()->hasAnyRole(['admin','staff']))  return abort(404);
      $patient = Patient::find($id);
      
      return view('layouts.admin.patient.edit')
          ->with(['patient' => $patient]);

    }

    public function update(Request $request, $id)
    {
      if (!Auth::user()->hasAnyRole(['admin','staff']))  return abort(404);
      // dd($request->post());
      $this->validate($request,[
           "title" => "required",
           "name" => "required",
           "number" => "required|min:10|numeric",
           "altnumber" => "min:10|numeric",
           'email' => 'required|email|unique:patients,email,'.$id,
           "address" => "required",
           "pin" =>  "required|min:10|numeric",
           "legalgaurdian" =>  "required",
           "country" =>  "required",
           "dob" =>  "required",
          "age" =>  "required",
           "gender" =>  "required",
           "language" =>  "required",
           "religion" =>  "required",
           "occupaton" =>  "required",
           "marital" =>  "required",
           'photo' => 'image|mimes:jpeg,png,jpg |max:2048 ',
           'proof' => 'image|mimes:jpeg,png,jpg  |max:2048 ',
      ]);
        $patient = Patient::find($id);
        $patient->title = $request->title;
        $patient->name  =      $request->name     ;
        $patient->number   =     $request->number     ;
        $patient->alt_number   =     $request->altnumber     ;
        $patient->email    =     $request->email     ;
        $patient->address    =     $request->address     ;
        $patient->pin    =     $request->pin     ;
        $patient->legalgaurdian    =     $request->legalgaurdian     ;
        $patient->country    =     $request->country     ;
        $patient->state    =     $request->state     ;
        $patient->pin    =     $request->pin     ;
        $patient->dob    =     new \DateTime($patient->dob);;
        $patient->docname    =     $request->docname     ;
        $patient->age    =     $request->age     ;
        $patient->gender   =     $request->gender     ;
        $patient->language   =     $request->language     ;
        $patient->religion   =     $request->religion     ;
        $patient->occupaton    =     $request->occupaton     ;
        $patient->marital    =     $request->marital     ;

        if ($request->hasFile('photo')){
            $patient->photo    =     $validatedData['photo']      ;
            $validatedData['photo'] = $this->imageUpload($request->file('photo'), $patient->email, 'photo' );
        }
        if ($request->hasFile('proof')) {
          $patient->proof    =     $validatedData['proof']     ;

          $validatedData['proof'] = $this->imageUpload($request->file('proof'), $patient->email, 'proof');
        }



        if($patient->save()){
            $patients = Patient::all();
            Toastr::success('Patient updated Successfully :', 'Success');
              return view('layouts.admin.patient.index')
              ->with('patients', $patients);

        }else{
          $patients = Patient::all();
          Toastr::error('Error in user update ! <br> Please Try later :', 'Error');
          return view('layouts.admin.user.index')
              ->with('patients', $patients);
        }
    }

    public function destroy($id)
    {

      if (!Auth::user()->hasRole(['admin'])){
        Toastr::error('Do not have access rights!', 'Error');
        return redirect()->back();
      }
      $patient = Patient::find($id);

        (Storage::disk('public')->exists($imgRoot.'/Doctor' . $user->Doctor->Doctor_pic) && $user->Doctor->Doctor_pic != 'doctor.png' ) ?  Storage::disk('public')->delete($imgRoot . $user->Doctor->Doctor_pic):'';

        (Storage::disk('public')->exists($imgRoot.'/Doctor' . $user->Doctor->sign) && $user->Doctor->sign!= 'sign.png' ) ?  Storage::disk('public')->delete($imgRoot . $user->Doctor->sign):'';
          $docId = $user->Doctor->id;
          echo "done";
          if($user->roles()->detach() && $user->Doctor()->delete() &&  $user->delete()){
            echo "deleted";
            Toastr::success('User Successfully Deleted !', 'Success');
          }

          else
              Toastr::error('Something went wrong please try after some time!', 'Error');
          return redirect()->back();
    }

    public function imageUpload($img, $userEmail, $name )    {
      $patientFolder = $userEmail;
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

    public function analysisFirst(Request $request, Patient $patient){
      $analysisFirst = AnalysisFirst :: where('patient_id', $patient->id)->first();
      if(empty($analysisFirst)){
          AnalysisFirst::create($request->all() + ['patient_id' => $patient->id]);
          Toastr::success('Analysis First Report created Successfully :', 'Success');
      }
      else{
        $analysisFirst->fill($request->all())->save();
        Toastr::success('Analysis First Report updated Successfully :', 'Success');
      }
      return back()->with('patient', $patient);
    }

    public function analysisSecond(Request $request, Patient $patient){
      $analysisSecond = AnalysisSecond :: where('patient_id', $patient->id)->first();
      if(empty($analysisSecond)){
          AnalysisSecond::create($request->all() + ['patient_id' => $patient->id]);
          Toastr::success('Analysis Second Report created Successfully :', 'Success');
      }
      else{
        $analysisSecond->fill($request->all())->save();
        Toastr::success('Analysis Second Report updated Successfully :', 'Success');
      }
      return back()->with('patient', $patient);
    }

    public function analysisThird(Request $request, Patient $patient){
      $analysisThird = AnalysisThird :: where('patient_id', $patient->id)->first();
      if(empty($analysisThird)){
          AnalysisThird::create($request->all() + ['patient_id' => $patient->id]);
          Toastr::success('Analysis Third Report created Successfully :', 'Success');
      }
      else{
        $analysisThird->fill($request->all())->save();
        Toastr::success('Analysis Third Report updated Successfully :', 'Success');
      }
      return back()->with('patient', $patient);
    }

    public function analysisFourth(Request $request, Patient $patient){
      // dd($request->post());
      $analysisFourth = AnalysisFourth:: where('patient_id', $patient->id)->first();
      if(empty($analysisFourth)){
          AnalysisFourth::create($request->all() + ['patient_id' => $patient->id]);
          Toastr::success('Analysis Third Report created Successfully :', 'Success');
      }
      else{
        $analysisFourth->fill($request->all())->save();
        Toastr::success('Analysis Third Report updated Successfully :', 'Success');
      }
      return back()->with('patient', $patient);
    }

    public function analysisFifth(Request $request, Patient $patient){


      $analysisFifth = AnalysisFifth:: where('patient_id', $patient->id)->first();
      if(empty($analysisFifth)){
          AnalysisFifth::create($request->all() + ['patient_id' => $patient->id]);
          Toastr::success('Analysis Third Report created Successfully :', 'Success');
      }
      else{
        $analysisFifth->fill($request->all())->save();
        Toastr::success('Analysis Third Report updated Successfully :', 'Success');
      }
      return back()->with('patient', $patient);
    }

    public function analysisSixth(Request $request, Patient $patient){

      $analysisSixth = AnalysisSixth:: where('patient_id', $patient->id)->first();
      if(empty($analysisSixth)){
          AnalysisSixth::create($request->all() + ['patient_id' => $patient->id]);
          Toastr::success('Analysis Third Report created Successfully :', 'Success');
      }
      else{
        $analysisSixth->fill($request->all())->save();
        Toastr::success('Analysis Third Report updated Successfully :', 'Success');
      }
      return back()->with('patient', $patient);
    }

    public function analysisSeventh(Request $request, Patient $patient){
      // dd($request->all());
      $analysisSeventh = AnalysisSeventh:: where('patient_id', $patient->id)->first();
      if(empty($analysisSeventh)){
          AnalysisSeventh::create($request->all() + ['patient_id' => $patient->id]);
          Toastr::success('Analysis Third Report created Successfully :', 'Success');
      }
      else{
        $analysisSeventh->fill($request->all())->save();
        Toastr::success('Analysis Third Report updated Successfully :', 'Success');
      }
      return back()->with('patient', $patient);
    }

    public function analysisEight(Request $request, Patient $patient){
      // dd($request->all());
      $analysisEight = AnalysisEight:: where('patient_id', $patient->id)->first();
      if(empty($analysisEight)){
          AnalysisEight::create($request->all() + ['patient_id' => $patient->id]);
          Toastr::success('Analysis Third Report created Successfully :', 'Success');
      }
      else{
        $analysisEight->fill($request->all())->save();
        Toastr::success('Analysis Third Report updated Successfully :', 'Success');
      }
      return back()->with('patient', $patient);
    }

    public function newSymptoms(Request $request){
      // dd($request->all());
      if (!Auth::user()->hasRole(['patient'])) return  abort(404) ;
      $patient = Auth::user()->patient;
      $request->validate([
       'uploadreport1' => 'image|mimes:jpeg,png,jpg |max:2048',
       'uploadreport2' => 'image|mimes:jpeg,png,jpg |max:2048',
       'uploadreport3' => 'image|mimes:jpeg,png,jpg |max:2048',
       'uploadreport4' => 'image|mimes:jpeg,png,jpg |max:2048',
    ]);
    // dd($request->all());
    $symptom = new Symptom;
    $symptom->symptom = $request->symptoms;
    $symptom->comment = $request->comments;
    
     $report = array();
    if ($request->hasFile('uploadreport1')) $report["uploadreport1"] = $this->imageUpload($request->file('uploadreport1'), Auth::user()->email,  'uploadreport1');
    if ($request->hasFile('uploadreport2')) $report["uploadreport2"] = $this->imageUpload($request->file('uploadreport2'),  Auth::user()->email, 'uploadreport2');
    if ($request->hasFile('uploadreport3')) $report["uploadreport3"] = $this->imageUpload($request->file('uploadreport3'), Auth::user()->email,  'uploadreport3');
    if ($request->hasFile('uploadreport4')) $report["uploadreport4"] = $this->imageUpload($request->file('uploadreport4'), Auth::user()->email,  'uploadreport4');
    if(!empty($report)){
      foreach($report as $key => $value){
        $report = new Report;
        $report->report = $value;
        $report->save();
        $patient->reports()->attach($report);
      }
    }///!empty reprts check end
    $symptom->patient_id = $patient->id;
      if($symptom->save())
        Toastr::success('Symptoms Added Successfully :', 'Success');
      else
        Toastr::error('Symptoms Added Successfully :', 'Error');
    return redirect()->back();
 }


   

    /*patient payments for admin */
    public function patientPayments(){
      if (!Auth::user()->hasAnyRole(['admin'])) return  abort(404) ;          
      return view('layouts.admin.patient.payment.index')
            ->with('payments', Payment::all());
    }
    /*patient payments end*/

    
}