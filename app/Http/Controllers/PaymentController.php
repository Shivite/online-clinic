<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Razorpay\Api\Api;
use App\Department;
class PaymentController extends Controller
{
    private $razorpayId= 'rzp_test_1z4vEE23O5vJ6R';
    private $razorpayKey= 'QQOe1YLieKNYPRwK4lL6x1fd' ;

    public function initiate(Request $request){
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
      // echo "<pre>"; print_r($order);
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
      // view('layouts.patient.registerpayment', compact('response'));
      // $returnHTML = view('layouts.patient.registerpayment', compact('response'));
      return response()->json([
        'success'=>true,
        'values'=> $response,
      ]);

      // return view('patient.payment', compact('response'));
    }
}
