<?php


namespace Model;


use Entity\Post;

class PostManagerPDO extends PostManager
{

    /**
     * @param array $options
     * @return mixed
     * @throws \Exception
     */
    public function getList($options = [])
    {
        $sql = 'SELECT * FROM Post ';


        if (isset($options['visible'])) {
            $sql .= ' WHERE visible =' . $options['visible'] . ' ';
        }
        if (isset($options['userId'])) {
            $sql .= ' WHERE userId =' . $options['userId'] . ' ';
        }
        $sql .= 'ORDER BY publicationDate DESC ';
        if (isset($options['limit'])) {
            $sql .= ' LIMIT ' . (int)$options['limit'] . ' ';
        }
        if (isset($options['offset'])) {
            $sql .= ' OFFSET ' . (int)$options['offset'] . ' ';
        }


        $query = $this->dao->query($sql);
        $query->setFetchMode(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE, '\Entity\Post');


        $postsList = $query->fetchAll();

        $query->closeCursor();
        $userManager = new UserManagerPDO($this->dao);

        foreach ($postsList as $post) {
            $post->setUser($userManager->getByAttribute('id', $post->userId));
            $post->setPublicationDate(new \DateTime($post->getPublicationDate()));
            $post->setModificationDate(new \DateTime($post->getModificationDate()));

            $imagePath = $_SERVER["DOCUMENT_ROOT"] . '/images/post/post-' . $post->getId() . '.jpg';
            if (file_exists($imagePath)) {
                $post->setFeaturedImage('/images/post/post-' . $post->getId() . '.jpg');
            }else{
                $post->setFeaturedImage('/images/post/post-default.jpg');
            }

        }

        return $postsList;

    }


    /**
     * @param $attribute
     * @param $value
     * @param array $options
     * @return Post | null
     * @throws \Exception
     */
    public function getByAttribute($attribute, $value, $options = [])
    {
        $sql = 'SELECT * FROM Post ';
        $sql .= 'WHERE ' . $attribute . ' = ' . $value . ' ';
        if (isset($options['visible'])) {
            $sql .= 'AND visible = ' . (int)$options['visible'];
        }

        $query = $this->dao->query($sql);

        $query->setFetchMode(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE, '\Entity\Post');


        if ($post = $query->fetch()) {

            $query->closeCursor();

            $post->setUser((new UserManagerPDO($this->dao))->getByAttribute('id', $post->userId));
            $post->setPublicationDate(new \DateTime($post->getPublicationDate()));
            $post->setModificationDate(new \DateTime($post->getModificationDate()));

            $imagePath = $_SERVER["DOCUMENT_ROOT"] . '/images/post/post-' . $post->getId() . '.jpg';

            if (file_exists($imagePath)) {
                $post->setFeaturedImage('/images/post/post-' . $post->getId() . '.jpg');
            }else{
                $post->setFeaturedImage('/images/post/post-default.jpg');
            }

            return $post;
        }

        return null;

    }

    public function count($options = [])
    {
        $sql = 'SELECT count(*) FROM Post ';
        if (isset($options['visible'])) {
            $sql .= ' WHERE visible =' . $options['visible'] . ' ';
        }
        if (isset($options['userId'])) {
            $sql .= ' WHERE userId =' . $options['userId'] . ' ';
        }
        $query = $this->dao->query($sql);

        return $query->fetchColumn();
    }

    public function add(Post $post)
    {
        $sql = 'INSERT INTO Post (title, subtitle, content, userId, visible, publicationDate, modificationDate ) ';
        $sql .= 'VALUES (:title, :subtitle, :content, :userId, :visible, NOW(), NOW()) ';

        $query = $this->dao->prepare($sql);

        $query->bindValue(':title', $post->getTitle());
        $query->bindValue(':subtitle', $post->getSubTitle());
        $query->bindValue(':content', $post->getContent());
        $query->bindValue(':visible', $post->isVisible(), \PDO::PARAM_INT);
        $query->bindValue(':userId', $post->getUser()->getId(), \PDO::PARAM_INT);

        $query->execute();


        if ($post->getFeaturedImage() !== null) {
            $imageTarget = $_SERVER["DOCUMENT_ROOT"] . '/images/post/post-' . $this->dao->lastInsertId() . '.jpg';
            $post->getFeaturedImage()->moveTo($imageTarget);
        }

    }

    public function update(Post $post)
    {
        $sql = 'UPDATE Post SET ';
        $sql .= 'title=:title, ';
        $sql .= 'subtitle=:subtitle, ';
        $sql .= 'content=:content, ';
        $sql .= 'userId=:userId, ';
        $sql .= 'visible=:visible, ';
        $sql .= 'modificationDate= NOW()  ';
        $sql .= 'WHERE id = :id';

        $query = $this->dao->prepare($sql);

        $query->bindValue(':id', $post->getId(), \PDO::PARAM_INT);
        $query->bindValue(':title', $post->getTitle());
        $query->bindValue(':subtitle', $post->getSubTitle());
        $query->bindValue(':content', $post->getContent());
        $query->bindValue(':userId', $post->getUser()->getId(), \PDO::PARAM_INT);
        $query->bindValue(':visible', $post->isVisible(), \PDO::PARAM_INT);

        $query->execute();

        if ($post->getFeaturedImage() !== null) {
            $imageTarget = $_SERVER["DOCUMENT_ROOT"] . '/images/post/post-' . $post->getId() . '.jpg';
            $post->getFeaturedImage()->moveTo($imageTarget);
        }

    }

    public function delete($id)
    {

        $sql = 'DELETE FROM post ';
        $sql .= 'WHERE id=:id ';

        $query = $this->dao->prepare($sql);
        $query->bindValue(':id', $id, \PDO::PARAM_INT);

        $query->execute();

        $imagePath = $_SERVER["DOCUMENT_ROOT"] . '/images/post/post-' . $id . '.jpg';

        if (file_exists($imagePath)) {
            unlink($imagePath);
        }

    }
}