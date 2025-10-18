<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Models\Admin\BusType;

class HomeController extends Controller
{
    function index(){
        $bus= BusType::get();
        return view('layout',compact('bus'));
    }
}
