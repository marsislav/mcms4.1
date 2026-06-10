<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Models\Category;

class CategoriesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = Category::all();
        return view('admin.categories.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.categories.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:categories'
        ]);

        Category::create([
            'name' => $request->name
        ]);

        Session::flash('success', 'You successfully created a category.');

        return redirect()->route('categories');
    }

    /**
     * Show the form for editing the specified resource.
     * Route: GET /category/edit/{id}  →  name: category.edit
     */
    public function edit($id)
    {
        $category = Category::findOrFail($id);
        return view('admin.categories.edit', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     * Route: POST /category/update/{id}  →  name: category.update
     */
    public function update(Request $request, $id)
    {
        $category = Category::findOrFail($id);

        $request->validate([
            'name' => 'required|unique:categories,name,' . $category->id
        ]);

        $category->update([
            'name' => $request->name
        ]);

        Session::flash('success', 'You successfully updated the category.');

        return redirect()->route('categories');
    }

    /**
     * Remove the specified resource from storage.
     * Route: GET /category/delete/{id}  →  name: category.delete
     */
    public function destroy($id)
    {
        $category = Category::findOrFail($id);

        if ($category->posts()->count() > 0) {
            Session::flash('info', 'ERROR! Category cannot be deleted because it has some posts.');
            return redirect()->back();
        }

        $category->delete();

        Session::flash('success', 'You successfully deleted the category.');

        return redirect()->route('categories');
    }

    /**
     * AJAX search — returns JSON.
     * Route: GET /admin/categories/search?q=...  →  name: category.search
     */
    public function search(Request $request)
    {
        $q = $request->input('q', '');

        $categories = Category::when($q, function ($query) use ($q) {
                $query->where('name', 'LIKE', '%' . $q . '%');
            })
            ->orderBy('name')
            ->get(['id', 'name']);

        return response()->json($categories);
    }
}
