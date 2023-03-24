<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\NewsFeedSubscribers;
use App\Models\Post;
use App\Models\PostHeaders;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

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
            $base_url . "posts/" . $post->id,
            // "https://fast.com/",
            $post->title,
        )
            ->facebook()
            ->twitter()
            ->linkedin()
            ->telegram()
            ->whatsapp()
            ->reddit();
        //    return $post;
        return view('front.posts.show', compact('post', 'categories', 'shareComponent'));
    }

    public function showPostSlug(Request $request, $slug)
    {

        $post = Post::with('user', 'categories', 'headers')->where("slug", $slug)->first();
        if ($post) {
            // $post = $post->load('user', 'categories', 'headers');
            $categories = Category::get();
            $base_url = env("BASE_URL");
            // return $base_url."posts/".$post->id;
            // return route("posts-slug.view" ,$post->id);
            $shareComponent = \Share::page(
                route("posts-slug.view" ,$post->slug),
                // "https://fast.com/",
                $post->title,
            )
                ->facebook()
                ->twitter()
                ->linkedin()
                ->telegram()
                ->whatsapp()
                ->reddit();
            //    return $post;
            return view('front.posts.show', compact('post', 'categories', 'shareComponent'));
        } else {
            return redirect()->back();
        }

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
            if ($user_detail) {

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
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function editPost(Post $post, Request $request)
    {
        $categories = Category::get();
        $posts = "";
        if ($request->user()->isAdmin()) {
            $posts = Post::with("categories", "headers")->find($post->id);
        } else {
            $posts = Post::with("categories", "headers")->where("id", $post->id)->where("user_id", $request->user()->id)->first();
        }

        if (!empty($posts)) {
            return view('back.posts.edit', [
                'post' => $posts,
                'categories' => $categories,
            ]);
        } else {
            return redirect()->route('posts.index')->with('error', 'Un authorized');
        }
        // return $post;

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function updatePost(Request $request, Post $post)
    {
        // the update method, only fire its events when the update happens directly on the model,
        // so we will use save directly on modal instead of mass assignment

        // return dd($request->data_head);
        // if(isset($request->data_head[0]))
        // $arr=[];
        // foreach ($request->data_head as $key => $value) {
        //     if (array_key_exists("id", $value)) {
        //         // return $value;
        //         $post_head = PostHeaders::find($value['id']);
        //         $post_head->heading = "Hello";
        //         $post_head->save();
        //         array_push($arr,$value['id']);
        //     }}
        // return $arr;
        // return gettype($request->data_head[0]);
        // dd($request);
        DB::beginTransaction();

        try {
            if ($request->has('image')) {
                $oldImage = $post->image;
                if ($oldImage) {
                    if (file_exists(public_path('images/' . $oldImage))) {
                        unlink(public_path('images/' . $oldImage));
                    }
                }
                $this->uploadImage($request);
                $post->image = $request->post()['image'];
            }
            if ($request->has('interlink_image')) {
                $oldImage = $post->interlink_image;
                if ($oldImage) {
                    if (file_exists(public_path('images/' . $oldImage))) {
                        unlink(public_path('images/' . $oldImage));
                    }
                }
                $this->uploadInterLinkImage($request);

                $post->interlink_image = $request->post()['interlink_image'];
            }

            $post->title = $request->title;

            $post->excerpt = $request->excerpt;
            $post->body = $request->body;
            $post->url = $request->post_url;
            $post->slug = Str::slug($request->slug);
            $post->meta_title = $request->meta_title;
            $post->featured = $request->featured ? true : false;
            $post->meta_description = $request->meta_description;
            $post->interlink = $request->interlink == "on" ? true : false;
            $post->time_in_second = $request->seconds < 0 ? 0 : $request->seconds;
            $post->btn_text = $request->btn_text;
            if ($post->save()) {
                if ($request->data_head) {
                    if (count($request->data_head) > 0) {
                        $idsDelete = [];
                        foreach ($request->data_head as $key => $value) {
                            if (array_key_exists("id", $value)) {
                                array_push($idsDelete, $value['id']);
                            }
                        }

                        // return $idsDelete;
                        if (count($idsDelete) > 0) {
                            $deleteItems = PostHeaders::whereNotIn("id", $idsDelete)->delete();
                            // return $deleteItems;
                        }

                        foreach ($request->data_head as $key => $value) {
                            // return $request->data_head;
                            if (array_key_exists("id", $value)) {

                                $post_headers = PostHeaders::find($value['id']);

                                if ($post_headers) {
                                    $post_headers->heading = $value['heading'];
                                    $post_headers->description = $value['description'];
                                    if (array_key_exists("head_image", $value)) {
                                        $oldImage = $post_headers->image;
                                        if ($oldImage) {
                                            if (file_exists(public_path('images/' . $oldImage))) {
                                                unlink(public_path('images/' . $oldImage));
                                            }
                                        }
                                        $ImgName = $this->uploadDataHeadImage($request, $key);

                                        $post_headers->image = $ImgName;
                                    }
                                    $post_headers->save();

                                }

                            }
                            else {
                                $post_head = new PostHeaders();
                                $post_head->heading = $value['heading'];
                                $post_head->description = $value['description'];
                                $post_head->post_id = $post->id;
                                if ($request->file('data_head')[$key]['head_image']) {
                                    $ImgName = $this->uploadDataHeadImage($request, $key);

                                    $post_head->image = $ImgName;
                                }
                                $post_head->save();
                            }

                        }
                    } else {
                        $deleteItems = PostHeaders::where("post_id", $post->id)->get();
                        if (count($deleteItems) > 0) {
                            $deleteItems = PostHeaders::where("post_id", $post->id)->delete();
                        }
                    }
                }

                DB::commit();
                return back()->with('message', 'Post updated successfully');
            } else {
                return back()->with('error', 'Error Occured');
            }

        } catch (\Exception$th) {
            DB::rollback();
            // return redirect()->route('posts.create')->with('error', $th->getMessage());
            return $th;

        }
    }

    public function uploadImage($request)
    {
        $image = $request->file('image');
        $imageName = time() . $image->getClientOriginalName();
        // add the new file
        $image->move(public_path('images'), $imageName);
        $request->merge(['image' => $imageName]);
        // dd($request);
    }
    public function uploadInterLinkImage($request)
    {
        $image = $request->file('interlink_image');
        $imageName = time() . $image->getClientOriginalName();
        // add the new file
        $image->move(public_path('images'), $imageName);
        $request->merge(['interlink_image' => $imageName]);
        // dd($request);
    }

    public function uploadDataHeadImage($request, $key)
    {
        $image = $request->file('data_head')[$key]['head_image'];
        $imageName = time() . $image->getClientOriginalName();
        // add the new file
        $image->move(public_path('images'), $imageName);
        return $imageName;
    }
}
