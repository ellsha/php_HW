<?php

namespace App\Http\Builders;

use App\Article;
use App\Tag;
use Auth;

class ArticleBuilder
{
    /**
     * @var string
     */
    private $title;

    /**
     * @var string
     */
    private $description;

    /**
     * @var string[]
     */
    private $tags;

    /**
     * Build article
     */
    public function build()
    {
        $article = $this->createArticle(
            $this->title,
            $this->description
        );

        if(isset($this->tags)) {
            $tagIds = $this->createTags($this->tags);
            $article->tags()->attach($tagIds);
        }

        return $article;
    }

    /**
     * @param $articleTitle
     */
    public function setTitle($articleTitle)
    {
        $this->title = $articleTitle;
    }

    /**
     * @param $articleDescription
     */
    public function setDescription($articleDescription)
    {
        $this->description = $articleDescription;
    }

    /**
     * @param $tagString
     */
    public function setTags($tagString)
    {
        $this->tags = $this->explodeTagString($tagString);
    }

    /**
     * @param string $title
     * @param string $description
     *
     * @return Article
     */
    public function createArticle($title, $description)
    {
        $article = new Article();
        $article->title = $title;
        $article->description = $description;
        $article->user_id = Auth::user()->id;
        $article->saveOrFail();

        return $article;
    }

    /**
     * @param string[] $tagNames
     *
     * @return integer[] tagIds
     */
    private function createTags($tagNames)
    {
        $tags = $this->filterExistTags($tagNames);
        $tags = $this->transformTags($tags);
        Tag::insert($tags);

        return Tag::whereIn('name', $tagNames)->pluck('id')->toArray();
    }

    /**
     * @param $tagString
     *
     * @return string[]
     */
    private function explodeTagString($tagString)
    {
        return explode(', ', trim($tagString));
    }

    /**
     * @param $tagNames
     *
     * @return string[]
     */
    private function filterExistTags($tagNames)
    {
        $existTags = Tag::whereIn('name', $tagNames)->pluck('name')->toArray();

        return array_diff($tagNames, $existTags);
    }

    /**
     * @param $tagNames
     *
     * @return string[]
     */
    private function transformTags($tagNames)
    {
        return collect($tagNames)->map(function($name) {
            return ['name' => $name];
        })->toArray();
    }
}
