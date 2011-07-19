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
   * @ORM\Column(type="string", length="255", nullable="true")
   */
  protected $title;

  /**
   * @ORM\Column(type="date")
   */
  protected $startDate;

  /**
   * @ORM\Column(type="date")
   */
  protected $endDate;

  /**
   * @ORM\Column(type="text")
   */
  protected $text;


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
     * Set startDate
     *
     * @param date $startDate
     */
    public function setStartDate($startDate)
    {
        $this->startDate = $startDate;
    }

    /**
     * Get startDate
     *
     * @return date 
     */
    public function getStartDate()
    {
        return $this->startDate;
    }

    /**
     * Set endDate
     *
     * @param date $endDate
     */
    public function setEndDate($endDate)
    {
        $this->endDate = $endDate;
    }

    /**
     * Get endDate
     *
     * @return date 
     */
    public function getEndDate()
    {
        return $this->endDate;
    }

    /**
     * Set text
     *
     * @param text $text
     */
    public function setText($text)
    {
        $this->text = $text;
    }

    /**
     * Get text
     *
     * @return text 
     */
    public function getText()
    {
        return $this->text;
    }
}