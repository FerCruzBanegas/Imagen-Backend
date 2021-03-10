<?php

namespace App\Http\Middleware;

use Closure;
use App\Quotation;

class CheckOffice
{
    public function handle($request, Closure $next)
    {
        $office = $request->quotation->office->id;
        if (auth()->user()->office->id === $office) {
            return $next($request);
        }

        return response()->json([
            'success' => false,
            'message' => message('MSG010'),
        ], 403);
    }
}
