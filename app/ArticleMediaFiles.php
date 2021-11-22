<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property integer $id
 * @property integer $article_id
 * @property integer $media_file_id
 *
 * @property Article $article
 * @property MediaFile $image
 */

class ArticleMediaFiles extends Model
{
    const FIELD_ID = 'id';
    const FIELD_ARTICLE_ID = 'article_id';
    const FIELD_IMAGE_ID = 'media_file_id';

    const RELATION_ARTICLE = 'article';
    const RELATION_IMAGE ='image';

    protected $fillable = [
        self::FIELD_IMAGE_ID,
        self::FIELD_ARTICLE_ID
    ];

    public function article() {
        return $this->hasOne(Article::class, Article::FIELD_ID, self::FIELD_ARTICLE_ID);
    }
    public function image() {
        return $this->hasOne(MediaFile::class, MediaFile::FIELD_ID, self::FIELD_IMAGE_ID);
    }
}
