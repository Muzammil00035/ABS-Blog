<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\UserType;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $types = UserType::get();
        return view("back.profile.index", compact("types"));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        if ($id) {
            $user = User::find($id);
            if ($user) {
                $user->name = $request->name;
                $user->user_intro = $request->user_intro;
                $user->user_type = $request->user_type;
                $user->user_website = $request->user_website;
                if ($request->has('image')) {
                    $oldImage = $user->user_image;
                    if ($oldImage) {
                        if (file_exists(public_path('images/' . $oldImage))) {
                            unlink(public_path('images/' . $oldImage));
                        }
                    }
                    $this->uploadImage($request);
                    $user->user_image = $request->user_image;
                }
                if ($user->save()) {
                    return redirect()->back()->with('success', 'Data has been updated');
                } else {
                    return redirect()->back()->with('error', 'Error Occured');
                }
            } else {
                return redirect()->back()->with('error', 'No User Found');
            }
        } else {
            return redirect()->back()->with('error', 'No User Found');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function uploadImage($request)
    {
        $image = $request->file('image');
        $imageName = time() . $image->getClientOriginalName();
        // add the new file
        $image->move(public_path('images'), $imageName);
        $request->merge(['user_image' => $imageName]);
        // dd($request);
    }
}
