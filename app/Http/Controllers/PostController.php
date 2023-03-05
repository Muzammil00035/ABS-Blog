<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class PostController extends Controller
{

    public function __construct()
    {
        $this->middleware('authResource:post')->except('index', 'create', 'store');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        if(auth()->user()->role =="user"){
            $posts = auth()->user()->posts;
        }else{
            $posts = Post::all();
        }
        return view('back.posts.index', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::get();
        return view('back.posts.create', compact("categories"));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // dd($request);
        try {
            $validator = Validator::make($request->all(), [
                'title' => 'required|unique:posts|max:255',
                'body' => 'required',
                'excerpt' => "required",
                'category' => "required",
            ]);

            if ($validator->fails()) {
                // return $validator->errors()->first();
                return redirect()->back()->with("error", $validator->errors()->first());

            }
            //code...

            $img = "";
            $interLinkImage = null;
            if ($request->has('image')) {
                $this->uploadImage($request);
                $img = $request->post()['image'];
            }
            if ($request->has('interlink_image')) {
                $this->uploadInterLinkImage($request);
                $interLinkImage = $request->post()['interlink_image'];
            }

            // dd($request->post());

            $checkIfSlugExist = Post::where("slug", Str::slug($request->title))->get();
            if (count($checkIfSlugExist) > 0) {
                return redirect()->route('posts.index')->with('error', 'Article with same title already exist');
            } else {

                $postCreate = Post::create([
                    "user_id" => $request->user()->id,
                    "title" => $request->title,
                    "excerpt" => $request->excerpt,
                    "body" => $request->body,
                    "image" => $img,
                    "featured" => $request->featured ? true : false,
                    "interlink" => $request->interlink ? true : false,
                    "url" => $request->post_url ? $request->post_url : null,
                    "interlink_image" => $interLinkImage,
                    "time_in_second" => $request->seconds ? $request->seconds : null,
                ]);
                if (!empty($postCreate)) {
                    // $addCategory = CategoryPost::create([
                    //     "post_id" => $postCreate->id,
                    //     "category_id"=> $request->category
                    // ]);
                    // if(!empty($addCategory)){
                    //     return redirect()->route('posts.index')->with('message', 'Post created successfully');

                    // }else{
                    return redirect()->route('posts.index')->with('success', 'Post created successfully.');

                    // }
                } else {
                    return redirect()->route('posts.index')->with('error', 'Post created failed');

                }
            }
        } catch (\Exception$th) {
            return $th;
        }
        // $abc = $request->user()->posts()->create($request->post());

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        $categories = Category::get();
        $post = Post::with("categories")->find($post->id);
        // return $post;
        return view('back.posts.edit', [
            'post' => $post,
            'categories' => $categories,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Post $post)
    {
        // the update method, only fire its events when the update happens directly on the model,
        // so we will use save directly on modal instead of mass assignment
        if ($request->has('image')) {
            $oldImage = $post->image;
            if($oldImage){
                if (file_exists(public_path('images/' . $oldImage))) {
                    unlink(public_path('images/' . $oldImage));
                }
            }
            $this->uploadImage($request);
            $post->image = $request->post()['image'];
        }
        if ($request->has('interlink_image')) {
            $oldImage = $post->interlink_image;
            if($oldImage){
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
        $post->interlink = $request->interlink == "on" ? true : false;
        $post->time_in_second = $request->seconds < 0 ? 0 : $request->seconds;
        $post->save();

        return back()->with('message', 'Post updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        $post->delete();
        return back();
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

}
