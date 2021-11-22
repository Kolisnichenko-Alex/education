<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property integer $id
 * @property string $title
 * @property string $html
 *
 */

class SavedPage extends Model
{
    const FIELD_ID = 'id';
    const FIELD_TITLE = 'title';
    const FIELD_HTML = 'html';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        self::FIELD_TITLE,
        self::FIELD_HTML
    ];
}
