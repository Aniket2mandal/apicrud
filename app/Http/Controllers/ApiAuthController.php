<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class ApiAuthController extends Controller
{
// CODE FOR REGISTER CREDENTIAL
    public function register(Request $request){
        $validate=$request->validate([
            'email'=>'required|string',
            'password'=>'required',
            'c-password'=>'required|same:password'
              ]);

            $userdata=User::create([
                'email'=>$request->email,
                $pass='password'=>$request->password,
                'c-password'=>$request->c_password,
                bcrypt($pass)
                // 'password'=>$request->bcrypt($input['password']),
            ]);
            $registertoken=$user->createToken('Register Token')->accessToken;
            if($registertoken){
            $response=[
              'success'=>true,
              'message'=>'User registered successfully'
            ];
            return response()->json($response,200);
        }else{
            $response=[
                'success'=>false,
                'message'=>'User connot register'
              ];
              return response()->json($response,404);
        }
    }

    // CODE FOR LOGIN CREDENTIALS
    public function login(Request $request){
        $validate=$request->validate([
            'email'=>'required|string',
            'password'=>'required',
            'c-password'=>'required|same:password'
              ]);

        $user=User::where('email',$request->email)->first();
        if(Hash::check($request->password,$user->password)){
            $token=$user->createToken('Access Token')->accessToken;
        }
        else{
            throw new \Exception('invalid credentials',401);
        }
        return response()->json([
            'status'=>200,
           'message'=>"User logeding successfully",
            'access_token'=>$token
        ]);
    }


}
