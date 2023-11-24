<?php

namespace RajenTrivedi\TransactionX\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpFoundation\Response;

class TransactionMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        DB::beginTransaction();
        $response = $next($request);

        if ($request->method() !== 'GET') {
            if ($response->exception || app()->bound('errors') && app('errors')->any()) {
                DB::rollBack();
            } else {
                DB::commit();
            }
        }

        return $response;
    }
}
