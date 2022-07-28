<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SiteController extends Controller
{
    //

    public function index(){
        echo "this is home ";
    }

    public function about(){
        echo "we are on about";
    }

    public function contact(){
        echo "we are on contact";
    }
}
