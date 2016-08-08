<?php

namespace ICMS\Http\Controllers;

use Illuminate\Http\Request;

use ICMS\Http\Requests;

class PageController extends Controller
{
    public function index()
    {
    	return view('admin.page.index');
    }
}
