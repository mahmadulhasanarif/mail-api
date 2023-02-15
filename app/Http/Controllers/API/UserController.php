<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    public function login(Request $request)
    {
        if (Auth::attempt(['email'=>$request->email, 'password'=>$request->password])) {
            $user = Auth::user();
            $data['token'] = $user->createToken("myApp")->plainTextToken;
            $data['name'] = $user->name;
            $data['email'] = $user->email;

            $response = [
                'success'=>true,
                'data'=>$data,
                'message'=>'User Login Successfully'
            ];

            return response()->json($response, 200);
        }else{
            $response = [
                'success'=>false,
                'message'=>'User Login Fail'
            ];
    
            return response()->json($response, 405);
        }
    }

    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name'=>'required',
            'email'=>'required|email',
            'password'=>'required',
            'confirm_password'=>'required|same:password'
        ]);

        if($validator->fails()){
            $response = [
                'success'=>false,
                'message'=>$validator->errors(),
            ];
            return response()->json($response, 200);
        };

        $input = $request->all();
        $input['password']=bcrypt($input['password']);
        $user = User::create($input);

        $data['token'] = $user->createToken("myApp")->plainTextToken;
        $data['name'] = $user->name;
        $data['email'] = $user->email;


        $response = [
            'success'=>true,
            'data'=>$data,
            'message'=>"Successfully Register"
        ];
        return response()->json($response, 200);
    }
}
