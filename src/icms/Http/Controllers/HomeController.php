<?php 

namespace ICMS\Http\Controllers;

use Illuminate\Http\Request;
use ICMS\Http\Requests;
use Config;

class HomeController extends Controller {
	public function index($lang = 2)
	{
		return Config::get('app.locale');
	}
}