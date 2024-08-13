<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session; // Import the Session facade
use Illuminate\Support\Str; // Import the Str facade
use App\Models\PfCategory; // Use the correct namespace for PfCategory
use App\Models\PfPost; // Use the correct namespace for PfPost

class PfPostsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pfposts = PfPost::all();
        return view('admin.pfposts.index', compact('pfposts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $pfcategories = PfCategory::all();
        return view('admin.pfposts.create', compact('pfcategories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'featured' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'content' => 'required|string',
            'project_title' => 'required|string|max:255',
            'client' => 'required|string|max:255',
            'completed_at' => 'required|date',
            'skills' => 'required|string',
            'client_url' => 'required|url',
            'pfcategory_id' => 'required|exists:pf_categories,id'
        ]);

        $featured = $request->file('featured');
        $featured_new_name = time() . '_' . $featured->getClientOriginalName();
        $featured->move(public_path('uploads/portfolio'), $featured_new_name);

        $pfpost = PfPost::create([
            'title' => $request->title,
            'content' => $request->content,
            'project_title' => $request->project_title,
            'client' => $request->client,
            'completed_at' => $request->completed_at,
            'skills' => $request->skills,
            'client_url' => $request->client_url,
            'featured' => 'uploads/portfolio/' . $featured_new_name,
            'pfcategory_id' => $request->pfcategory_id,
            'slug' => Str::slug($request->title), // Use the Str facade for slug generation
        ]);

        Session::flash('success', 'Portfolio item created successfully.');

        return redirect()->route('pfposts.index'); // Redirect to the index route
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // Implement if needed
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $pfpost = PfPost::findOrFail($id);
        $pfcategories = PfCategory::all();
        return view('admin.pfposts.edit', compact('pfpost', 'pfcategories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'project_title' => 'required|string|max:255',
            'client' => 'required|string|max:255',
            'completed_at' => 'required|date',
            'skills' => 'required|string',
            'client_url' => 'required|url',
            'pfcategory_id' => 'required|exists:pf_categories,id'
        ]);

        $pfpost = PfPost::findOrFail($id);

        if ($request->hasFile('featured')) {
            $featured = $request->file('featured');
            $featured_new_name = time() . '_' . $featured->getClientOriginalName();
            $featured->move(public_path('uploads/portfolio'), $featured_new_name);
            $pfpost->featured = 'uploads/portfolio/' . $featured_new_name;
        }

        $pfpost->update([
            'title' => $request->title,
            'content' => $request->content,
            'project_title' => $request->project_title,
            'client' => $request->client,
            'completed_at' => $request->completed_at,
            'skills' => $request->skills,
            'client_url' => $request->client_url,
            'pfcategory_id' => $request->pfcategory_id,
            'slug' => Str::slug($request->title), // Use the Str facade for slug generation
        ]);

        Session::flash('success', 'Portfolio item updated successfully.');

        return redirect()->route('pfposts.index'); // Redirect to the index route
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $pfpost = PfPost::findOrFail($id);
        $pfpost->delete();

        Session::flash('success', 'The portfolio item was just trashed.');

        return redirect()->back();
    }

    /**
     * Display trashed resources.
     *
     * @return \Illuminate\Http\Response
     */
    public function trashed()
    {
        $pfposts = PfPost::onlyTrashed()->get();
        return view('admin.pfposts.trashed', compact('pfposts'));
    }

    /**
     * Permanently delete a trashed resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function kill($id)
    {
        $pfpost = PfPost::withTrashed()->where('id', $id)->firstOrFail();
        $pfpost->forceDelete();

        Session::flash('success', 'Portfolio item deleted permanently.');

        return redirect()->back();
    }

    /**
     * Restore a trashed resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function restore($id)
    {
        $pfpost = PfPost::withTrashed()->where('id', $id)->firstOrFail();
        $pfpost->restore();

        Session::flash('success', 'Portfolio item restored successfully.');

        return redirect()->route('pfposts.index'); // Redirect to the index route
    }
}
