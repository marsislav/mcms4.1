<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth; // Correct import for Auth facade
use Illuminate\Support\Facades\Session; // Correct import for Session facade
use Illuminate\Support\Facades\Storage; // Correct import for Storage facade

class ProfilesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.users.profile')->with('user', Auth::user());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // No implementation needed as per the requirements
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // No implementation needed as per the requirements
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // No implementation needed as per the requirements
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        // No implementation needed as per the requirements
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email',
            'facebook' => 'nullable|url',
            'youtube' => 'nullable|url',
            'about' => 'nullable|string',
            'password' => 'nullable|confirmed|min:6',
            'avatar' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $user = Auth::user(); // Retrieves the currently authenticated user
        $profile = $user->profile;

        if ($request->hasFile('avatar')) {
            $avatar = $request->file('avatar');
            $avatar_new_name = time() . '_' . $avatar->getClientOriginalName();

            // Store file in the 'public/avatars' directory
            $avatar->storeAs('public/avatars', $avatar_new_name);

            // Update avatar path in the profile
            $profile->avatar = 'storage/avatars/' . $avatar_new_name;
            $profile->save();
        }

        // Update user and profile data
        $user->name = $request->name;
        $user->email = $request->email;
        $profile->facebook = $request->facebook;
        $profile->youtube = $request->youtube;
        $profile->about = $request->about;

        $user->save();
        $profile->save();

        if ($request->filled('password')) {
            $user->password = bcrypt($request->password);
            $user->save();
        }

        Session::flash('success', 'Account profile updated.');

        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // No implementation needed as per the requirements
    }
}
