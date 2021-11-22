<?php

namespace App\Http\Controllers\FrontEnd;

use App\Category;
use App\Http\Controllers\Controller;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::where(Category::FIELD_PARENT_ID, null)->get();
        $subcategories = Category::where(Category::FIELD_PARENT_ID, !null)->get();
        return view('frontend.categories', [
            'categories' => $categories,
            'subcategories' => $subcategories
        ]);
    }
}
