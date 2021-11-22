<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property integer $id
 * @property integer $user_id
 * @property integer $article_id
 *
 * @property Article $article
 * @property User $user
 */

class FavoriteArticle extends Model
{
    const FIELD_ID = 'id';
    const FIELD_ARTICLE_ID = 'article_id';
    const FIELD_USER_ID = 'user_id';

    const RELATION_ARTICLE = 'article';
    const RELATION_USER ='user';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        self::FIELD_ARTICLE_ID,
        self::FIELD_USER_ID
    ];

    public function article() {
        return $this->hasOne(Article::class, Article::FIELD_ID, self::FIELD_ARTICLE_ID);
    }
    public function user() {
        return $this->hasOne(User::class, User::FIELD_ID, self::FIELD_USER_ID);
    }

}
