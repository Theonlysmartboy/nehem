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
          if (Auth::attempt(['email'=>$request->email,'password'=>$request->password, 'role' => '0'],$request->remember)) {
              //start admin session
                Session::put('adminSession', $request->email);
                //if successfull, redirect to intended location
                return redirect()->intended(route('admin.dashboard'))->with('flash_message_success', 'Welcome Back');
            } else if (Auth::attempt(['email'=>$request->email,'password'=>$request->password, 'role' => '1'],$request->remember)) {
                Session::put('userSession', $request->email);
                return redirect()->intended(route('user.dashboard'))->with('flash_message_success', 'Welcome Back');
            } else {
                return redirect('/')->with('flash_message_error', 'Invalid Email Or password');
            }

    }
}
