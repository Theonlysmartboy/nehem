<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;

class DashboardController extends Controller
{
    public function index(){
      if (Session::has('adminSession')) {
         return view('admin.dashboard');
     } else if (Session::has('userSession')) {
         return view('user.dashboard');
     }else{
         return redirect('/')->with('flash_message_error', 'Access Denied');
    }
}
}
