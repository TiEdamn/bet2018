<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Helper\UserHelper;
use App\User;
use Illuminate\Http\Request;

use App\Http\Requests;

class TestController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');

        if(!UserHelper::isAdmin())
            return abort(404);
    }

    public function index() {
        echo date("Y-m-d 00:00:00", mktime(0, 0, 0, date("m") , date("d")+1,date("Y")));
    }
}
