<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;
use App\User;
use App\Ministry;
use App\Department;

class DashboardController extends Controller
{
    public function index(){
      if (Session::has('adminSession')) {
        // get number of user
        $total_users = User::where(['role' => 1])->count();
        //get number of departments
          $total_departments = Department::count();
        //get number of ministries
        $total_ministries = Ministry::count();
        //get number of members
        $total_members = User::where(['role' => 2])->count();

        $title = "NEHEM | ADMIN DASHBOARD";
         return view('admin.dashboard')->with(compact('title','total_users','total_members','total_departments','total_ministries'));
     } else if (Session::has('userSession')) {
         $title = "NEHEM | USER DASHBOARD";
         return view('user.dashboard')->with(compact('title'));
     }else{
         return redirect('/')->with('flash_message_error', 'Access Denied');
    }
}
}
