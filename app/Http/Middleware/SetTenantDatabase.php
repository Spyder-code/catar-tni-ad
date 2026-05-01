<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;

class SetTenantDatabase
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        $host = $request->getHost(); 
        // contoh: daftar1.ajenram82.my.id

        // ambil prefix subdomain
        $subdomain = explode('.', $host)[0];

        // mapping database
        $databaseMap = [
            'daftar1' => 'catar',
            'daftar2' => 'catar_agama',
        ];

        $database = $databaseMap[$subdomain] ?? 'catar';

        // override config database
        Config::set('database.connections.mysql.database', $database);

        // reconnect agar pakai DB baru
        DB::purge('mysql');
        DB::reconnect('mysql');

        return $next($request);
    
    }
}
