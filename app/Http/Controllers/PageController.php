<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\NewsFeedSubscribers;
use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PageController extends Controller
{
    public function index()
    {
        $posts = Post::where('featured', false)
            ->with('user', 'categories')
            ->get();
        $category = Category::get();
        $featured = Post::featured()->take(10)->get();
        // dd($featured);
        return view('front.index', [
            'posts' => $posts,
            'featured' => $featured,
            'categories' => $category,
        ]);
    }

    public function posts()
    {
        return view('posts.index');
    }

    public function showPost(Post $post)
    {
        $post = $post->load('user', 'categories', 'headers');
        $categories = Category::get();
        $base_url = env("BASE_URL");
        // return $base_url."posts/".$post->id;
        $shareComponent = \Share::page(
            // $base_url."posts/".$post->id,
            "https://fast.com/",
            $post->title,
        )
            ->facebook()
            ->twitter()
            ->linkedin()
            ->reddit();
        //    return $post;
        return view('front.posts.show', compact('post', 'categories', 'shareComponent'));
    }

    public function showCategory(Category $category)
    {
        $posts = $category->posts()->get();
        $categories = Category::get();
        return view('front.categories.show', compact('category', 'posts', 'categories'));
    }
    public function showUser(Request $request, $id)
    {
        if ($id) {
            $user_detail = User::find($id);
            // return $user_detail;
            if ($id) {
                $posts = Post::with("categories", "headers")->where("user_id", $id)->orderBy("updated_at", "desc")->get();

                return view("front.profile.index", compact("user_detail", "posts"));
            } else {
                return back()->with("error", "Error Occured");
            }

        } else {
            return back()->with("error", "Error Occured");
        }
    }

    public function newsFeedSubscribe(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required',
        ]);

        if ($validator->fails()) {
            // return $validator->errors()->first();
            return redirect()->back()->with("error", $validator->errors()->first());

        }

        $newsFeed = NewsFeedSubscribers::create([
            'email' => $request->email,
        ]);

        if ($newsFeed) {
            return redirect()->back()->with("success", "Email has been subscribe");

        } else {
            return redirect()->back()->with("error", "Error Occured");

        }
    }

}
