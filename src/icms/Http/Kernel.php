<?php 

namespace ICMS\Http;

use Illuminate\Foundation\Http\Kernel as HttpKernel;
use Illuminate\Http\Response;
use Redirect;

class Kernel extends HttpKernel
{
    protected $except = [
        'images/*'
    ];
    /**
     * The application's global HTTP middleware stack.
     *
     * These middleware are run during every request to your application.
     *
     * @var array
     */
    protected $middleware = [
        \Illuminate\Foundation\Http\Middleware\CheckForMaintenanceMode::class,
    ];

    /**
     * The application's route middleware groups.
     *
     * @var array
     */
    protected $middlewareGroups = [
        'web' => [
            \ICMS\Http\Middleware\EncryptCookies::class,
            \Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse::class,
            \Illuminate\Session\Middleware\StartSession::class,
            \Illuminate\View\Middleware\ShareErrorsFromSession::class,
            \ICMS\Http\Middleware\VerifyCsrfToken::class,
            \ICMS\Http\Middleware\LangMiddleware::class,
        ],

        'api' => [
            'throttle:60,1',
        ],
    ];

    /**
     * The application's route middleware.
     *
     * These middleware may be assigned to groups or used individually.
     *
     * @var array
     */
    protected $routeMiddleware = [
        'auth' => \ICMS\Http\Middleware\Authenticate::class,
        'auth.basic' => \Illuminate\Auth\Middleware\AuthenticateWithBasicAuth::class,
        'can' => \Illuminate\Foundation\Http\Middleware\Authorize::class,
        'guest' => \ICMS\Http\Middleware\RedirectIfAuthenticated::class,
        'throttle' => \Illuminate\Routing\Middleware\ThrottleRequests::class,
    ];

    public function handle($request)
    {
        $response = parent::handle($request);
        $redirect = $this->checkLangRoute($request);
        if ($redirect === false) {
            return $response;
        }

        return $redirect;
    }

    protected function checkLangRoute($request)
    {
        $lang = $this->app['config']['app.locale'];
        $path = $request->path();
        list($lang_url) = explode('/', $path);

        if ($this->isExcepted($path)) {
            return false;
        }

        if (strlen($lang_url) != 2) {
            return Redirect::to($lang . '/' . $path);
        } else {
            $this->app['config']->set('app.locale', $lang_url);
        }

        return false;
    }

    protected function isExcepted($path)
    {
        foreach ($this->except as $except) {
            if (fnmatch($except, $path))
                return true;
        }

        return false;
    }
}
