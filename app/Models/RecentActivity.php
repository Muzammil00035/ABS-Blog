<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RecentActivity extends Model
{
    use HasFactory;
    protected $table = "recent_activity";

    protected $fillable = [
        'user_id',
        'ip',
        'country',
        'last_login',
        'last_logout',
    ];
}
