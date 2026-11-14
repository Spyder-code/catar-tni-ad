<?php

namespace App\Http\Middleware;

use App\Models\Visitor as ModelsVisitor;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Stevebauman\Location\Facades\Location;

class Visitor
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        $ip = $request->getClientIp();

        // Lookup geolokasi eksternal HANYA untuk IP publik. Untuk IP privat/reserved
        // (loopback atau IP internal Docker/proxy) library geolokasi mencoba seluruh
        // driver fallback dan memakan ~600ms per request tanpa hasil apa pun.
        // Hasil untuk IP publik di-cache 1 hari agar tidak memanggil API tiap request.
        $isPublic = filter_var(
            $ip,
            FILTER_VALIDATE_IP,
            FILTER_FLAG_NO_PRIV_RANGE | FILTER_FLAG_NO_RES_RANGE
        );

        if ($isPublic) {
            $location = Cache::remember('visitor_loc_' . $ip, now()->addDay(), function () use ($ip) {
                $data = Location::get($ip);

                return $data && $data->cityName ? $data->cityName : 'Indonesia';
            });
        } else {
            $location = 'Indonesia';
        }

        $visitor = ModelsVisitor::where('ip', $ip)->first();

        if ($visitor != null) {
            $visitor->update([
                'count' => $visitor->count + 1,
                'location' => $location,
            ]);
        } else {
            ModelsVisitor::create([
                'ip' => $ip,
                'count' => 1,
                'location' => $location,
            ]);
        }

        return $next($request);
    }
}
