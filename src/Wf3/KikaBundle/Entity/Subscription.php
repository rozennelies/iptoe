<?php

namespace Wf3\KikaBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Subscription
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Wf3\KikaBundle\Entity\SubscriptionRepository")
 */
class Subscription
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
     * @var \DateTime
     *
     * @ORM\Column(name="dateCreated", type="datetime")
     */
    private $dateCreated;

    /**
     * @var integer
     *
     * @ORM\Column(name="isActive", type="integer")
     */
    private $isActive;

    // une inscription n a  qu utilisateur    : $user 
    // un utilsateur a plusieurs inscriptions : $subscriptions

    /**
     * @var Wf3\KikaBundle\Entity\User
     *
     * @ORM\ManyToOne(targetEntity="User", inversedBy="subscriptions")
     * 
     * @ORM\JoinColumn(nullable=false)
     */
    private $user;


    // plusieurs inscriptions pour 1 formation

    /**
     * @var Wf3\KikaBundle\Entity\Training
     *
     * @ORM\ManyToOne(targetEntity="Training", inversedBy="trainingSubscriptions")
     * 
     * @ORM\JoinColumn(nullable=false)
     */
    private $training;



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
     * Set dateCreated
     *
     * @param \DateTime $dateCreated
     * @return Subscription
     */
    public function setDateCreated($dateCreated)
    {
        $this->dateCreated = $dateCreated;

        return $this;
    }

    /**
     * Get dateCreated
     *
     * @return \DateTime 
     */
    public function getDateCreated()
    {
        return $this->dateCreated;
    }

    /**
     * Set isActive
     *
     * @param integer $isActive
     * @return Subscription
     */
    public function setIsActive($isActive)
    {
        $this->isActive = $isActive;

        return $this;
    }

    /**
     * Get isActive
     *
     * @return integer 
     */
    public function getIsActive()
    {
        return $this->isActive;
    }

    /**
     * Set user
     *
     * @param \Wf3\KikaBundle\Entity\User $user
     * @return Subscription
     */
    public function setUser(\Wf3\KikaBundle\Entity\User $user = null)
    {
        $this->user = $user;

        return $this;
    }

    /**
     * Get user
     *
     * @return \Wf3\KikaBundle\Entity\User 
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * Set training
     *
     * @param \Wf3\KikaBundle\Entity\Training $training
     * @return Subscription
     */
    public function setTraining(\Wf3\KikaBundle\Entity\Training $training = null)
    {
        $this->training = $training;

        return $this;
    }

    /**
     * Get training
     *
     * @return \Wf3\KikaBundle\Entity\Training 
     */
    public function getTraining()
    {
        return $this->training;
    }
}
