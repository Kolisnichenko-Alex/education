<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property integer $id
 * @property integer $article_id
 * @property integer $category_id
 *
 * @property Article $article
 * @property Category $category
 */

class ArticleCategories extends Model
{
    const FIELD_ID = 'id';
    const FIELD_ARTICLE_ID = 'article_id';
    const FIELD_CATEGORY_ID = 'category_id';

    const RELATION_ARTICLE = 'article';
    const RELATION_CATEGORY ='category';

    protected $fillable = [
        self::FIELD_CATEGORY_ID,
        self::FIELD_ARTICLE_ID
    ];

    public function article() {
        return $this->hasOne(Article::class, Article::FIELD_ID, self::FIELD_ARTICLE_ID);
    }
    public function category() {
        return $this->hasOne(Category::class, Category::FIELD_ID, self::FIELD_CATEGORY_ID);
    }
}
