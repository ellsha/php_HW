<?php

namespace App\Http\Builders;

class CommentTreeBuilder
{
    /**
     * Flat array of comments
     */
    private $comments;

    /**
     * Calling the recursive method
     *
     * @return array
     */
    public function build()
    {
        return $this->buildTree($this->comments);
    }

    /**
     * Create comments tree from flat array
     *
     * @param array $elements
     * @param int $parentId
     * @return array
     */
    private function buildTree($elements, $parentId = 0) {

        $branch = [];

        foreach ($elements as $element) {
            if ($element['comment_id'] == $parentId) {
                $children = $this->buildTree($elements, $element['id']);
                $element['children'] = $children ?: [];
                $branch[$element['id']] = $element;
                unset($elements[$element['id']]);
            }
        }

        return $branch;
    }

    /**
     * Set comments for transformation
     *
     * @param array $comments
     */
    public function setFlatCommentsArray($comments)
    {
        $this->comments = $comments;
    }
}
