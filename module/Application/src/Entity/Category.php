<?php

namespace Application\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Category
 *
 * @ORM\Table(name="category", uniqueConstraints={@ORM\UniqueConstraint(name="name_u_k", columns={"name"})}, indexes={@ORM\Index(name="category_parent_id_key", columns={"parent_id"})})
 * @ORM\Entity
 */
class Category
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
     * @ORM\Column(name="name", type="string", length=100, precision=0, scale=0, nullable=false, unique=false)
     */
    private $name;

    /**
     * @var bool|null
     *
     * @ORM\Column(name="is_visible", type="boolean", precision=0, scale=0, nullable=true, options={"default"="1"}, unique=false)
     */
    private $isVisible = '1';

    /**
     * @var bool
     *
     * @ORM\Column(name="category_order", type="boolean", precision=0, scale=0, nullable=false, unique=false)
     */
    private $categoryOrder;

    /**
     * @var \Application\Entity\Category
     *
     * @ORM\ManyToOne(targetEntity="Application\Entity\Category")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="parent_id", referencedColumnName="id", nullable=true)
     * })
     */
    private $parent;


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
     * Set name.
     *
     * @param string $name
     *
     * @return Category
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name.
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set isVisible.
     *
     * @param bool|null $isVisible
     *
     * @return Category
     */
    public function setIsVisible($isVisible = null)
    {
        $this->isVisible = $isVisible;

        return $this;
    }

    /**
     * Get isVisible.
     *
     * @return bool|null
     */
    public function getIsVisible()
    {
        return $this->isVisible;
    }

    /**
     * Set categoryOrder.
     *
     * @param bool $categoryOrder
     *
     * @return Category
     */
    public function setCategoryOrder($categoryOrder)
    {
        $this->categoryOrder = $categoryOrder;

        return $this;
    }

    /**
     * Get categoryOrder.
     *
     * @return bool
     */
    public function getCategoryOrder()
    {
        return $this->categoryOrder;
    }

    /**
     * Set parent.
     *
     * @param \Application\Entity\Category|null $parent
     *
     * @return Category
     */
    public function setParent(\Application\Entity\Category $parent = null)
    {
        $this->parent = $parent;

        return $this;
    }

    /**
     * Get parent.
     *
     * @return \Application\Entity\Category|null
     */
    public function getParent()
    {
        return $this->parent;
    }
}
