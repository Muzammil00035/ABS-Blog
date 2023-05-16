<?php

namespace App\Http\Controllers;

use App\Models\Settings;
use Illuminate\Http\Request;

class TermsAndConditionController extends Controller
{
    function list(Request $request) {
        // return "hello";
        $list = Settings::where("meta_key", "terms-and-condition")->get();

        return view('back.terms-and-condition.list', compact('list'));
    }

    public function createPage(Request $request)
    {
        // return "hello";

        return view('back.terms-and-condition.create');
    }

    public function storePage(Request $request)
    {
        $checkIfExisting = Settings::where("meta_key", "terms-and-condition")->get();
        if (count($checkIfExisting) > 0) {
            return redirect()->back()->with('error', 'Page already created.');

        } else {

            $setting_privacy_policy = new Settings();
            $setting_privacy_policy->meta_key = "terms-and-condition";
            $setting_privacy_policy->meta_value = $request->body;
            $setting_privacy_policy->save();

            return redirect()->back()->with('success', 'Page created successfully.');
        }
    }

    public function updatePageShow(Request $request)
    {
        $post = Settings::where("meta_key", "terms-and-condition")->first();

        return view('back.terms-and-condition.edit', compact('post'));
    }

    public function updatePage(Request $request)
    {
        $checkIfExisting = Settings::where("meta_key", "terms-and-condition")->first();
        if (!empty($checkIfExisting)) {
            $checkIfExisting->meta_value = $request->body;
            if ($checkIfExisting->save()) {
                return redirect()->back()->with('success', 'Page update successfully.');

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
        if ($request->setting_id) {
            $checkIfExisting = Settings::where("meta_key", "terms-and-condition")->first();
            if (!empty($checkIfExisting)) {
                $deletePost = Settings::where("meta_key", "terms-and-condition")->delete();
                if ($deletePost) {
                    return redirect()->back()->with('success', 'Page deleted successfully.');

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

}
