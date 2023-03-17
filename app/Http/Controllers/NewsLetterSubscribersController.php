<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\NewsFeedSubscribers;


class NewsLetterSubscribersController extends Controller
{
    public function listSubscribers(Request $request)
    {
        $list = NewsFeedSubscribers::all();

        return view("back.newsfeedsubscribers.index" , compact('list'));
    }
}
