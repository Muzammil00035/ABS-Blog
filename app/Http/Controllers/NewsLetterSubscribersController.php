<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class NewsLetterSubscribersController extends Controller
{
    public function listSubscribers(Request $request)
    {
        // $list = NewsFeedSubscribers::all();
        // Select * from news_feed_subscribers LEFT JOIN users on users.email = news_feed_subscribers.email;
        $list = DB::table('news_feed_subscribers')
            ->leftjoin('users', 'users.email', '=', 'news_feed_subscribers.email')
            ->get(['news_feed_subscribers.email' , 'users.name']);

        return view("back.newsfeedsubscribers.index", compact('list'));
    }
}
