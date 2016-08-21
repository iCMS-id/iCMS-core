<?php
namespace ICMS\Http\Middleware;

use Menu;

class WebPage {

	public function handle($request, Closure $next, $guard = null)
	{
		return $next($request);
	}
}