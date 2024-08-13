<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session; // Import the Session facade correctly
use App\Models\Tag; // Ensure the namespace is correct

class TagsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tags = Tag::all();
        return view('admin.tags.index', compact('tags'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.tags.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'tag' => 'required|string|max:255'
        ]);

        Tag::create([
            'tag' => $request->tag
        ]);

        Session::flash('success', 'Tag created successfully.');

        return redirect()->route('tags.index'); // Ensure route name is correct
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // Implement show method if needed
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $tag = Tag::findOrFail($id); // Use findOrFail for proper error handling

        return view('admin.tags.edit', compact('tag'));
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
        $request->validate([
            'tag' => 'required|string|max:255'
        ]);

        $tag = Tag::findOrFail($id); // Use findOrFail for proper error handling

        $tag->update([
            'tag' => $request->tag
        ]);

        Session::flash('success', 'Tag updated!');

        return redirect()->route('tags.index'); // Ensure route name is correct
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Tag::destroy($id);

        Session::flash('success', 'Tag deleted.');

        return redirect()->back();
    }
}
