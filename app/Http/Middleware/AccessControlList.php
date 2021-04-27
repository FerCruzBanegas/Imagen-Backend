<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Cache;

class AccessControlList
{
    public function handle($request, Closure $next)
    {
        $route = $request->route()->getName();
        $cache = Cache::get('actions_' . auth()->user()->id);
        if ($cache == null) {
            return response()->json([
                'success' => false,
                'message' => message('MSG009'),
            ], 401);
        }

        if (!in_array($route, $cache) && !in_array('*', $cache) && $route) {
            return response()->json(['success' => false], 403);
        } else if($route == 'quotations.show') {
            $office = $request->quotation->office->id;
            if ((in_array('quotations.show', $cache) && auth()->user()->office->id === $office) || in_array('quotations.showall', $cache) || in_array('*', $cache)) {
                return $next($request);
            } else {
                return response()->json(['message' => message('MSG010')], 403);
            }
        } else {
            return $next($request);
        }
    }
}
