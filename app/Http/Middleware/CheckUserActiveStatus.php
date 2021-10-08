<?php


namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpKernel\Exception\HttpException;

class CheckUserActiveStatus
{
    public function handle(Request $request, Closure $next)
    {
        if ($request->user()->deactivated_at) {
            throw new HttpException(403, 'Your account has been deactivated.');
        }

        return $next($request);
    }
}