<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;

class AccountController extends Controller
{
    public function welcome() {
        return view('tasks.welcome');
    }
    
    public function login() {    
        return view('tasks.login');
    }

    public function newuser() {    
        return view('tasks.newuser');
    }
}
