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
        $query->bindValue(':content', $comment->getContent(), \PDO::PARAM_STR);
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


    public function getList($options = [])
    {
        $sql = 'SELECT * FROM Comment ';


        if (isset($options['valid'])) {
            $sql .= ' WHERE visible =' . $options['valid'] . ' ';
        }
        $sql .= 'ORDER BY publicationDate DESC ';
        if (isset($options['limit'])) {
            $sql .= ' LIMIT ' . (int)$options['limit'] . ' ';
        }
        if (isset($options['offset'])) {
            $sql .= ' OFFSET ' . (int)$options['offset'] . ' ';
        }


        $query = $this->dao->query($sql);
        $query->setFetchMode(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE, '\Entity\Comment');


        $commentsList = $query->fetchAll();

        $query->closeCursor();

        $userManager = new UserManagerPDO($this->dao);
        $postManager = new PostManagerPDO($this->dao);

        foreach ($commentsList as $comment) {
            $comment->setUser($userManager->getByAttribute('id', $comment->userId));
            $comment->setPublicationDate(new \DateTime($comment->getPublicationDate()));
            $comment->setPost($postManager->getByAttribute('id', $comment->postId));
        }

        return $commentsList;
    }

    protected function update(Comment $comment)
    {
        // TODO: Implement update() method.
    }

    public function count($options = [])
    {
        $sql = 'SELECT count(*) FROM Comment ';

        if (isset($options['userId'])) {
            $sql .= 'INNER JOIN Post on Comment.postId = Post.id ';
            $sql .= 'WHERE Post.userId = ' . $options['userId'] . ' ';
            if (isset($options['valid'])) {
                $sql .= ' AND Comment.valid =' . $options['valid'] . ' ';
            }
        } elseif (isset($options['valid'])) {
            $sql .= ' WHERE valid =' . $options['valid'] . ' ';
        }

        $query = $this->dao->query($sql);


        return $query->fetchColumn();
    }

    public function getByAttribute($attribute, $value, $options = [])
    {
        $sql = 'SELECT * FROM Comment ';
        $sql .= 'WHERE ' . $attribute . ' = ' . $value . ' ';
        if (isset($options['valid'])) {
            $sql .= 'AND valid = ' . (int)$options['valid'];
        }

        $query = $this->dao->query($sql);

        $query->setFetchMode(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE, '\Entity\Comment');


        if ($comment = $query->fetch()) {
            $query->closeCursor();

            $userManager = new UserManagerPDO($this->dao);
            $postManager = new PostManagerPDO($this->dao);

            $comment->setUser($userManager->getByAttribute('id', $comment->userId));
            $comment->setPublicationDate(new \DateTime($comment->getPublicationDate()));
            $comment->setPost($postManager->getByAttribute('id', $comment->postId));

            return $comment;
        }

        return null;
    }

    public function validate($id)
    {

        $sql = "UPDATE Comment SET ";
        $sql .= "valid = :valid ";
        $sql .= "WHERE id = :id ";

        $query = $this->dao->prepare($sql);

        $query->bindValue(':id', $id, \PDO::PARAM_INT);
        $query->bindValue(':valid', 1, \PDO::PARAM_INT);

        $query->execute();
    }

    public function invalidate($id)
    {

        $sql = "UPDATE Comment SET ";
        $sql .= "valid = :valid ";
        $sql .= "WHERE id = :id ";

        $query = $this->dao->prepare($sql);

        $query->bindValue(':id', $id, \PDO::PARAM_INT);
        $query->bindValue(':valid', 0, \PDO::PARAM_INT);

        $query->execute();
    }

    public function delete($id)
    {

        $sql = 'DELETE FROM Comment ';
        $sql .= 'WHERE id=:id ';

        $query = $this->dao->prepare($sql);
        $query->bindValue(':id', $id, \PDO::PARAM_INT);

        $query->execute();
    }
}
