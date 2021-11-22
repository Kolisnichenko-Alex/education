<?php

namespace App\Http\Controllers\Admin;

use App\ArticleMediaFiles;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreImageRequest;
use App\Http\Requests\UpdateImageRequest;
use Faker\Provider\Image;
use Illuminate\Http\Request;
use App\Http\Requests\StoreArticleRequest;
use App\Http\Requests\UpdateArticleRequest;
use App\MediaFile;
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

class MediaFileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $images = MediaFile::all();

        return view('image.index', [
            'images' => $images
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (Auth::user()->account_type == 'admin')
        {
            $articles = Article::all(Article::FIELD_ID, Article::FIELD_TITLE);
            return view('image.new', [
                'articles' => $articles
            ]);
        }
        $articles = Article::where(Article::FIELD_USER_ID, Auth::id())->get();
        return view('image.new', [
            'articles' => $articles
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreImageRequest $request)
    {
        $validated = $request->validated();

        $imageName = time() . '.' . $validated['image']->extension();
        $validated['image']->move(public_path('images'), $imageName);

        /** @var MediaFile $newImage */
        $newImage = MediaFile::create(array(
            MediaFile::FIELD_URL => '/images/' . $imageName
        ));

        $newImage->save();
        $newImage->articles()->sync($request->get('articles'));

        $request->session()->flash('success', 'Image successfully created');
        return redirect()->route('image.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        /** @var Article $articles */
        /**@var MediaFile $image */

        $image = MediaFile::findOrFail($id);

        return view('image.view', [
            'image' => $image,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        /** @var Article $articles */
        /**@var MediaFile $image */

        $image = MediaFile::findOrFail($id);

        if (Auth::user()->account_type == 'admin')
        {
            $articles = Article::all(Article::FIELD_ID, Article::FIELD_TITLE);
            $articles_selected = ArticleMediaFiles::where(ArticleMediaFiles::FIELD_IMAGE_ID, $id)->get(ArticleMediaFiles::FIELD_ARTICLE_ID);
            return view('image.edit', [
                'articles' => $articles,
                'articles_selected' => $articles_selected,
                'image' => $image
            ]);
        }
        $articles = Article::where(Article::FIELD_USER_ID, Auth::id())->get();
        $articles_selected = ArticleMediaFiles::where(ArticleMediaFiles::FIELD_IMAGE_ID, $id)->get(ArticleMediaFiles::FIELD_ARTICLE_ID);

        return view('image.edit', [
            'articles' => $articles,
            'articles_selected' => $articles_selected,
            'image' => $image
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateImageRequest $request, $id)
    {
        /** @var MediaFile $newImage */
        $newImage = MediaFile::find($id);

        if($request->hasFile('image'))
        {
            $validated = $request->validated();
            $imageName = time() . '.' . $validated['image']->extension();
            $validated['image']->move(public_path('images'), $imageName);
            $newImage->url = '/images/'.$imageName;
        }
        $newImage->save();
        $newImage->articles()->attach($request->get('articles'));


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
        /** @var MediaFile $image */
        $image = MediaFile::findOrFail($id);
        $image->delete();

        return back()->withInput();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param $id
     * @return \Illuminate\Http\Response
     * @throws \Exception
     */
    public function detach($id)
    {
        /** @var ArticleMediaFiles $imageArticle */
        $imageArticle = ArticleMediaFiles::find($id);
        $imageArticle->delete();

        return back()->withInput();
    }
}
