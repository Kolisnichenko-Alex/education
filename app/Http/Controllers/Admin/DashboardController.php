<?php

namespace App\Http\Controllers\Admin;

use App\MenuItem;
use App\SavedPage;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
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

class DashboardController extends Controller
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
        $user = Auth::user();
        if ($user->account_type == 'admin'){
            $users = User::count();
            $articles = Article::count();
            $categories = Category::count();
            $pages = SavedPage::count();
            $menu = MenuItem::count();
            return view('welcome', [
                'user' => $user,
                'users' => $users,
                'articles' => $articles,
                'categories' => $categories,
                'pages' => $pages,
                'menu' => $menu
            ]);
        }
        $articles = Article::where(Article::FIELD_USER_ID, $user->id)->count();
        return view('welcome', [
            'user' => $user,
            'articles' => $articles]);
    }
}
