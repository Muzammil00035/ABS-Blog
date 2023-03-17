<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UsersController extends Controller
{
    public function recentActivty(Request $request)
    {
        $list = User::join('recent_activity', 'recent_activity.user_id', '=', 'users.id')
            ->orderBy("recent_activity.created_at", "desc")
            ->get(['name', 'email', 'ip', 'country', 'last_login', 'last_logout'])
        ;
        return view("back.recent_activity.index", compact("list"));
    }
}
