<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

use App\Models\User;

class UserController extends Controller
{
    function register_form(){
        return view("user.register");
    }

    function register(Request $request){
        $data = $request->validate([
            "email"=>"required|unique:users",
            "password"=>"required",
            "name"=>"required"
        ]);
        $data["password"] = Hash::make($data["password"]);
        
        User::create($data);
        
        return redirect("/login");
    }


}
