<?php 

namespace ICMS\Http\Controllers;

use Illuminate\Http\Request;
use ICMS\Http\Requests;
use Config;
use View;

class HomeController extends Controller {
	public function index($lang = 2)
	{
		$data = View::make('admin.a')->render();
		$base = View::make('layouts.base.admin');
		$base->getFactory()->inject('content', $data);
		return $base->render();
	}
}