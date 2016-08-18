<?php

namespace ICMS\Http\Controllers;

use Illuminate\Http\Request;

use ICMS\Http\Requests;

class EventController extends Controller
{
    public function index()
    {
    	return view('admin.event.index');
    }

    public function comming()
    {
    	return 'upcomming';
    }

    public function ajax(Request $request)
    {
    	$data = ['results' => []];
    	return response()->json($data);
    }
}
