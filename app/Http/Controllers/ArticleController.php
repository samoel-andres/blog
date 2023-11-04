<?php

namespace App\Http\Controllers;

use App\Http\Requests\ArticleRequest;
use App\Models\Article;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;

class ArticleController extends Controller
{
    /**
     * protect routes
     */
    public function __construct()
    {
        $this->middleware('can:articles.index')->only('index');
        $this->middleware('can:articles.create')->only('create', 'store');
        $this->middleware('can:articles.edit')->only('edit', 'update');
        $this->middleware('can:articles.destroy')->only('destroy');
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // display articles to admin
        $user = Auth::user();

        $articles = Article::where('user_id', $user->id)
            ->orderBy('id', 'desc')
            ->simplePaginate(10);

        return view('admin.articles.index', compact('articles'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // get public categories
        $categories = Category::select('id', 'name')
            ->where('status', '1')
            ->get();

        return view('admin.articles.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ArticleRequest $request)
    {
        /**
         * to obtain only required fields (the fields indicated 
         * that non-masives in the model is ignored)
         */
        $request->merge([
            'user_id' => Auth::user()->id,
        ]);

        // save the request in some variable
        $article = $request->all();

        // validate if the request contain some file
        if ($request->hasFile('image')) {
            $article['image'] = $request->file('image')->store('articles');
        }

        Article::create($article);

        return redirect()->action([ArticleController::class, 'index'])
            ->with('success-create', 'Articulo creado con exito');
    }

    /**
     * Display the specified resource.
     */
    public function show(Article $article)
    {
        // check if the article have status = public
        $this->authorize('published', $article);

        // display the articles and comments
        $comments = $article->comments()->simplePaginate(5);

        return view('subscriber.articles.show', compact('article', 'comments'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Article $article)
    {
        // check if the user is author of the article
        $this->authorize('view', $article);

        // get public categories
        $categories = Category::select(['id', 'name'])
            ->where('status', '1')
            ->get();

        return view('admin.articles.edit', compact('categories', 'article'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ArticleRequest $request, Article $article)
    {
        // check if the user is author of the article
        $this->authorize('update', $article);

        // if user uploads a new image
        if ($request->hasFile('image')) {
            // delete previus image
            File::delete(public_path('storage/' . $article->image));

            // assign the new image
            $article['image'] = $request->file('image')->store('articles');
        }

        // update data
        $article->update([
            'title' => $request->title,
            'slug' => $request->slug,
            'introduction' => $request->introduction,
            'body' => $request->body,
            'user_id' => Auth::user()->id,
            'category_id' => $request->category_id,
            'status' => $request->status,
        ]);

        return redirect()->action([ArticleController::class, 'index'])
            ->with('success-update', 'Articulo actualizado con exito');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Article $article)
    {
        // check if the user is author of the article
        $this->authorize('delete', $article);

        // delete image
        if ($article->image) {
            File::delete(public_path('storage/' . $article->image));
        }

        // delete article
        $article->delete();

        return redirect()->action([ArticleController::class, 'index'], compact('article'))
            ->with('success-delete', 'Articulo eliminado con exito');
    }
}
