<?php namespace Laracasts\Flash;


use Closure;
use Illuminate\Contracts\Routing\Middleware;
use Illuminate\Contracts\View\Factory as ViewFactory;

class ShareFlashNotificationFromSession implements Middleware {

    /**
     * The view factory implementation.
     *
     * @var \Illuminate\Contracts\View\Factory
     */
    protected $view;


    /**
     * @param \Illuminate\Contracts\View\Factory $view
     */
    function __construct(ViewFactory $view)
    {
        $this->view = $view;
    }


    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $this->view->share(
            'flash_notification', $request->session()->get('flash_notification'));

        return $next($request);
    }
}