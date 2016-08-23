<?php
namespace ICMS\Http\Middleware;

use Closure;
use Menu;

class WebPage {

	public function handle($request, Closure $next, $guard = null)
	{
		Menu::setMode('web');
		return $next($request);
	}
}