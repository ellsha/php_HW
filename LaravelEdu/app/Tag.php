<?php

namespace App;

use cebe\markdown\GithubMarkdown;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Article
 *
 * @property integer id
 * @property string name
 *
 * @mixin \Eloquent
 */
class Tag extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name'];

    /**
     * Return articles which have this tag
     */
    public function articles()
    {
        return $this->belongsToMany('App\Article');
    }
}
