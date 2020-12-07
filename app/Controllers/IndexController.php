<?php

namespace App\Controllers;

use System\Http\Response;
use Cocur\Slugify\Slugify;
use App\Requests\CabinetRequest;
use System\Foundation\Controller;

class IndexController extends Controller
{

    public function index(): Response
    {
        return view('/index');
    }

    public function test(CabinetRequest $request, Slugify $slugify)
    {
        $text = $slugify->slugify($request->input('avatar'));

        return json([$text]);
    }
}
