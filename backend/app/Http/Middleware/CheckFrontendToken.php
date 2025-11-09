<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CheckFrontendToken
{
    public function handle(Request $request, Closure $next)
    {
        $validToken = env('FRONTEND_SECRET', 'vue-access-123');
        $token = $request->header('X-Frontend-Token');

        if ($token !== $validToken) {
            return response()->json(['error' => 'Acesso não autorizado.'], 403);
        }

        return $next($request);
    }
}
