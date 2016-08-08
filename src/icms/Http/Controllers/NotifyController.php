<?php

namespace ICMS\Http\Controllers;

use Illuminate\Http\Request;

use ICMS\Http\Requests;

class NotifyController extends Controller
{
    public function index()
    {
    	return view('admin.notify.index');
    }
}
