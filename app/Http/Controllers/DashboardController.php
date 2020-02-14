<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;

class DashboardController extends Controller
{
    public function index(){
      if (Session::has('adminSession')) {
        $title = "NEHEM | ADMIN DASHBOARD";
         return view('admin.dashboard')->with(compact('title'));
     } else if (Session::has('userSession')) {
         $title = "NEHEM | ADMIN DASHBOARD";
         return view('user.dashboard')->with(compact('title'));
     }else{
         return redirect('/')->with('flash_message_error', 'Access Denied');
    }
}
}
