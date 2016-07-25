<?php 

namespace ICMS\Http\Controllers;

use Illuminate\Http\Request;
use ICMS\Http\Requests;
use Theme;
use Config;

class AdminController extends Controller {
	public function index()
	{
		return view('admin.index');
	}
}