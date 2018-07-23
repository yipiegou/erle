<?php

namespace App\Http\Controllers\Shop;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class BaseController extends Controller
{
    //
    public function __construct()
    {
        //$this->middleware('auth');
        $this->middleware('auth')->except("login");
        $this->middleware("guest")->only('login');
    }
}
