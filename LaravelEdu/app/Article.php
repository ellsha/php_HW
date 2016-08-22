<?php

namespace App;

use App\Tag;
use Carbon\Carbon;
use cebe\markdown\GithubMarkdown;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Article
 *
 * @property integer id
 * @property string title
 * @property string description
 * @property Carbon created_at
 * @property Carbon updated_at
 * @property integer user_id
 * @property Tag[] tags
 *
 * @mixin \Eloquent
 */
class Article extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'title', 'description'
    ];

    /**
     * Convert string with markdowns to string with html tags
     * by $article->description
     *
     * @param $value
     * @return string
     */
    public function getDescriptionAttribute($value)
    {
        return (new GithubMarkdown())->parse($value);
    }

    /**
     * Return article`s description with markdowns
     * by $article->markdown_description
     *
     * @return mixed
     */
    public function getMarkdownDescriptionAttribute()
    {
        return $this->attributes['description'];
    }

    /**
     * Return author of article
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }


    /**
     * Return tags of this article
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function tags()
    {
        return $this->belongsToMany(Tag::class, 'tag_article');
    }

    /**
     * Returns comments which were written to this article
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function comments()
    {
        return $this->hasMany(Comment::class);
    }
}
