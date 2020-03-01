<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;
use Redirect;
use UxWeb\SweetAlert\SweetAlert;
use App\Ministry;

class MinistryController extends Controller
{
    public function index(){
      if (Session::has('adminSession')) {
        $title = "NEHEM | Ministries";
        $ministries = Ministry::get();
        return view('ministry.index')->with(compact('title', 'ministries'));
    }else{
      return redirect()->back()->with('flash_message_error', 'Access denied');
    }
  }
  public function showEditMinistryForm($id = null){
  if (Session::has('adminSession')) {
    if (!empty($id)) {
      $title = "NEHEM | Ministries";
      $ministryDetails = Ministry::where(['id' =>$id])->first();
      return view('ministry.edit')->with(compact('title', 'ministryDetails'));
    }
  }
  else{
    return redirect()->back()->with('flash_message_error', 'Access denied');
  }
}
public function update(Request $request, $id=null){
  if (Session::has('adminSession')) {
    if (!empty($id)) {
      $newTitle = $request['title'];
      $newDescription = $request['desc'];
      Ministry::where(['id' => $id])->update(['title' => $newTitle, 'desc' => $newDescription]);
      return redirect('/ministry/view')->with('flash_message_success', 'Ministry details updated Successfully');
    }
  }else{
    return redirect()->back()->with('flash_message_error', 'Access denied');
  }
}
public function delete($id = null){
  if (Session::has('adminSession')) {
    if (!empty($id)) {
      Ministry::where(['id' => $id])->delete();
      return redirect()->back()->with('flash_message_success', 'Ministry Deleted Successfully');
    }
}else{
  return redirect()->back()->with('flash_message_error', 'Access denied');
  }
  }
}
