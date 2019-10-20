<?php


namespace Model;


use Entity\Comment;
use Entity\Post;
use http\Exception\RuntimeException;
use OpenFram\Manager;

abstract class CommentManager extends Manager
{
    abstract protected function add(Comment $comment);

    abstract protected function getListOf(Post $post);

    abstract protected function update(Comment $comment);

    public function save(Comment $comment)
    {
        if($comment->isValid()) {
            $comment->isNew() ? $this->add($comment) : $this->update($comment);
        }else{
            throw new RuntimeException('Le commentaire doit être valid pour être enregistré');
        }
    }




}
