<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\LoginRequest;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class AuthController extends Controller
{
   public function login(){
        
        return view('auth.login');
   }

   public function doLogin(LoginRequest $request){

       $credentials = $request->validated();
       if(Auth::attempt($credentials)){
           $request ->session()->regenerate();
           return redirect()->intended(route('admin.property.index'));
       }
        return back()->withErrors([
            'email' => 'Adresse e-mail ou mot de passe incorrect'
        ])->onlyInput('email');

   }
   public function logout(){
       Auth::logout();
       return to_route('auth.login')->with('success','Vous ètes maintenant déconnecté');
   }
}
