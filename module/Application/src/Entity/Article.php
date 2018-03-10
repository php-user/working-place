<?php

namespace Application\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Article
 *
 * @ORM\Table(name="article", uniqueConstraints={@ORM\UniqueConstraint(name="title_u_k", columns={"title"})}, indexes={@ORM\Index(name="category_id_key", columns={"category_id"}), @ORM\Index(name="article_like_key", columns={"article_like"}), @ORM\Index(name="article_dislike_key", columns={"article_dislike"})})
 * @ORM\Entity
 */
class Article
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer", precision=0, scale=0, nullable=false, unique=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="title", type="string", length=100, precision=0, scale=0, nullable=false, unique=false)
     */
    private $title;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="text", length=65535, precision=0, scale=0, nullable=false, unique=false)
     */
    private $description;

    /**
     * @var string
     *
     * @ORM\Column(name="content", type="text", length=65535, precision=0, scale=0, nullable=false, unique=false)
     */
    private $content;

    /**
     * @var bool|null
     *
     * @ORM\Column(name="is_public", type="boolean", precision=0, scale=0, nullable=true, unique=false)
     */
    private $isPublic;

    /**
     * @var int
     *
     * @ORM\Column(name="article_like", type="integer", precision=0, scale=0, nullable=false, unique=false)
     */
    private $articleLike;

    /**
     * @var int
     *
     * @ORM\Column(name="article_dislike", type="integer", precision=0, scale=0, nullable=false, unique=false)
     */
    private $articleDislike;

    /**
     * @var string|null
     *
     * @ORM\Column(name="image", type="string", length=200, precision=0, scale=0, nullable=true, unique=false)
     */
    private $image;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date_time", type="datetime", precision=0, scale=0, nullable=false, options={"default"="CURRENT_TIMESTAMP"}, unique=false)
     */
    private $dateTime = 'CURRENT_TIMESTAMP';

    /**
     * @var \Application\Entity\Category
     *
     * @ORM\ManyToOne(targetEntity="Application\Entity\Category")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="category_id", referencedColumnName="id", nullable=true)
     * })
     */
    private $category;


    /**
     * Get id.
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set title.
     *
     * @param string $title
     *
     * @return Article
     */
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * Get title.
     *
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Set description.
     *
     * @param string $description
     *
     * @return Article
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get description.
     *
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set content.
     *
     * @param string $content
     *
     * @return Article
     */
    public function setContent($content)
    {
        $this->content = $content;

        return $this;
    }

    /**
     * Get content.
     *
     * @return string
     */
    public function getContent()
    {
        return $this->content;
    }

    /**
     * Set isPublic.
     *
     * @param bool|null $isPublic
     *
     * @return Article
     */
    public function setIsPublic($isPublic = null)
    {
        $this->isPublic = $isPublic;

        return $this;
    }

    /**
     * Get isPublic.
     *
     * @return bool|null
     */
    public function getIsPublic()
    {
        return $this->isPublic;
    }

    /**
     * Set articleLike.
     *
     * @param int $articleLike
     *
     * @return Article
     */
    public function setArticleLike($articleLike)
    {
        $this->articleLike = $articleLike;

        return $this;
    }

    /**
     * Get articleLike.
     *
     * @return int
     */
    public function getArticleLike()
    {
        return $this->articleLike;
    }

    /**
     * Set articleDislike.
     *
     * @param int $articleDislike
     *
     * @return Article
     */
    public function setArticleDislike($articleDislike)
    {
        $this->articleDislike = $articleDislike;

        return $this;
    }

    /**
     * Get articleDislike.
     *
     * @return int
     */
    public function getArticleDislike()
    {
        return $this->articleDislike;
    }

    /**
     * Set image.
     *
     * @param string|null $image
     *
     * @return Article
     */
    public function setImage($image = null)
    {
        $this->image = $image;

        return $this;
    }

    /**
     * Get image.
     *
     * @return string|null
     */
    public function getImage()
    {
        return $this->image;
    }

    /**
     * Set dateTime.
     *
     * @param \DateTime $dateTime
     *
     * @return Article
     */
    public function setDateTime($dateTime)
    {
        $this->dateTime = $dateTime;

        return $this;
    }

    /**
     * Get dateTime.
     *
     * @return \DateTime
     */
    public function getDateTime()
    {
        return $this->dateTime;
    }

    /**
     * Set category.
     *
     * @param \Application\Entity\Category|null $category
     *
     * @return Article
     */
    public function setCategory(\Application\Entity\Category $category = null)
    {
        $this->category = $category;

        return $this;
    }

    /**
     * Get category.
     *
     * @return \Application\Entity\Category|null
     */
    public function getCategory()
    {
        return $this->category;
    }
}
