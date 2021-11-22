<?php

namespace App\Http\Controllers\Admin;

use App\ArticleMediaFiles;
use App\Comment;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreArticleRequest;
use App\Http\Requests\UpdateArticleRequest;
use App\MediaFile;
use Illuminate\Http\Request;
use App\Category;
use App\Article;
use App\User;
use App\ArticleCategories;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;
use Illuminate\Support\Facades\Input;
use Monolog\Handler\SamplingHandler;
use function PHPSTORM_META\type;
use Illuminate\Support\Facades\Session;

class ArticleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $articles = Article::all();

        return view('articles.index', [
            'articles' => $articles
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all(Category::FIELD_ID, Category::FIELD_TITLE);

        return view('articles.new', [
            'categories' => $categories
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreArticleRequest $request)
    {
        $validated = $request->validated();

        $userId = Auth::id();

        /** @var Article $article */
        $article = Article::create(array(
            Article::FIELD_TITLE => $validated[Article::FIELD_TITLE],
            Article::FIELD_TEXT => $validated[Article::FIELD_TEXT],
            Article::FIELD_PUBLISHED => false,
            Article::FIELD_FAVORITE => false,
            Article::FIELD_USER_ID => $userId
        ));

        $article->save();
        $article->categories()->sync($request->get('categories'));

        $request->session()->flash('success', 'Article successfully created');
        return redirect()->route('articles.index');
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        /** @var Article $article */
        $article = Article::findOrFail($id);

        return view('articles.view', [
            'article' => $article
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        /** @var Article $article */
        /**@var Comment $comments */

        $article = Article::find($id);
        $categories = Category::all(Category::FIELD_ID, Category::FIELD_TITLE);
        $categories_selected = ArticleCategories::where(ArticleCategories::FIELD_ARTICLE_ID, $id)->get(ArticleCategories::FIELD_CATEGORY_ID);
        $comments = Comment::where(Comment::FIELD_ARTICLE_ID, $id)->with(Comment::RELATION_USER)->get();
        $images = ArticleMediaFiles::where(ArticleMediaFiles::FIELD_ARTICLE_ID, $id)->get();

        return view('articles.edit', [
            'article' => $article,
            'categories' => $categories,
            'categories_selected' => $categories_selected,
            'comments' => $comments,
            'images' => $images
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateArticleRequest $request, $id)
    {
        $validated = $request->validated();

        /** @var Article $article */
        $article = Article::findOrFail($id);
        $article->title = $validated[Article::FIELD_TITLE];
        $article->text = $validated[Article::FIELD_TEXT];

        $article->save();
        $article->categories()->sync($request->get('categories'));

        $request->session()->flash('success', 'Article successfully updated');
        return back()->withInput();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     * @throws \Exception
     */
    public function destroy($id)
    {
        /** @var Article $article */
        $article = Article::findOrFail($id);
        $article->delete();

        return redirect()->route('articles.index');
    }

    /**
     * @param Request $request
     * @param integer $id
     * @return \Illuminate\Routing\Redirector|\Illuminate\Http\RedirectResponse
     */
    public function publish(Request $request, $id)
    {
        /** @var Article $article */
        $article = Article::findOrFail($id);

        if ($article->published) {
            $article->published = false;
            $article->save();
            $request->session()->flash('success', 'Article successfully unpublished');

            return redirect()->route('articles.index', $request->query());
        }

        $article->published = true;
        $article->save();
        $request->session()->flash('success', 'Article successfully published');

        return redirect()->route('articles.index', $request->query());
    }

    /**
     * @param Request $request
     * @param integer $id
     * @return \Illuminate\Routing\Redirector|\Illuminate\Http\RedirectResponse
     */
    public function favoriteAdmin(Request $request, $id)
    {
        /** @var Article $article */
        $article = Article::findOrFail($id);

        if ($article->favorite) {
            $article->favorite = false;
            $article->save();
            $request->session()->flash('success', 'Article successfully favored by Admin');

            return redirect()->route('articles.index', $request->query());
        }

        $article->favorite = true;
        $article->save();
        $request->session()->flash('success', 'Article successfully unfavored by Admin');

        return redirect()->route('articles.index', $request->query());
    }
}
