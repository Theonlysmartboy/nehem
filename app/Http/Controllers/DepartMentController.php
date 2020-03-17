<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;
use App\Department;

class DepartMentController extends Controller
{
    public function index(){
      if (Session::has('adminSession')) {
        $title = "NEHEM | Departments";
        $departments = Department::get();
        return view('department.index')->with(compact('title', 'departments'));
    }else{
      return redirect()->back()->with('flash_message_error', 'Access denied');
    }
    }
    public function showAddDepartmentForm(){
      if (Session::has('adminSession')) {
          $title = "NEHEM | Department";
          return view('department.create')->with(compact('title'));
      }
      else{
        return redirect()->back()->with('flash_message_error', 'Access denied');
      }

    }
    public function create(Request $request){

    }
    public function showEditDepartmentForm($id = null){

    }

}
