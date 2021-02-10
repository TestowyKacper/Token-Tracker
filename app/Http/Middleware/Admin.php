<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class Admin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {

        
        
     if (Auth::user() &&  Auth::user()->status == 1) {
        return redirect('portfel')->with('error','Strona dostępna tylko dla adminsitratora.');
 }
 return $next($request);

    }
}
