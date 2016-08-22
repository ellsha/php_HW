<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Comment
 * @package App
 *
 * @property integer id
 * @property string text
 * @property int comment_id
 * @property Carbon created_at
 * @property Carbon updated_at
 * @property int user_id
 * @property int article_id
 * @property mixed subComments
 *
 * @mixin \Eloquent
 */
class Comment extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id', 'text', 'user_id', 'article_id', 'comment_id'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function article()
    {
        return $this->belongsTo(Article::class, 'article_id');
    }

    public function comments()
    {
        return $this->hasMany(Comment::class, 'comment_id');
    }
}
