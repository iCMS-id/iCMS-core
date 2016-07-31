<?php 
namespace Package\DummyPackage\Http\Controllers;

use ICMS\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DummyController extends Controller {

	public function index()
	{
		return 'index';
	}
}