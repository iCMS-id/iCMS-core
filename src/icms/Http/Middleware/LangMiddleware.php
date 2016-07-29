<?php 

namespace ICMS\Http\Middleware;

use Route;
use Config;
use Closure;

class LangMiddleware {
	public function handle($request, Closure $next, $guard = null)
	{
		$lang = $request->lang;
		$request->route()->forgetParameter('lang');

		if (strlen($lang) == 2) {
			Config::set('app.locale', $lang);
		} else {
			$lang = Config::get('app.locale');

			return redirect($lang . "\\" . $request->path());
		}
		
		return $next($request);
	}
}