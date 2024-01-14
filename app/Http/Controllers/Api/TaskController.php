<?php

namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;


use App\Models\Task;
use App\Models\User;
use Auth;
use Validator;


class TaskController extends Controller
{
     public function get_task(Request $request,$user_id=null){
        // $user =  auth('sanctum')->user();
    

        

        if($user_id==null){
            $task = Task::with('user')->get();

            return response()->json([
                'status' => true,
                'message' => "task get success",
                'data' => $task->toArray(),
            ],200);
        }else{
            $task = Task::where('user_id',$user_id)->get();

            return response()->json([
                'status' => true,
                'message' => "task get success",
                'data' => $task->toArray(),
            ],200);
        }
     }

     public function change_task_status(Request $request){
        // dd($request->all());
        $validator = Validator::make($request->all(), [ 
            'task_id' => 'required',
            'task_status' => 'required',
        ]);

        if ($validator->fails()) { 
            $errorMessage = $validator->errors()->first();
            return response()->json(['status' => false,'message'=>$errorMessage]);              
        }

        if(!empty($request->task_id)){

            $task = Task::find($request->task_id);
            $task->task_status =  $request->task_status;
            $task->update();
            return response()->json([
                'status' => true,
                'message' => "task updated"
            ]);
        }
        else{
            return response()->json([
                'status' => false,
                'message' => "you are not login"
            ]);
        }
     }

     public function get_single_task(Request $request, $task_id){
        // $user =  auth('sanctum')->user();
        // dd($user->id);
        if(!empty($task_id)){
            $task = Task::where('id',$task_id)->first();

            return response()->json([
                'status' => true,
                'message' => "task Addes",
                'data' => $task->toArray(),
            ],200);
        }
        else{
            return response()->json([
                'status' => false,
                'message' => "you are not login"
            ]);
        }
     }

     public function add_task(Request $request){
        
        // dd($user->id);
        $validator = Validator::make($request->all(), [ 
            'emp_id' => 'required',
            'title' => 'required',
            'description' => 'required',
        ]);

        if ($validator->fails()) { 
            $errorMessage = $validator->errors()->first();
            return response()->json(['status' => false,'message'=>$errorMessage]);              
        }

        if(!empty($request->emp_id)){

            $task = new Task;
            $task->user_id =  $request->emp_id;
            $task->title = $request->title;
            $task->description = $request->description;
            $task->save();
            return response()->json([
                'status' => true,
                'message' => "task Addes"
            ]);
        }
        else{
            return response()->json([
                'status' => false,
                'message' => "you are not login"
            ]);
        }
     }

     public function edit_task(Request $request){
        $validator = Validator::make($request->all(), [ 
            'task_id' => 'required',
            'emp_id' => 'required',
            'title' => 'required',
            'description' => 'required',
        ]);

        if ($validator->fails()) { 
            $errorMessage = $validator->errors()->first();
            return response()->json(['status' => false,'message'=>$errorMessage]);              
        }
        if(!empty($request->task_id)){

            $task = Task::find($request->task_id);
            $task->user_id =  $request->emp_id;
            $task->title = $request->title;
            $task->description = $request->description;
            $task->update();
            return response()->json([
                'status' => true,
                'message' => "task updated"
            ]);
        }
        else{
            return response()->json([
                'status' => false,
                'message' => "you are not login"
            ]);
        }
     }
     public function delete_task(Request $request){
        $validator = Validator::make($request->all(), [ 
            'task_id' => 'required',
        ]);

        if ($validator->fails()) { 
            $errorMessage = $validator->errors()->first();
            return response()->json(['status' => false,'message'=>$errorMessage]);              
        }
        if(!empty($request->task_id)){

            Task::where('id',$request->task_id)->delete();
            return response()->json([
                'status' => true,
                'message' => "task Deleted"
            ],200);
        }
        else{
            return response()->json([
                'status' => false,
                'message' => "you are not login"
            ],401);
        }
        
     }
}
