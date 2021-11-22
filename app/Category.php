<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property integer $id
 * @property string $title
 * @property integer $parent_category_id
 *
 * @property Category[] $subcategories
 * @property Article[] $articles
 * @property Article[] $publishedArticles
 */
class Category extends Model
{
    const FIELD_ID = 'id';
    const FIELD_PARENT_ID = 'parent_category_id';
    const FIELD_TITLE = 'title';

    const RELATION_ARTICLES = 'articles';
    const RELATION_SUBCATEGORIES ='subcategories';
    const RELATION_PUBLISHED = 'publishedArticles';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        self::FIELD_TITLE,
        self::FIELD_PARENT_ID
    ];

    public function articles(){
        return $this->belongsToMany(Article::class, 'article_categories');
    }
    public function publishedArticles(){
        return $this->belongsToMany(Article::class, 'article_categories')->where(Article::FIELD_PUBLISHED, true);
    }

    public function subcategories(){
        return $this->hasMany(Category::class, Category::FIELD_PARENT_ID, self::FIELD_ID);
    }
}
