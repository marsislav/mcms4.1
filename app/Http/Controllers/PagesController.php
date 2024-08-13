<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Page; // Ensure you are using the correct namespace for your model
use Illuminate\Support\Facades\Session; // Import the Session facade

class PagesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Use the latest query builder methods for better performance and readability
        $pages = Page::all();
        return view('admin.pages.index', compact('pages'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.pages.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Use validate method directly on the request instance
        $request->validate([
            'name' => 'required|string|max:255',
            'position' => 'required|integer',
            'content' => 'required|string',
        ]);

        // Create and save the new page
        Page::create($request->only('name', 'position', 'content'));

        // Flash success message and redirect
        return redirect()->route('pages.index')->with('success', 'You successfully created a page.');
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $page = Page::findOrFail($id);
        return view('admin.pages.show', compact('page'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $page = Page::findOrFail($id);
        return view('admin.pages.edit', compact('page'));
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
        // Validate request data
        $request->validate([
            'name' => 'required|string|max:255',
            'position' => 'required|integer',
            'content' => 'required|string',
        ]);

        // Find the page or fail if not found
        $page = Page::findOrFail($id);

        // Update the page attributes
        $page->update($request->only('name', 'position', 'content'));

        // Flash success message and redirect
        return redirect()->route('pages.index')->with('success', 'You successfully updated the page.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // Find the page or fail if not found
        $page = Page::findOrFail($id);

        // Delete the page
        $page->delete();

        // Flash success message and redirect
        return redirect()->route('pages.index')->with('success', 'You successfully deleted the page.');
    }
}
