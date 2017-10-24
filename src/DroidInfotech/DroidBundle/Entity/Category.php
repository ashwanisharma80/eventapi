<?php

namespace DroidInfotech\DroidBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Category
 *
 * @ORM\Table(name="category")
 * @ORM\Entity(repositoryClass="DroidInfotech\DroidBundle\Repository\CategoryRepository")
 */
class Category
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;
    
      /**
     * @ORM\ManyToMany(targetEntity="Exhibitor", mappedBy="categoryIds")
     * */
    protected $categoryId;
  
    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255)
     */
    private $name;

    /**
     * @var bool
     *
     * @ORM\Column(name="active", type="boolean")
     */
    private $active;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="createdOn", type="datetime")
     */
    private $createdOn;


     public function __toString() {
        return $this->name;
    }
    
   
    
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->categoryId = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set name
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
     * Get name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set active
     *
     * @param boolean $active
     *
     * @return Category
     */
    public function setActive($active)
    {
        $this->active = $active;

        return $this;
    }

    /**
     * Get active
     *
     * @return boolean
     */
    public function getActive()
    {
        return $this->active;
    }

    /**
     * Set createdOn
     *
     * @param \DateTime $createdOn
     *
     * @return Category
     */
    public function setCreatedOn($createdOn)
    {
        $this->createdOn = $createdOn;

        return $this;
    }

    /**
     * Get createdOn
     *
     * @return \DateTime
     */
    public function getCreatedOn()
    {
        return $this->createdOn;
    }

   

    /**
     * Get categoryId
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getCategoryId()
    {
        return $this->categoryId;
    }

    /**
     * Add categoryId
     *
     * @param \DroidInfotech\DroidBundle\Entity\Exhibitor $categoryId
     *
     * @return Category
     */
    public function addCategoryId(\DroidInfotech\DroidBundle\Entity\Exhibitor $categoryId)
    {
        $this->categoryId[] = $categoryId;

        return $this;
    }

    /**
     * Remove categoryId
     *
     * @param \DroidInfotech\DroidBundle\Entity\Exhibitor $categoryId
     */
    public function removeCategoryId(\DroidInfotech\DroidBundle\Entity\Exhibitor $categoryId)
    {
        $this->categoryId->removeElement($categoryId);
    }
}
