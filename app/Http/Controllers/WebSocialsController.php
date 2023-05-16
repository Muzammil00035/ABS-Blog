<?php

namespace App\Http\Controllers;

use App\Models\WebSocial;
use Illuminate\Http\Request;

class WebSocialsController extends Controller
{

    function list(Request $request) {
        // return "hello";
        $list = WebSocial::all();

        return view('back.web-socials.list', compact('list'));
    }

    public function createPage(Request $request)
    {

        return view('back.web-socials.create');
    }

    public function storePage(Request $request)
    {
        $checkIfExisting = WebSocial::where("social_name", $request->social_name)->get();
        if (count($checkIfExisting) > 0) {
            return redirect()->back()->with('error', 'Social Icon already created.');
        } else {

            $web_socials = new WebSocial();
            $web_socials->social_name = $request->social_name;
            $web_socials->social_link = $request->social_link;
            if ($request->has('social_image')) {
                $this->uploadImage($request);
                $web_socials->social_icon = $request->image;
            }
            $web_socials->save();

            return redirect()->back()->with('success', 'Page created successfully.');
        }
    }

    public function updatePageShow(Request $request, $id)
    {
        $social = WebSocial::where("id", $id)->first();

        return view('back.web-socials.edit', compact('social'));
    }

    public function updatePage(Request $request)
    {
        $checkIfExisting = WebSocial::where("id", $request->id)->first();

        if (!empty($checkIfExisting)) {
            $checkIfExisting->social_name = $request->social_name;
            $checkIfExisting->social_link = $request->social_link;

            if ($request->has('social_image')) {
                $oldImage = $checkIfExisting->social_icon;
                if ($oldImage) {
                    if (file_exists(public_path('images/' . $oldImage))) {
                        unlink(public_path('images/' . $oldImage));
                    }
                }
                $this->uploadImage($request);
                $checkIfExisting->social_icon = $request->image;
            }
            if ($checkIfExisting->save()) {
                return redirect()->back()->with('success', 'Socials update successfully.');

            } else {
                return redirect()->back()->with('error', 'Error Occured.');

            }

        } else {
            return redirect()->back()->with('error', 'Not Found.');

        }
    }

    public function deletePage(Request $request)
    {
        // return dd($request);
        if ($request->id) {
            $checkIfExisting = WebSocial::where("id", $request->id)->first();
            if (!empty($checkIfExisting)) {
                $deletePost = WebSocial::where("id", $request->id)->delete();
                if ($deletePost) {
                    return redirect()->back()->with('success', 'Social deleted successfully.');

                } else {
                    return redirect()->back()->with('error', 'Error Occured.');

                }

            } else {
                return redirect()->back()->with('error', 'Not Found.');

            }
        } else {
            return redirect()->back()->with('error', 'Error Cccured. Setting Not Found.');

        }
    }

    public function uploadImage($request)
    {
        $image = $request->file('social_image');
        $imageName = time() . $image->getClientOriginalName();
        // add the new file
        $image->move(public_path('images'), $imageName);
        $request->merge(['image' => $imageName]);
        // dd($request);
    }
}
