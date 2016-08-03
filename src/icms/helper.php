<?php 

function resolveRoute($route) {
	$x = app('request')->path();
	list($lang) = explode('/', $x);

	if (strlen($lang) !=2)
		$lang = app('config')['app.locale'];

	return route($route, ['lang' => $lang]);
}