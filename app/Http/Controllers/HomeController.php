<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends ApiController
{

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('home');
    }
}
