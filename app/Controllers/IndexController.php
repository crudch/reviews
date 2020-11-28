<?php

namespace App\Controllers;

use System\Foundation\Controller;

class IndexController extends Controller
{

    public function index()
    {
        return view('/index');
    }
}
