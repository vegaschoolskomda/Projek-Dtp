<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EnsureHasDailyAttendance
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next): Response
    {
        $user = $request->user();

        if (! $user || $user->hasAttendedToday()) {
            return $next($request);
        }

        return redirect()
            ->route('absensi.index')
            ->with('warning', 'Anda wajib melakukan absensi harian terlebih dahulu.');
    }
}
