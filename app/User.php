<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use phpDocumentor\Reflection\Types\This;
use Illuminate\Contracts\Auth\CanResetPassword;
use Illuminate\Database\Eloquent\SoftDeletes;


/**
 * @property integer $id
 * @property string $email
 * @property string $password
 * @property string $name
 * @property string $account_type
 * @property Carbon $baned_at
 *
 * @property Article[] $articles
 * @property Comment[] $comments
 * @property FavoriteArticle[] $favorites
 */
class User extends Authenticatable
{
    use Notifiable;

    const FIELD_ID = 'id';
    const FIELD_EMAIL = 'email';
    const FIELD_PASSWORD = 'password';
    const FIELD_NAME = 'name';
    const FIELD_ACCOUNT_TYPE = 'account_type';
    const FIELD_BANED_AT = 'baned_at';

    const RELATION_ARTICLES = 'articles';
    const RELATION_COMMENTS = 'comments';
    const RELATION_FAVORITES = 'favorites';


    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        self::FIELD_EMAIL,
        self::FIELD_NAME,
        self::FIELD_ACCOUNT_TYPE,
        self::FIELD_PASSWORD
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'remember_token',
    ];

    public function articles()
    {
        return $this->hasMany(Article::class, Article::FIELD_USER_ID, self::FIELD_ID);
    }

    public function comments()
    {
        return $this->hasMany(Comment::class, Comment::FIELD_USER_ID, self::FIELD_ID);
    }

    public function favorites()
    {
        return $this->hasMany(FavoriteArticle::class, FavoriteArticle::FIELD_USER_ID, self::FIELD_ID);
    }

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function isAdmin()
    {
        if ($this->account_type == 'admin') {
            return true;
        }
        return false;
    }

    public function isPublisher()
    {
        if ($this->account_type == 'publisher' || $this->account_type == 'admin') {
            return true;
        }
        return false;
    }
}
