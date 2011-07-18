<?php 

namespace Bacardi55\CvgeneratorBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * @ORM\Entity
 * @ORM\Table(name="Element")
 */
class Element{

  /**
   * @ORM\id
   * @ORM\Column(type="integer")
   * @ORM\GeneratedValue(strategy="IDENTITY")
   */
  protected $id;

  /**
   * @ORM\ManyToOne(targetEntity="Category", inversedBy="elements")
   * @ORM\JoinColumn(name="category_id", referencedColumnName="id")
   */
  protected $category;
  


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
     * Set category
     *
     * @param Bacardi55\CvgeneratorBundle\Entity\Category $category
     */
    public function setCategory(\Bacardi55\CvgeneratorBundle\Entity\Category $category)
    {
        $this->category = $category;
    }

    /**
     * Get category
     *
     * @return Bacardi55\CvgeneratorBundle\Entity\Category 
     */
    public function getCategory()
    {
        return $this->category;
    }
}