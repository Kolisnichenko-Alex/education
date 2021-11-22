<?php

namespace App\Http\Controllers\FrontEnd;

use App\Article;
use App\Category;
use App\FavoriteArticle;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ArticleController extends Controller
{
    public function index($categoryId)
    {
        /** @var Article $articles */
        /** @var Category $category */
        $category = Category::findOrFail($categoryId);
        $articles = $category->articles->where(Article::FIELD_PUBLISHED, true);

        if (Auth::check()) {

            if (Auth::user()->account_type == 'admin') {
                $articles = $category->articles;
            }
            if (Auth::user()->account_type == 'publisher') {
                $articles = $category->articles->filter(function ($item) {
                    return data_get($item, 'published') == true ||
                        data_get($item, 'user_id') == Auth::id();
                });

            }
            if (Auth::user()->account_type == 'reader') {
                $articles = $category->articles->filter(function ($item) {
                    return data_get($item, 'published') == true ||
                        data_get($item, 'user_id') == Auth::id();
                });

            }
        }
        return view('frontend.category.articles', [
            'articles' => $articles
        ]);
    }

    public function all()
    {
        /** @var Article $articles */
        /** @var Category $category */

        $articles = Article::all();

        return view('frontend.category.articles', [
            'articles' => $articles
        ]);
    }

    public function show($articleId)
    {

        $article = Article::findOrFail($articleId);
        $favorites = (Auth::check())
            ? FavoriteArticle::where(FavoriteArticle::FIELD_USER_ID, Auth::id())->where(FavoriteArticle::FIELD_ARTICLE_ID, $articleId)->count()
            : 0;

        return view('frontend.category.article', [
            'article' => $article,
            'favorites' => $favorites

        ]);
    }

    public function like($articleID)
    {
        /** @var FavoriteArticle $favorite */
        $favorite = FavoriteArticle::create(array(
            FavoriteArticle::FIELD_ARTICLE_ID => $articleID,
            FavoriteArticle::FIELD_USER_ID => Auth::id()
        ));
        $favorite->save();

        return back()->withInput();
    }

    public function dislike($articleID)
    {
        /** @var FavoriteArticle $favorite */
        $favorite = FavoriteArticle::where(FavoriteArticle::FIELD_USER_ID, Auth::id())->where(FavoriteArticle::FIELD_ARTICLE_ID, $articleID)->get();
        foreach ($favorite as $fav)
        {
            $fav->delete();
        }
        return back()->withInput();
    }
}
