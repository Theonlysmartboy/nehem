<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;
use Auth;
use App\User;

class AdminController extends Controller
{
  public function showLoginForm(){
    $title = "NEHEM | Login";
    if (Session::has('adminSession')) {
       return redirect('/admin')->with('flash_message_success', 'Welcome Back');
   } else if (Session::has('userSession')) {
       return redirect('/user')->with('flash_message_success', 'Welcome Back');
   }else{
       return view('welcome')->with(compact('title'));
   }
  }
    public function login(Request $request){
       $data = $request->input();
       //Attempt to login admin
          if (Auth::attempt(['email' => $data['email'], 'password' => $data['password'], 'role' => '0'])) {
              //start admin session
                Session::put('adminSession', $data['email']);
                //Load the admin dashboard
                return redirect('/admin')->with('flash_message_success', 'Login Successfull');
            } else if (Auth::attempt(['email' => $data['email'], 'password' => $data['password'], 'role' => '1'])) {
                Session::put('userSession', $data['email']);
                return redirect('/user')->with('flash_message_success', 'Login Successfull');
            } else {
                return redirect('/')->with('flash_message_error', 'Invalid Email Or password');
            }

    }
}
