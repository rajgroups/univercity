<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Models\Settings;

class MaintenanceMode
{
    public function handle(Request $request, Closure $next)
    {
        $setting = Settings::first();

        if ($setting && $setting->maintenance_mode == 1) {
            if ($request->is('admin/*')) {
                return $next($request);
            }
            return response()->view('web.maintenance');
        }

        return $next($request);
    }
}
