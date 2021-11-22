<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property integer $id
 * @property integer $user_id
 * @property string $title
 * @property string $text
 * @property boolean $published
 * @property boolean $favorite
 *
 * @property Category[] $categories
 * @property MediaFile[] $images
 * @property Comment[] $comments
 * @property  FavoriteArticle[] $userFavorite
 */

class Article extends Model
{
    const FIELD_ID = 'id';
    const FIELD_USER_ID = 'user_id';
    const FIELD_TITLE = 'title';
    const FIELD_TEXT = 'text';
    const FIELD_PUBLISHED = 'published';
    const FIELD_FAVORITE ='favorite';

    const RELATION_USER = 'user';
    const RELATION_COMMENTS ='comments';
    const RELATION_IMAGES = 'images';
    const RELATION_CATEGORIES = 'categories';
    const RELATION_FAVORITE = 'userFavorite';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        self::FIELD_TITLE,
        self::FIELD_TEXT,
        self::FIELD_PUBLISHED,
        self::FIELD_FAVORITE,
        self::FIELD_USER_ID
    ];

    public function user() {
        return $this->hasOne(User::class, User::FIELD_ID, self::FIELD_USER_ID);
    }

    public function comments() {
        return $this->hasMany(Comment::class, Comment::FIELD_ARTICLE_ID, self::FIELD_ID);
    }

    public function images() {
        return $this->belongsToMany(MediaFile::class, 'article_media_files');
    }

    public function categories() {
        return $this->belongsToMany(Category::class, 'article_categories');
    }

    public function userFavorite() {
        return $this->belongsToMany(FavoriteArticle::class, 'favorite_articles');
    }
}
