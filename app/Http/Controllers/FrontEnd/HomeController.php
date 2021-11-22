<?php

namespace App\Http\Controllers\FrontEnd;

use App\Article;
use App\Http\Controllers\Controller;
use App\MenuItem;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $favorite = Article::where(Article::FIELD_FAVORITE, true && Article::FIELD_PUBLISHED, true)->with(Article::RELATION_USER)->get();
        $menu = MenuItem::all();
        return view('frontend.home', [
            'favorite' => $favorite,
            'menu' => $menu
        ]);
    }
}
