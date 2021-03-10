<?php

namespace App\Http\Middleware;

use App\Quotation;
use Closure;

class BeforeUpdateDesign
{
    public function handle($request, Closure $next)
    {
        $status = Quotation::status($request->quotation);
        if (!$tatus->state_id === 3) {
            return $next($request);
        }

        return response()->json([
            'success' => false,
            'message' => 'Denied',
        ], 401);
    }
}
