<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{

    public function index()
    {
        return view('dashboardadmin');
    }
    public function operator()
    {
        return view('dashboardoperator');
    }

}
