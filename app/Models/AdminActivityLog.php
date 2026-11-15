<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AdminActivityLog extends Model
{
    public $timestamps = false;

    protected $fillable = [
        'user_id', 'user_name', 'user_role', 'action', 'method',
        'route_name', 'path', 'status_code', 'ip_address', 'user_agent',
    ];

    protected $casts = ['created_at' => 'datetime'];
}
