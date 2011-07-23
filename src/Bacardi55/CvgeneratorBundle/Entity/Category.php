<?php

namespace Bacardi55\CvgeneratorBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * @ORM\Entity
 * @ORM\Table(name="Category")
 */
class Category{

  /**
   * @ORM\id
   * @ORM\Column(type="integer")
   * @ORM\GeneratedValue(strategy="IDENTITY")
   */
  protected $id;

  /**
   * @ORM\Column(type="string", length="255")
   */
  protected $title;
  
  /**
   * @ORM\ManyToOne(targetEntity="Cv", inversedBy="categories")
   * @ORM\JoinColumn(name="cv_id", referencedColumnName="id")
   */
  private $cv;
  
  /**
   * @ORM\OneToMany(targetEntity="Element", mappedBy="category")
   */
  private $elements;
  
  /**
   * @ORM\OneToMany(targetEntity="Category", mappedBy="parentCategory")
   */
  private $childrenCategories;
      
  /**
   * @ORM\ManyToOne(targetEntity="Category", inversedBy="childrenCategories")
   * @ORM\JoinColumn(name="parent_id", referencedColumnName="id")
   */
  private $parentCategory;
  
  public function __construct(){
    $this->elements = new ArrayCollection();
    $this->childrenCategory = new ArrayCollection();
  }

  public function __toString(){
    return $this->title;
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
     * Set title
     *
     * @param string $title
     */
    public function setTitle($title)
    {
        $this->title = $title;
    }

    /**
     * Get title
     *
     * @return string 
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Set cv
     *
     * @param Bacardi55\CvgeneratorBundle\Entity\Cv $cv
     */
    public function setCv(\Bacardi55\CvgeneratorBundle\Entity\Cv $cv)
    {
        $this->cv = $cv;
    }

    /**
     * Get cv
     *
     * @return Bacardi55\CvgeneratorBundle\Entity\Cv 
     */
    public function getCv()
    {
        return $this->cv;
    }

    /**
     * Add elements
     *
     * @param Bacardi55\CvgeneratorBundle\Entity\Element $elements
     */
    public function addElements(\Bacardi55\CvgeneratorBundle\Entity\Element $elements)
    {
        $this->elements[] = $elements;
    }

    /**
     * Get elements
     *
     * @return Doctrine\Common\Collections\Collection 
     */
    public function getElements()
    {
        return $this->elements;
    }

    /**
     * Add childrenCategories
     *
     * @param Bacardi55\CvgeneratorBundle\Entity\Category $childrenCategories
     */
    public function addChildrenCategories(\Bacardi55\CvgeneratorBundle\Entity\Category $childrenCategories)
    {
        $this->childrenCategories[] = $childrenCategories;
    }

    /**
     * Get childrenCategories
     *
     * @return Doctrine\Common\Collections\Collection 
     */
    public function getChildrenCategories()
    {
        return $this->childrenCategories;
    }

    /**
     * Set parentCategory
     *
     * @param Bacardi55\CvgeneratorBundle\Entity\Category $parentCategory
     */
    public function setParentCategory(\Bacardi55\CvgeneratorBundle\Entity\Category $parentCategory)
    {
        $this->parentCategory = $parentCategory;
    }

    /**
     * Get parentCategory
     *
     * @return Bacardi55\CvgeneratorBundle\Entity\Category 
     */
    public function getParentCategory()
    {
        return $this->parentCategory;
    }
}
