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
      //validate form data
      $this->validate($request,[
        'email'=>'required|email',
        'password'=>'required|min:8'
      ]);
       //Attempt to login admin
          if (Auth::attempt(['email'=>$request->email,'password'=>$request->password],$request->remember, 'role' => '0'])) {
              //start admin session
                Session::put('adminSession', $request->email);
                //if successfull, redirect to intended location
                return redirect()->intended(route('admin.dashboard')->with('flash_message_success', 'Login Successfull'));
            } else if (Auth::attempt(['email'=>$request->email,'password'=>$request->password],$request->remember, 'role' => '1'])) {
                Session::put('userSession', $request->email);
                return redirect()->intended(route('user.dashboard')->with('flash_message_success', 'Login Successfull'));
            } else {
                return redirect('/')->with('flash_message_error', 'Invalid Email Or password');
            }

    }
}
