<?php

namespace Wf3\KikaBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Category
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Wf3\KikaBundle\Entity\CategoryRepository")
 */
class Category
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255)
     */
    private $name;


    // pour une catégorie on a plusieurs formations  

    /**
     * @var \Doctrine\Common\Collections\ArrayCollection
     *
     * @ORM\OneToMany(targetEntity="Training", mappedBy="category")
     */
    private $categoryTrainings;


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
     * Constructor
     */
    public function __construct()
    {
        $this->categoryTrainings = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add categoryTrainings
     *
     * @param \Wf3\KikaBundle\Entity\Training $categoryTrainings
     * @return Category
     */
    public function addCategoryTraining(\Wf3\KikaBundle\Entity\Training $categoryTrainings)
    {
        $this->categoryTrainings[] = $categoryTrainings;

        return $this;
    }

    /**
     * Remove categoryTrainings
     *
     * @param \Wf3\KikaBundle\Entity\Training $categoryTrainings
     */
    public function removeCategoryTraining(\Wf3\KikaBundle\Entity\Training $categoryTrainings)
    {
        $this->categoryTrainings->removeElement($categoryTrainings);
    }

    /**
     * Get categoryTrainings
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getCategoryTrainings()
    {
        return $this->categoryTrainings;
    }
}
