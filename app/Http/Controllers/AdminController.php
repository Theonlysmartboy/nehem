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

            public function settings() {
        if (Session::has('adminSession')) {
            return view('admin.settings');
        } else {
            return redirect('/admin')->with('flash_message_error', 'Access denied! Please Login first');
        }
    }

    public function chkPassword(Request $request) {
        if (Session::has('adminSession')) {
            $data = $request->all();
            $current_password = $data['current_pwd'];
            $check_password = User::where(['role' => '1'])->first();
            if (Hash::check($current_password, $check_password->password)) {
                echo "true";
                die;
            } else {
                echo "false";
                die;
            }
        } else {
            return redirect('/admin')->with('flash_message_error', 'Access denied! Please Login first');
        }
    }

    public function updatePassword(Request $request) {
        if (Session::has('adminSession')) {
            if ($request->isMethod('post')) {
                $data = $request->all();
                $check_password = User::where(['email' => Auth::user()->email])->first();
                $current_password = $data['current_pwd'];
                $email = Auth::user()->email;
                Hash::check($current_password, $check_password->password);
                $password = bcrypt($data['new_pwd']);
                User::where('email', $email)->update(['password' => $password]);
                Session::flush();
                return redirect('/')->with('flash_message_success', 'Password Updated Successfully');
            }
        } else {
            return redirect('/')->with('flash_message_error', 'Access denied! Please Login first');
        }
    }

    public function updateProfile(Request $request) {
        if (Session::has('adminSession')) {
            if ($request->isMethod('post')) {
                $data = $request->all();
                $email = Auth::user()->email;
                User::where(['email' => $email])->update(['full_name' => $data['fname'], 'contact_adress' => $data['address'], 'telephone' => $data['tel']]);
                return redirect('/admin/dashboard')->with('flash_message_success', 'Profile Updated Successfully');
            } else {
                return view('admin.profile');
            }
        } else {
            return redirect('/')->with('flash_message_error', 'Access denied! Please Login first');
        }
    }

    public function logout(){
      Session::flush();
      return redirect('/')->with('flash_message_success', 'Be blessed! See you gain later');
    }
}
