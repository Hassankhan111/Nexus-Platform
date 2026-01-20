<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\meeting;
use App\Models\startup;
use App\Models\investor_startup;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\str;

class AppointmentController extends Controller
{
    // create appointments for investors
    public function createappintment(Request $request){
            
        $investors = auth()->user();
        
        $validator = Validator::make($request->all(), [
            'startup_id' => 'required|exists:startups,startup_id',
            'scheduled_at' => 'required|date',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'errors' => $validator->errors(),
            ], 422);
        }
         
         $data = $validator->validated();
         $meting_link  = str::random( 10);
         $data['meeting_link'] =   url('/Appointment/' . $meting_link);
         $data['investor_id'] = $investors->id;

         $appointmnet = meeting::create($data);

          if ($appointmnet) {
            return response()->json([
                'status' => true,
                'message' => 'Booking created successfully',
                'booking' => $appointmnet,
            ], 200);
        }
     }

     //show appointments
     public function index($id){
        $appointment = meeting::where('investor_id',$id)->get();

         if (!$appointment) {
            return response()->json([
                'status' => false,
                'message' => 'you have not scheduled please make appointment',
            ], 404);
        }else{
             return response()->json([
                'status' => true,
                'data' => $appointment,
            ], 404);
        }
     }

      //show appointments to entreprenure 
     public function appointmentstartup($id){
        $appointment = meeting::where('startup_id',$id)->get();

         if (!$appointment) {
            return response()->json([
                'status' => false,
                'message' => 'you have not any meetings tody',
            ], 404);
        }else{
             return response()->json([
                'status' => true,
                'data' => $appointment,
            ], 404);
        }
     }
}