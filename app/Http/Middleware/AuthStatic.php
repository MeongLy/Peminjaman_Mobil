<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AuthStatic
{
    /**
     * Proteksi route statis (belum pakai Auth Laravel).
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (!session('user')) {
            return redirect()
                ->route('login')
                ->withErrors(['email' => 'Silakan login terlebih dahulu.']);
        }

        return $next($request);
    }
}
