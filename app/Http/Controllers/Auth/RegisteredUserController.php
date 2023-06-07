<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Settings ;

use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;



class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        
        $terms_and_condition = Settings::where('meta_key' , 'terms-and-condition')->first();
        return view('auth.register' , compact('terms_and_condition'));
    }

    /**
     * Handle an incoming registration request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);
        $img = "";
        
        if ($request->has('image')) {
            $this->uploadImage($request);
            $img = $request->user_image;
        }

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'user_type' => $request->user_type, 
            'user_intro' =>$request->user_intro,
            'user_website'=>$request->user_website,
            'user_image' =>$img
        ]);

        event(new Registered($user));

        Auth::login($user);

        return redirect(RouteServiceProvider::HOME);
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
