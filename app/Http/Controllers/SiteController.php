<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SiteController extends Controller
{
    public function login_form(){
        return view("site.login");
    }
    public function login(Request $request){
		$credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            return redirect("/dashboard");
		}
		return back()->withErrors([
			'error' => 'Correo/Contraseña incorrecta',
		]);
	}

    public function dashboard(){
        return view("site.dashboard");
    }

    public function chat($code){
        return view("site.chat",["code"=>$code]);
    }
    public function chat_send($code,Request $request){
        $message = $request->input("message");
        event(new \App\Events\PrivateMessage($code, auth()->user(), $message));
        return "OK";
        //return view("site.chat",["code"=>$code]);
    }
}
