<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Models\MenuItem;
use App\Models\Page;
use App\Models\Category;
use App\Models\PfCategory;
use App\Models\Post;

class MenuController extends Controller
{
    public function index()
    {
        $items        = MenuItem::whereNull('parent_id')->orderBy('sort_order')->with('children')->get();
        $pages        = Page::orderBy('name')->get();
        $categories   = Category::orderBy('name')->get();
        $pfCategories = PfCategory::orderBy('name')->get();
        $posts        = Post::orderBy('title')->get();

        return view('admin.menu.index', compact('items', 'pages', 'categories', 'pfCategories', 'posts'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'label' => 'required|string|max:100',
            'type'  => 'required|in:page,category,pf_category,post,blog,custom',
        ]);

        $count = MenuItem::whereNull('parent_id')->count();

        $referenceId = null;
        if ($request->filled('reference_id')) {
            $referenceId = (int) $request->reference_id;
        } elseif ($request->type === 'page' && $request->filled('reference_id_page')) {
            $referenceId = (int) $request->reference_id_page;
        } elseif ($request->type === 'category' && $request->filled('reference_id_category')) {
            $referenceId = (int) $request->reference_id_category;
        } elseif ($request->type === 'pf_category' && $request->filled('reference_id_pf_category')) {
            $referenceId = (int) $request->reference_id_pf_category;
        } elseif ($request->type === 'post' && $request->filled('reference_id_post')) {
            $referenceId = (int) $request->reference_id_post;
        }

        MenuItem::create([
            'label'        => $request->label,
            'type'         => $request->type,
            'reference_id' => $referenceId,
            'url'          => $request->filled('url') ? $request->url : null,
            'parent_id'    => $request->filled('parent_id') ? (int) $request->parent_id : null,
            'sort_order'   => $count,
        ]);

        Session::flash('success', 'Menu item added.');
        return redirect()->route('menu.index');
    }

    public function destroy($id)
    {
        MenuItem::findOrFail($id)->delete();
        Session::flash('success', 'Menu item deleted.');
        return redirect()->route('menu.index');
    }

    /**
     * Called via AJAX — saves the full sorted+nested structure at once.
     * Expects JSON body: [ {id, parent_id, sort_order}, ... ]
     */
    public function saveOrder(Request $request)
    {
        $items = $request->input('items', []);
        foreach ($items as $item) {
            MenuItem::where('id', $item['id'])->update([
                'parent_id'  => $item['parent_id'] ?: null,
                'sort_order' => $item['sort_order'],
            ]);
        }
        return response()->json(['ok' => true]);
    }
}
