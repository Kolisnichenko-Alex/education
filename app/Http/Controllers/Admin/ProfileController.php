<?php

namespace App\Http\Controllers\Admin;

use App\Comment;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\MenuItem;
use App\SavedPage;
use App\User;
use App\Http\Requests\StoreArticleRequest;
use App\Http\Requests\UpdateArticleRequest;
use App\Category;
use App\Article;
use App\ArticleCategories;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;
use Illuminate\Support\Facades\Input;
use Monolog\Handler\SamplingHandler;
use function PHPSTORM_META\type;
use Illuminate\Support\Facades\Session;

class ProfileController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $articles = Article::where(Article::FIELD_USER_ID, Auth::id())->count();
        $comments = Comment::where(Comment::FIELD_USER_ID, Auth::id())->count();
        return view('profile.index', [
            'articles' => $articles,
            'comments' => $comments
        ]);
    }

    public function passwordReset()
    {

        return view();
    }
}
