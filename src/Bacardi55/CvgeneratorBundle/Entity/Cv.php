<?php

namespace Bacardi55\CvgeneratorBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * @ORM\Entity(repositoryClass="Bacardi55\CvgeneratorBundle\Repository\CvRepository")
 * @ORM\Table(name="Cv")
 */
class Cv{

  /**
   * @ORM\id
   * @ORM\Column(type="integer")
   * @ORM\GeneratedValue(strategy="IDENTITY")
   */
  protected $id;

  /**
   * @ORM\Column(type="string", length="100")
   */
  protected $title;

  /**
   * @ORM\Column(type="boolean")
   */
  protected $isTitleDisplayed;

  /**
  * @ORM\OneToMany(targetEntity="Category", mappedBy="cv")
  */
  private $categories;
  
  
  public function __construct(){
    $this->categories = new ArrayCollection();
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
     * Add categories
     *
     * @param Bacardi55\CvgeneratorBundle\Entity\Category $categories
     */
    public function addCategories(\Bacardi55\CvgeneratorBundle\Entity\Category $categories)
    {
        $this->categories[] = $categories;
    }

    /**
     * Get categories
     *
     * @return Doctrine\Common\Collections\Collection 
     */
    public function getCategories()
    {
        return $this->categories;
    }

    /**
     * Set isTitleDisplayed
     *
     * @param boolean $isTitleDisplayed
     */
    public function setIsTitleDisplayed($isTitleDisplayed)
    {
        $this->isTitleDisplayed = $isTitleDisplayed;
    }

    /**
     * Get isTitleDisplayed
     *
     * @return boolean 
     */
    public function getIsTitleDisplayed()
    {
        return $this->isTitleDisplayed;
    }
}