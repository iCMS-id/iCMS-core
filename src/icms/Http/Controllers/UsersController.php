<?php

namespace ICMS\Http\Controllers;

use Illuminate\Http\Request;

use ICMS\Http\Requests;

class UsersController extends Controller
{
    public function index()
    {
    	return view('admin.users.index');
    }
}
