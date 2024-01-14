<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Task;
use Validator;
use Auth;

class LoginController extends Controller
{
    public function login(Request $request){

        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if ($validator->fails()) { 
            $errorMessage = $validator->errors()->first();
             return response()->json(['status' => false,'message'=>$errorMessage], 401);            
        }

        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])){

            $user = User::where('email', $request->email)->first();
            $data['token'] = $user->createToken($request->email)->plainTextToken;
            $data['user'] = $user;
            
            $response = [
                'status' => true,
                'message' => 'User is logged in successfully.',
                'data' => $data,
            ];
    
            return response()->json($response, 200);
        }
        else{ 
            return response()->json(['status' => false, 'error'=>'Unauthorised']); 
        } 

    }

    public function reg(Request $request){
        $validator = Validator::make($request->all(), [ 
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required',
            'c_password' => 'required|same:password',
        ]);

        if ($validator->fails()) { 
            $errorMessage = $validator->errors()->first();
            return response()->json(['status' => false,'message'=>$errorMessage]);              
        }

        $input = $request->all(); 
        $input['password'] = bcrypt($input['password']); 
        $user = User::create($input); 

        $data['token'] = $user->createToken($request->email)->plainTextToken;
        $data['user'] = $user;

        $response = [
            'status' => true,
            'message' => 'User is created successfully.',
            'data' => $data,
        ];
        
        return response()->json($response, 201);
    }

    public function logout(Request $request)
    {
        $user =  auth('sanctum')->user();
        $user->tokens()->delete();

        return response()->json([
            'status' => true,
            'message' => "logout Success"
        ],200);
    }

    public function get_emplyee(){
        // $user =  auth('sanctum')->user();
        $emplyee = User::where('role', '0')->get();

        return response()->json([
            'status' => true,
            'message' => "task Addes",
            'data' => $emplyee->toArray(),
        ],200);

    }
}
