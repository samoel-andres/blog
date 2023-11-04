<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Article;
use Illuminate\Http\Request;
use App\Http\Requests\CategoryRequest;
use Illuminate\Support\Facades\File;

class CategoryController extends Controller
{

    /**
     * protect routes
     */
    public function __construct()
    {
        $this->middleware('can:categories.index')->only('index');
        $this->middleware('can:categories.create')->only('create', 'store');
        $this->middleware('can:categories.edit')->only('edit', 'update');
        $this->middleware('can:categories.destroy')->only('destroy');
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // display categories to admin
        $categories = Category::orderBy('id', 'desc')
            ->simplePaginate(8);

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
    public function store(CategoryRequest $request)
    {
        // save the request in some variable
        $category = $request->all();

        // validate if exists some file
        if ($request->hasFile('image')) {
            $category['image'] = $request->file('image')->store('categories');
        }

        // save data
        Category::create($category);

        return redirect()->action([CategoryController::class, 'index'])
            ->with('success-create', 'Categoria creada con exito');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Category $category)
    {
        return view('admin.categories.edit', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CategoryRequest $request, Category $category)
    {
        // if user uploads a new image
        if ($request->hasFile('image')) {
            // delete previous image
            File::delete(public_path('storage/' . $category->image));

            // assign the new image
            $category['image'] = $request->file('image')->store('categories');
        }

        // update date
        $category->update([
            'name' => $request->name,
            'slug' => $request->slug,
            'status' => $request->status,
            'is_feature' => $request->is_feature,
        ]);

        return redirect()->action([CategoryController::class, 'index'], compact('category'))
            ->with('success-update', 'Categoria actualizada con exito');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
        // delete image from categories folder
        if ($category->image) {
            File::delete(public_path('storage/' . $category->image));
        }

        // delete item
        $category->delete();

        return redirect()->action([CategoryController::class, 'index'], compact('category'))
            ->with('success-delete', 'Categoria eliminada con exito');
    }

    // filter articles by categories
    public function detail(Category $category)
    {
        // check if the category have status = public
        $this->authorize('published', $category);

        $articles = Article::where([
            ['category_id', $category->id],
            ['status', '1'],
        ])
            ->orderBy('id', 'desc')
            ->simplePaginate(5);

        $navbar = Category::where([
            ['status', '1'],
            ['is_feature', '1'],
        ])->paginate(3);

        return view('subscriber.categories.detail', compact('articles', 'category', 'navbar'));
    }
}
