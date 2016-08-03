<?php

namespace ICMS\Http\Controllers;

use Illuminate\Http\Request;

use ICMS\Http\Requests;

class RolesController extends Controller
{
    public function add()
    {
    	return view('admin.role.add');
    }
}
