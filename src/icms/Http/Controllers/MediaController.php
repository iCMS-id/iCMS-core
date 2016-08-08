<?php

namespace ICMS\Http\Controllers;

use Illuminate\Http\Request;

use ICMS\Http\Requests;

class MediaController extends Controller
{
    public function index()
    {
    	return view('admin.media.index');
    }
}
