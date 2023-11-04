<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Article;
use Illuminate\Http\Request;
use illuminate\Support\Facades\Auth;
use App\Http\Requests\CommentRequest;
use Illuminate\Support\Facades\DB;

class CommentController extends Controller
{
    /**
     * protect routes
     */
    public function __construct()
    {
        $this->middleware('can:comments.index')->only('index');
        $this->middleware('can:comments.destroy')->only('destroy');
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $comments = DB::table('comments')
            ->join('articles', 'comments.article_id', '=', 'articles.id')
            ->join('users', 'comments.user_id', '=', 'users.id')
            ->select('comments.id', 'comments.value', 'comments.description', 'articles.title', 'users.full_name')
            ->where('articles.user_id', '=', Auth::user()->id)
            ->orderBy('articles.id', 'desc')
            ->get();

        return view('admin.comments.index', compact('comments'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CommentRequest $request)
    {
        // check if exists some comentary of user
        $result = Comment::where('user_id', Auth::user()->id)
            ->where('article_id', $request->article_id)->exists();

        // get slug and article status
        $article = Article::select('status', 'slug')->find($request->article_id);

        // if not exists and article status = public, comment
        if (!$result and $article->status == 1) {
            Comment::create([
                'value' => $request->value,
                'description' => $request->description,
                'user_id' => Auth::user()->id,
                'article_id' => $request->article_id,
            ]);

            return redirect()->action([ArticleController::class, 'show'], [$article->slug]);
        } else {
            return redirect()->action([ArticleController::class, 'show'], [$article->slug])
                ->with('success-error', 'Solo puedes comentar una vez');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Comment $comment)
    {
        $comment->delete();

        return redirect()->action([CommentController::class, 'index'], compact('comment'))
            ->with('success-delete', 'Comentario eliminado con exito');
    }
}
