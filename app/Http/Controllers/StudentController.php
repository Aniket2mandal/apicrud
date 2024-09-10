<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    //TO SHOW ALL THE DATA IN THE TABLE
    public function index(){
        $student=Student::all();
        if($student->count()>0){
        $data=[
            'status'=>200,
            'students'=>$student
        ];
        return response()->json($data,200);
    }
        else{
            $data=[
                'status'=>404,
                'message'=>'No Record Found'
            ];
            return response()->json($data,404);
        }
    }

    // TO STORE DATA
    public function store(Request $request){
        $validate=$request->validate([
            'name'=>'required|string',
            'faculty'=>'required',
            'email'=>'required|'
              ]);

                $student=Student::create([
                    'name'=>$request->name,
                    'faculty'=>$request->faculty,
                    'email'=>$request->email,
                ]);

              if($student){
                return response()->json([
                    'status'=>200,
                    'message'=>'Data inserted sucessfully'
                ],200);
              }
              else{
                return response()->json([
                    'status'=>500,
                    'message'=>'Data not inserted'
                ],500);
              }
    }

    // TO SHOW A PARTICULAR DATA
    public function show($id){
        $student=Student::find($id);
        if($student){
            return response()->json([
              'status'=>200,
              'message'=>$student
            ],200);
        }
        else{
            return response()->json([
                'status'=>400,
                'message'=>'Data not found'
              ],400);
        }
    }

    // TO UPDATE DATA
    public function update(Request $request,int $id){
        $validate=$request->validate([
            'name'=>'required|string',
            'faculty'=>'required',
            'email'=>'required|'
              ]);


                $student=Student::find($id);
                if($student){
                $student->update([
                    'name'=>$request->name,
                    'faculty'=>$request->faculty,
                    'email'=>$request->email,
                ]);
                return response()->json([
                 'status'=>200,
                 'message'=>'Data updated sucessfully'
                ],200);
            }
            else{
                return response()->json([
                    'status'=>404,
                    'message'=>'Data not found'
                   ],404);
            }

              if($student){
                return response()->json([
                    'status'=>200,
                    'message'=>'Data inserted sucessfully'
                ],200);
              }
              else{
                return response()->json([
                    'status'=>500,
                    'message'=>'Data not inserted'
                ],500);
              }
    }


    // TO DELETE THE DATA
    public function destroy($id){
        $student=Student::find($id);
        if($student){
             $student->delete();
             return response()->json([
                'status'=>200,
                'message'=>'Data deleted sucessfully'
            ],200);
        }
        else{
            return response()->json([
                'status'=>404,
                'message'=>'Data not found'
            ],404);
        }
    }
}
