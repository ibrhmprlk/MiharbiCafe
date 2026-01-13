<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class NoCache
{
    public function handle(Request $request, Closure $next): Response
    {
        $response = $next($request);

        // Tarayıcıya "sakın cacheleme" diye haykırıyoruz
        $response->headers->set('Cache-Control', 'no-cache, no-store, must-revalidate, max-age=0, private');
        $response->headers->set('Pragma', 'no-cache');
        $response->headers->set('Expires', 'Fri, 01 Jan 1990 00:00:00 GMT');
        
        // Ekstra: IE/Edge için
        $response->headers->set('X-Content-Type-Options', 'nosniff');
        $response->headers->set('X-Frame-Options', 'DENY');
        
        // HSTS varsa dikkat: (genelde gerek yok)
        // $response->headers->set('Strict-Transport-Security', 'max-age=31536000; includeSubDomains');

        // ÖNEMLİ: Auth sayfalarında back-forward cache'i kapat
        $response->headers->set('Cache-Control', 'no-store, no-cache, must-revalidate, proxy-revalidate, max-age=0');

        return $response;
    }
}