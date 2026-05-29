<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckPlayerOffline
{
    public function handle(Request $request, Closure $next): Response
    {
        if (auth()->check() && auth()->user()->Online != 0) {
            return back()->with('error', 'Vui long thoat game truoc khi thao tac tren UCP.');
        }

        return $next($request);
    }
}
