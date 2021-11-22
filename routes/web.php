<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Auth::routes();

Route::get('/', 'FrontEnd\HomeController@index')->name('home');
Route::get('/home/categories', 'FrontEnd\CategoryController@index')->name('home.categories');
Route::get('/home/categories/{categoryId}', 'FrontEnd\ArticleController@index')->name('home.category');
Route::get('/home/article/{articleId}', 'FrontEnd\ArticleController@show')->name('home.article');

Route::group(['middleware' => 'auth'], function () {
    Route::get('/dashboard', 'Admin\DashboardController@index')->name('dashboard');
    Route::get('logout', 'Auth\LoginController@logout');
    Route::get('settings', 'Admin\ProfileController@index');

    Route::get('/article/like/{articleId}', 'FrontEnd\ArticleController@like')->name('article.like');
    Route::get('/article/dislike/{articleId}', 'FrontEnd\ArticleController@dislike')->name('article.dislike');
    Route::post('/article/post-comment/{articleId}', 'FrontEnd\CommentController@postComment')->name('comment.post');

    Route::middleware('can:publisher')->group(function () {
        Route::resources([
            'articles' => 'Admin\ArticleController',
            'image' => 'Admin\MediaFileController'
        ]);
        Route::get('image/detach/{id}', 'Admin\MediaFileController@detach')->name('images.detach');
        Route::get('comments/delete/{id}', 'Admin\CommentController@destroy')->name('comments.destroy');
    });

    Route::middleware('can:admin')->group(function () {
        Route::resources([
            'users' => 'Admin\UserController',
            'categories' => 'Admin\CategoryController',
            'menu' => 'Admin\MenuItemController',
            'pages' => 'Admin\PageController'
        ]);

        Route::get('users/ban-unban/{id}', 'Admin\UserController@banUnban')->name('users.ban');
        Route::get('articles/publish/{id}', 'Admin\ArticleController@publish')->name('articles.publish');
        Route::get('articles/favorite-admin/{id}', 'Admin\ArticleController@favoriteAdmin')->name('articles.favorite-admin');
    });
});
