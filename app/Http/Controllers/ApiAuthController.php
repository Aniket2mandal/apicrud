<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class ApiAuthController extends Controller
{
// CODE FOR REGISTER CREDENTIAL
    public function register(Request $request){
// dd($request);
        $validate=$request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
              ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        return response()->json(['message' => 'User successfully registered'], 201);
    }

    // CODE FOR LOGIN CREDENTIALS
    public function login(Request $request){
        $validate=$request->validate([
            'email'=>'required|string',
            'password'=>'required',

              ]);

        $user=User::where('email',$request->email)->first();
        if(Hash::check($request->password,$user->password)){
            $token=$user->createToken('Access Token')->accessToken;
        }
        else{
            return response()->json([
                'status'=>401,
               'message'=>"Invalid",
            ]);
        }
        return response()->json([
            'status'=>200,
           'message'=>"User loged in successfully",
            'access_token'=>$token
        ]);
    }


}
