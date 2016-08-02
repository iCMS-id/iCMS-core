<?php 

namespace ICMS\Http\Middleware;

use Route;
use Config;
use Closure;

class LangMiddleware {
	
	public function handle($request, Closure $next, $guard = null)
	{
		$request->route()->forgetParameter('lang');
		
		return $next($request);
	}
	
}