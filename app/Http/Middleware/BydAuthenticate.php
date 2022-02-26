<?php

namespace App\Http\Middleware;

use App\Facades\BydAuth;
use Closure;

class BydAuthenticate
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return string|null
     */
    public function handle($request, Closure $next)
    {
        if (!BydAuth::check()) { // 非ログインはログインページに飛ばす
            return redirect('/login');
        }

        return $next($request);
    }
}
