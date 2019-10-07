<?php

namespace Entity;

use OpenFram\Entity;

class Post extends Entity
{
    protected $title;
    protected $subtitle;
    protected $content;
    protected $author;
    protected $user;
    protected $visible = 0;
    protected $publicationDate;
    protected $modificationDate;
    protected $featuredImage = null;


    /**
     *
     */
    public function isValid(): bool
    {
        return !(empty($this->title) || empty($this->user));
    }

    /**
     * @return mixed
     */
    public function getTitle(): ?string
    {
        return $this->title;
    }

    /**
     * @param mixed $title
     */
    public function setTitle($title): void
    {
        if (is_string($title)) {
            $this->title = $title;
        }
    }

    /**
     * @return mixed
     */
    public function getSubtitle(): ?string
    {
        return $this->subtitle;
    }

    /**
     * @param mixed $subtitle
     */
    public function setSubtitle($subtitle): void
    {
        if (is_string($subtitle)) {
            $this->subtitle = $subtitle;
        }
    }

    /**
     * @return mixed
     */
    public function getContent(): ?string
    {
        return $this->content;
    }

    /**
     * @param mixed $content
     */
    public function setContent($content): void
    {
        if (is_string($content)) {
            $this->content = $content;
        }
    }

    /**
     * @return mixed
     */
    public function getUser(): User
    {
        return $this->user;
    }

    /**
     * @param User $user
     */
    public function setUser(User $user): void
    {
        $this->user = $user;
    }

    /**
     * @return bool
     */
    public function isVisible(): int
    {
        return $this->visible;
    }

    /**
     * @param bool $visible
     */
    public function setVisible($visible)
    {
        $this->visible = $visible;
    }

    /**
     * @return mixed
     */
    public function getPublicationDate()
    {
        return $this->publicationDate;
    }

    /**
     * @param mixed $publicationDate
     */
    public function setPublicationDate( $publicationDate)
    {
        $this->publicationDate = $publicationDate;
    }

    /**
     * @return mixed
     */
    public function getModificationDate()
    {
        return $this->modificationDate;
    }

    /**
     * @param mixed $modificationDate
     */
    public function setModificationDate( $modificationDate)
    {
        $this->modificationDate = $modificationDate;
    }

    /**
     * @return mixed
     */
    public function getAuthor()
    {
        return $this->author;
    }

    /**
     * @param mixed $author
     */
    public function setAuthor($author): void
    {
        $this->author = $author;
    }

    /**
     * @return mixed
     */
    public function getFeaturedImage()
    {
        return $this->featuredImage;
    }

    /**
     * @param mixed $featuredImage
     */
    public function setFeaturedImage($featuredImage): void
    {
        $this->featuredImage = $featuredImage;
    }


}