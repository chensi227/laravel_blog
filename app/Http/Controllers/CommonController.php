<?php

namespace App\Http\Controllers;

use App\Model\Navs;
use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\View;

class CommonController extends Controller
{
    public function __construct()
    {
        $navs = Navs::all();
        View::share('navs',$navs);
    }



}
