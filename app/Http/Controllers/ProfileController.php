<?php

namespace App\Http\Controllers;

use App\Models\Profile;
use App\Models\Article;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use App\Http\Requests\ProfileRequest;

class ProfileController extends Controller
{

    /**
     * protect routes
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display the specified resource.
     * (METODO AGREGADO - BLOG VERSION 2)
     */
    public function show(Profile $profile)
    {
        $articles = Article::where([
            ['user_id', $profile->id],
            ['status', '1'],
        ])->simplePaginate(8);

        return view('subscriber.profiles.show', compact('profile', 'articles'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Profile $profile)
    {
        // check if the user is owner of profile
        $this->authorize('view', $profile);

        return view('subscriber.profiles.edit', compact('profile'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ProfileRequest $request, Profile $profile)
    {

        // check if the user is owner of profile
        $this->authorize('update', $profile);

        $user = Auth::user();

        if ($request->hasFile('photo')) {
            // delete previous photo
            File::delete(public_path('storage/' . $profile->photo));

            // assign new photo
            $photo = $request['photo']->store('profiles');
        } else {
            // if don't have photo, leave the one have
            $photo = $user->profile->photo;
        }

        // assign name and email
        $user->full_name = $request->full_name;
        $user->email = $request->email;

        // CODIGO AGREGADO - BLOG VERSION 2
        $user->profile->profession = $request->profession;
        $user->profile->about = $request->about;
        $user->profile->photo = $photo;
        $user->profile->twitter = $request->twitter;
        $user->profile->linkedin = $request->linkedin;
        $user->profile->facebook = $request->facebook;

        // save users fields
        $user->save();

        // save profile fields
        $user->profile->save();

        return redirect()->route('profiles.edit', $user->profile->id);
    }
}
