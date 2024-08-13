<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session; // Import the Session facade
use App\Models\PfCategory; // Use the correct namespace for the PfCategory model

class PfCategoriesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pfcategories = PfCategory::all(); // Retrieve all categories
        return view('admin.pfcategories.index', compact('pfcategories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.pfcategories.create');
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
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        $pfcategory = new PfCategory();
        $pfcategory->name = $request->name;
        $pfcategory->description = $request->description;
        $pfcategory->save();

        Session::flash('success', 'You successfully created the portfolio category.');
        return redirect()->route('pfcategories.index'); // Redirect to the index route
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $pfcategory = PfCategory::findOrFail($id);
        return view('admin.pfcategories.show', compact('pfcategory'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $pfcategory = PfCategory::findOrFail($id);
        return view('admin.pfcategories.edit', compact('pfcategory'));
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
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        $pfcategory = PfCategory::findOrFail($id);
        $pfcategory->name = $request->name;
        $pfcategory->description = $request->description;
        $pfcategory->save();

        Session::flash('success', 'You successfully updated the portfolio category.');
        return redirect()->route('pfcategories.index'); // Redirect to the index route
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $pfcategory = PfCategory::findOrFail($id);

        // Check if the category has associated items
        if ($pfcategory->pfposts->count() > 0) {
            Session::flash('info', 'ERROR! Category cannot be deleted because it has some portfolio items.');
            return redirect()->back();
        }

        // Delete the category
        $pfcategory->delete();

        Session::flash('success', 'You successfully deleted the portfolio category.');
        return redirect()->route('pfcategories.index'); // Redirect to the index route
    }
}
