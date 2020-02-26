<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MinistryController extends Controller
{
    public function index(){
      if (Session::has('adminSession')) {

    }else{
      return redirect
    }
  }
}
