<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property integer $id
 * @property string $url
 *
 * @property Article[] $articles
 */

class MediaFile extends Model
{
    const FIELD_ID = 'id';
    const FIELD_URL = 'url';

    const RELATION_ARTICLES = 'articles';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        self::FIELD_URL,
    ];

    public function articles() {
        return $this->belongsToMany(Article::class, 'article_media_files');
    }
}
