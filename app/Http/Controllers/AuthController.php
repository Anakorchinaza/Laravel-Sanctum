<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use App\Models\User;
use App\Traits\HttpResponses;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\LoginUserRequest;

class AuthController extends Controller
{
   use HttpResponses;

    public function Login(LoginUserRequest $request){
        $request->validated($request->all());
        $credentials = $request->only('email', 'password');

        if (!Auth::attempt($credentials)) {
           return $this->error('', 'Credential do not Match', 401);
        }

        $user = User::where('email', $request->email)->first();

        return $this->success([
            'user' => $user,
            'token' => $user->createToken('API Token of '. $user->name)->plainTextToken
        ]);
    }//end method

    public function Register(StoreUserRequest $request){

        $request->validated($request->all());
        $user = User::create([
            "name"=> $request->name,
            "email"=> $request->email,
            "password"=> Hash::make($request->password),
        ]);

        return $this->success([
            'user' => $user,
            'token' => $user->createToken('API Token of '. $user->name)->plainTextToken
        ]);

    }

    public function Logout(){
       Auth::user()->currentAccessToken()->delete();

       return $this->success([
        'message' => 'You have successfully logged out'
       ]);
    }

            


}
