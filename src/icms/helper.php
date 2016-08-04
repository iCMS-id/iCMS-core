<?php 

function resolveRoute($route, $param = []) {
	$x = app('request')->path();
	list($lang) = explode('/', $x);

	if (strlen($lang) !=2)
		$lang = app('config')['app.locale'];

	return route($route, array_merge($param, ['lang' => $lang]));
}