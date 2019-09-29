<?php


namespace Model;


use Entity\Comment;
use Entity\Post;
use http\Exception\InvalidArgumentException;

class CommentManagerPDO extends CommentManager
{


    public function add(Comment $comment)
    {
        $sql = 'INSERT INTO Comment (content, postId, userId, publicationDate ) VALUES ';
        $sql .= '(:content, :postId, :userId, NOW()) ';

        $query = $this->dao->prepare($sql);
        $query->bindValue(':content', $comment->getContent());
        $query->bindValue(':postId', $comment->getPost()->getId(), \PDO::PARAM_INT);
        $query->bindValue(':userId', $comment->getUser()->getId(), \PDO::PARAM_INT);

        $query->execute();

        $comment->setId($this->dao->lastInsertId());
    }

    public function getListOf(Post $post)
    {
        // TODO: Implement getListOf() method.
        if (!ctype_digit($post->getId())) {
            throw new \InvalidArgumentException('L\'identifiant de l\'article doit d\'$etre un entier');
        }

        $sql = 'SELECT * FROM Comment ';
        $sql .= 'WHERE Comment.postId = :postId ';
        $sql .= 'ORDER BY publicationDate DESC';

        $query = $this->dao->prepare($sql);
        $query->bindValue(':postId', $post->getId(), \PDO::PARAM_INT);
        $query->execute();

        $query->setFetchMode(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE, '\Entity\Comment');

        $comments = $query->fetchALL();

        $userManager = new UserManagerPDO($this->dao);

        foreach ($comments as $comment) {
            $comment->setUser($userManager->getByAttribute('id', $comment->userId));
            $comment->setPost($post);
            $comment->setPublicationDate(new \DateTime($comment->getPublicationDate()));

        }

        return $comments;
    }

    protected function update(Comment $comment)
    {
        // TODO: Implement update() method.
    }

}