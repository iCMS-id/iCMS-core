<?php 

namespace ICMS\Http\Controllers;

use Illuminate\Http\Request;
use ICMS\Http\Requests;
use Config;
use View;

class HomeController extends Controller {
	public function index()
	{
		return view('app.index');
	}
}