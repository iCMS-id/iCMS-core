<?php
namespace ICMS\Http\Controllers;

use Illuminate\Http\Request;
use Package;

class AppController extends Controller {
	public function index()
	{
		return ;
	}

	public function ajax(Request $request)
	{
		$data = ['results' => []];
		$package = Package::getPackage($request->apps);

		if (!is_null($package)) {
			$providesRoute = $package->getProvidesRoute();
		}

		foreach ($providesRoute as $name => $route) {
			$data['results'][] = ['id' => $route, 'text' => $name];
		}

		return response()->json($data);
	}
}