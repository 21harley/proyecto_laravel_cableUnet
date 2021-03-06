<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index(){
        return "home";
    }
    public function show($id){
        return "show{$id}";
    }
}
