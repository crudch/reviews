<?php

namespace App\Controllers;

use System\Http\Response;
use System\Foundation\Controller;

class IndexController extends Controller
{

    public function index(): Response
    {
        return view('/index');
    }
}
