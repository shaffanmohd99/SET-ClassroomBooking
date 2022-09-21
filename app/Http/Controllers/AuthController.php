<?php

namespace App\Http\Controllers;

use App\Models\Teacher;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    //
    public function login (Request $request){
        //we wwat the password and username
        
        //validate the input 
        $data=request()->validate([
            'name'=>'required|string',
            'password'=>'required|string',
        ]);

        // cross check with table exist 
        $teacher=Teacher::where('name',$data['name'])->first();


        if($teacher){
            // check ps match
            // dd(Hash::check($data['password'],$teacher->secret));
            if(Hash::check($data['password'],$teacher->secret)){
                // generate token 
                $token=$teacher->createToken('API token')->plainTextToken;
                // return token 
                return response()->json([
                    'message'=>'Success login',
                    'data'=>[
                        'token'=>$token
                    ]
                    ]);
            }
        }
        abort(404,'teacher not registered');


    }

    public function logout()
        {
            // dd(Auth::user()->tokens);
            Auth::user()->tokens->last()->delete();
            return 'logout on';
        }
    
}
