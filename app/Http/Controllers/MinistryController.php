<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;
use App\Ministry;

class MinistryController extends Controller
{
    public function index(){
      if (Session::has('adminSession')) {
        $title = "NEHEM | Ministries";
        $ministries = Ministry::get();
        return view('ministry.index')->with(compact('title', 'ministries'));
    }else{
      return Redirect::back()->with('flash_message_error', 'Access denied');
    }
  }
  public function delete(Request $request, $id = null){
    if (Session::has('adminSession')) {
      if (!empty($id)) {
        Ministry::where(['id' => $id])->delete();
        return redirect()->back()->with('flash_message_success', 'Ministry Deleted Successfully');
      }
  }else{
    return Redirect::back()->with('flash_message_error', 'Access denied');
  }
}
}
