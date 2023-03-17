<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;
use App\Models\PostHeaders;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
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
        if (auth()->user()->role == "user") {
            $posts = auth()->user()->posts;
        } else {
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
        // dd(count($request->file('data_head')));
        // dd( array_push($request->data_head[0] , ['head_image' => "Good"]));

        DB::beginTransaction();

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
                    "slug" => Str::slug($request->slug),
                    "body" => $request->body,
                    "meta_title" => $request->meta_title,
                    "meta_description" => $request->meta_description,
                    "image" => $img,
                    "featured" => $request->featured ? true : false,
                    "interlink" => $request->interlink ? true : false,
                    "url" => $request->post_url ? $request->post_url : null,
                    "interlink_image" => $interLinkImage,
                    "time_in_second" => $request->seconds ? $request->seconds : null,
                ]);
                if (!empty($postCreate)) {
                    if ($request->data_head) {
                        if (count($request->data_head) > 0) {
                            // $collection = collect($request->data_head);
                            // // return $collection;
                            // $collection = $collection->map(function ($item, $key) use ($postCreate , $request) {
                            //     $item['post_id'] = $postCreate->id;
                            //     if ($item['image']) {

                            //         $item['imageExist'] = true;
                            //         if ($request->hasFile($item['image'])) {
                            //             $item['file'] = true;
                            //         }
                            //     }
                            //     return $item;
                            // });
                            // return $collection;
                            foreach ($request->data_head as $key => $value) {
                                // return $value;
                                // return $request->hasFile($value->head_image);
                                $post_head = new PostHeaders();
                                $post_head->heading = $value['heading'];
                                $post_head->description = $value['description'];
                                $post_head->post_id = $postCreate->id;
                                if ($request->file('data_head')[$key]['head_image']) {
                                    $name = $this->uploadDataHeadImage($request, $key);

                                    $post_head->image = $name;
                                }
                                $post_head->save();
                            }

                        }
                    }

                    DB::commit();
                    return redirect()->route('posts.index')->with('success', 'Post created successfully.');

                    // }
                } else {
                    return redirect()->route('posts.index')->with('error', 'Post created failed');

                }
            }
        } catch (\Exception$th) {
            DB::rollback();
            // return redirect()->route('posts.create')->with('error', $th->getMessage());
            return $th->getMessage();

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
        $post = Post::with("categories", "headers")->find($post->id);


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

        // return dd(array_key_exists("id",$request->data_head[0]));
        // if(isset($request->data_head[0]))
        // return $request->data_head;
        // return gettype($request->data_head[0]);
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
            $post->meta_description = $request->meta_description;
            $post->interlink = $request->interlink == "on" ? true : false;
            $post->time_in_second = $request->seconds < 0 ? 0 : $request->seconds;
            if ($post->save()) {
                if ($request->data_head) {
                    if (count($request->data_head) > 0) {
                        foreach ($request->data_head as $key => $value) {
                            if (array_key_exists("id", $value)) {
                                // return $value;
                                $post_head = PostHeaders::find($value['id']);
                                $post_head->heading = $value['heading'];
                                $post_head->description = $value['description'];
                                if (array_key_exists("head_image", $value)) {
                                    $oldImage = $post_head->image;
                                    if ($oldImage) {
                                        if (file_exists(public_path('images/' . $oldImage))) {
                                            unlink(public_path('images/' . $oldImage));
                                        }
                                    }
                                    $ImgName = $this->uploadDataHeadImage($request, $key);

                                    $post_head->image = $ImgName;
                                }
                                $post_head->save();
                            } else {
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

    public function uploadDataHeadImage($request, $key)
    {
        $image = $request->file('data_head')[$key]['head_image'];
        $imageName = time() . $image->getClientOriginalName();
        // add the new file
        $image->move(public_path('images'), $imageName);
        return $imageName;
    }

}
