<?php

namespace App\Http\Middleware;

use Closure;

class isAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, ...$statuses)
    {
        // jika status ditabel user sama dengan status = 1
        if(in_array($request->user()->status,$statuses)){
            return $next($request);
        }
        // jika tidak ada 
        return redirect('/admin/products');
    }
}
