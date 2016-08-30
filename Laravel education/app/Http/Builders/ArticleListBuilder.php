<?php


namespace App\Http\Builders;


use App\Article;
use Illuminate\Support\Facades\Input;

class ArticleListBuilder
{
    /**
     * Search string with text and tags
     *
     * @var string
     */
    private $query;

    /**
     * Count of articles per page
     *
     * @var int
     */
    private $perPage = 10;

    /**
     * Direction for articles by created time
     *
     * @var bool
     */
    private $descDirection = true;

    /**
     * Filter by request and get articles
     *
     * @return Article
     */
    public function build()
    {
        $direction = ($this->descDirection) ? 'desc' : 'ask';

        $articles = Article::orderBy('articles.created_at', $direction);
        $articles = $this->fullTextSearch($this->query, $articles);
        $articles = $this->tagsSearch($this->query, $articles);
        $articles = $articles->paginate($this->perPage);
        $articles = $articles->appends(Input::except('page'));

        return $articles;
    }

    /**
     * Sets query from request (consists of search string)
     *
     * @param string $query
     */
    public function setQuery($query)
    {
        $this->query = $query;
    }

    /**
     * Sets count of articles for a page at site
     *
     * @param int $perPage
     */
    public function setCountPerPage($perPage)
    {
        $this->perPage = $perPage;
    }

    /**
     * Sets reverse direction (last articles -> first articles)
     */
    public function setDescDirection()
    {
        $this->descDirection = true;
    }

    /**
     * Sets forward direction (first articles -> last articles)
     */
    public function setAskDirection()
    {
        $this->descDirection = false;
    }

    /**
     * Return articles that have words from query in title
     *
     * @param string $query
     * @param \App\Article[] $articles
     * @return \App\Article[]
     */
    private function fullTextSearch($query, $articles)
    {
        $text = $this->getTextQuery($query);

        if(count($text) > 0) {
            return $articles->whereIn('title', $text);
        }

        return $articles;
    }

    /**
     * Return articles that have tags from query
     *
     * @param string $query
     * @param \App\Article[] $articles
     * @return \App\Article[]
     */
    private function tagsSearch($query, $articles)
    {
        $tags = $this->getTagsQuery($query);

        if(count($tags) > 0) {
            return $articles
                ->join('tag_article', 'articles.id', '=', 'tag_article.article_id')
                ->join('tags', 'tag_article.tag_id', '=', 'tags.id')
                ->whereIn('name', $tags)->select('articles.*');
        }

        return $articles;
    }

    /**
     * Return words without tags from request
     *
     * @param string $query
     * @return \string[]
     */
    private function getTextQuery($query)
    {
        $text = preg_replace('/#(\w+)/', '', $query);
        $text = preg_replace('/(\s\s+)/', ' ', $text);
        $text = explode(' ', $text);

        if($text[0] == '') {
            return [];
        }

        return $text;
    }

    /**
     * Return tags name array from request
     *
     * @param string $query
     * @return \string[]
     */
    private function getTagsQuery($query)
    {
        preg_match_all('/#(\w+)/', $query, $text,  PREG_PATTERN_ORDER);

        return $text[1];
    }

}