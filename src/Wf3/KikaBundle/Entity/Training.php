<?php

namespace Wf3\KikaBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Training
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Wf3\KikaBundle\Entity\TrainingRepository")
 */
class Training
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
     * @ORM\Column(name="title", type="string", length=255)
     *
     * @Assert\NotBlank(message="l'intitulé de la formation doit être rempli")
     *
     */
    private $title;

    /**
     * @var string
     *
     * @ORM\Column(name="img", type="string", length=255, nullable=false)
     *
     */
    private $img;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="beginDate", type="date", nullable=false)
     */
    private $beginDate;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="beginHours", type="time")
     */
    private $beginHours;

    /**
     * @var string
     *
     * @ORM\Column(name="street", type="string", length=255)
     */
    private $street;

    /**
     * @var string
     *
     * @ORM\Column(name="city", type="string", length=255)
     */
    private $city;

    /**
     * @var integer
     *
     * @ORM\Column(name="postalCd", type="integer")
     */
    private $postalCd;

    /**
     * @var string
     *
     * @ORM\Column(name="country", type="string", length=255)
     */
    private $country;

    /**
     * @var integer
     *
     * @ORM\Column(name="duration", type="integer")
     */
    private $duration;

    /**
     * @var integer
     *
     * @ORM\Column(name="numberPlaces", type="integer")
     */
    private $numberPlaces;

    /**
     * @var integer
     *
     * @ORM\Column(name="numberStudent", type="integer")
     */
    private $numberStudent;

    /**
     * @var string
     *
     * @ORM\Column(name="trainingDesc", type="text")
     */
    private $trainingDesc;

    /**
     * @var integer
     *
     * @ORM\Column(name="status", type="integer")
     */
    private $status;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="dateCreated", type="datetime")
     */
    private $dateCreated;


    // une formation n a qu un coach

    /**
     * @var Wf3\KikaBundle\Entity\User
     *
     * @ORM\ManyToOne(targetEntity="User", inversedBy="coachTrainings")
     * 
     * @ORM\JoinColumn(nullable=false)
     */
    private $coach;


    // une formation a plusieurs inscriptions  

    /**
     * @var \Doctrine\Common\Collections\ArrayCollection
     *
     * @ORM\OneToMany(targetEntity="Subscription", mappedBy="training")
     */
    private $trainingSubscriptions;


    /**
     * @var Wf3\KikaBundle\Entity\Category
     *
     * @ORM\ManyToOne(targetEntity="Category", inversedBy="categoryTrainings" )
     * 
     * @ORM\JoinColumn(nullable=false)
     */
    private $category;


    /**
    *
    * @Assert\Image(
    *     minWidth = 200,
    *     maxWidth = 400,
    *     minHeight = 200,
    *     maxHeight = 400,
    *     mimeTypesMessage = "Ce fichier n'est pas une image"
    *)
    */
    private $file;




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
     * @return Training
     */
    public function setTitle($title)
    {
        $this->title = strip_tags($title);

        return $this;
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
     * Set img
     *
     * @param string $img
     * @return Training
     */
    public function setImg($img)
    {
        $this->img = $img;

        return $this;
    }

    /**
     * Get img
     *
     * @return string 
     */
    public function getImg()
    {
        return $this->img;
    }

    /**
     * Set beginDate
     *
     * @param \DateTime $beginDate
     * @return Training
     */
    public function setBeginDate($beginDate)
    {
        $this->beginDate = $beginDate;

        return $this;
    }

    /**
     * Get beginDate
     *
     * @return \DateTime 
     */
    public function getBeginDate()
    {
        return $this->beginDate;
    }

    /**
     * Set beginHours
     *
     * @param \DateTime $beginHours
     * @return Training
     */
    public function setBeginHours($beginHours)
    {
        $this->beginHours = $beginHours;

        return $this;
    }

    /**
     * Get beginHours
     *
     * @return \DateTime 
     */
    public function getBeginHours()
    {
        return $this->beginHours;
    }

    /**
     * Set street
     *
     * @param string $street
     * @return Training
     */
    public function setStreet($street)
    {
        $this->street = strip_tags($street);

        return $this;
    }

    /**
     * Get street
     *
     * @return string 
     */
    public function getStreet()
    {
        return $this->street;
    }

    /**
     * Set city
     *
     * @param string $city
     * @return Training
     */
    public function setCity($city)
    {
        $this->city = strip_tags($city);

        return $this;
    }

    /**
     * Get city
     *
     * @return string 
     */
    public function getCity()
    {
        return $this->city;
    }

    /**
     * Set postalCd
     *
     * @param integer $postalCd
     * @return Training
     */
    public function setPostalCd($postalCd)
    {
        $this->postalCd = $postalCd;

        return $this;
    }

    /**
     * Get postalCd
     *
     * @return integer 
     */
    public function getPostalCd()
    {
        return $this->postalCd;
    }

    /**
     * Set country
     *
     * @param string $country
     * @return Training
     */
    public function setCountry($country)
    {
        $this->country = $country;

        return $this;
    }

    /**
     * Get country
     *
     * @return string 
     */
    public function getCountry()
    {
        return $this->country;
    }

    /**
     * Set duration
     *
     * @param integer $duration
     * @return Training
     */
    public function setDuration($duration)
    {
        $this->duration = $duration;

        return $this;
    }

    /**
     * Get duration
     *
     * @return integer 
     */
    public function getDuration()
    {
        return $this->duration;
    }

    /**
     * Set numberPlaces
     *
     * @param integer $numberPlaces
     * @return Training
     */
    public function setNumberPlaces($numberPlaces)
    {
        $this->numberPlaces = $numberPlaces;

        return $this;
    }

    /**
     * Get numberPlaces
     *
     * @return integer 
     */
    public function getNumberPlaces()
    {
        return $this->numberPlaces;
    }

    /**
     * Set numberStudent
     *
     * @param integer $numberStudent
     * @return Training
     */
    public function setNumberStudent($numberStudent)
    {
        $this->numberStudent = $numberStudent;

        return $this;
    }

    /**
     * Get numberStudent
     *
     * @return integer 
     */
    public function getNumberStudent()
    {
        return $this->numberStudent;
    }

    /**
     * Set trainingDesc
     *
     * @param string $trainingDesc
     * @return Training
     */
    public function setTrainingDesc($trainingDesc)
    {
        $this->trainingDesc = $trainingDesc;

        return $this;
    }

    /**
     * Get trainingDesc
     *
     * @return string 
     */
    public function getTrainingDesc()
    {
        return $this->trainingDesc;
    }

    /**
     * Set status
     *
     * @param integer $status
     * @return Training
     */
    public function setStatus($status)
    {
        $this->status = $status;

        return $this;
    }

    /**
     * Get status
     *
     * @return integer 
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * Set dateCreated
     *
     * @param \DateTime $dateCreated
     * @return Training
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
     * Set coach
     *
     * @param \Wf3\KikaBundle\Entity\User $coach
     * @return Training
     */
    public function setCoach(\Wf3\KikaBundle\Entity\User $coach = null)
    {
        $this->coach = $coach;

        return $this;
    }

    /**
     * Get coach
     *
     * @return \Wf3\KikaBundle\Entity\User 
     */
    public function getCoach()
    {
        return $this->coach;
    }
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->trainingSubscriptions = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add trainingSubscriptions
     *
     * @param \Wf3\KikaBundle\Entity\Subscription $trainingSubscriptions
     * @return Training
     */
    public function addTrainingSubscription(\Wf3\KikaBundle\Entity\Subscription $trainingSubscriptions)
    {
        $this->trainingSubscriptions[] = $trainingSubscriptions;

        return $this;
    }

    /**
     * Remove trainingSubscriptions
     *
     * @param \Wf3\KikaBundle\Entity\Subscription $trainingSubscriptions
     */
    public function removeTrainingSubscription(\Wf3\KikaBundle\Entity\Subscription $trainingSubscriptions)
    {
        $this->trainingSubscriptions->removeElement($trainingSubscriptions);
    }

    /**
     * Get trainingSubscriptions
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getTrainingSubscriptions()
    {
        return $this->trainingSubscriptions;
    }

    /**
     * Set category
     *
     * @param \Wf3\KikaBundle\Entity\Category $category
     * @return Training
     */
    public function setCategory(\Wf3\KikaBundle\Entity\Category $category = null)
    {
        $this->category = $category;

        return $this;
    }

    /**
     * Get category
     *
     * @return \Wf3\KikaBundle\Entity\Category 
     */
    public function getCategory()
    {
        return $this->category;
    }

     /**
     * Set file
     *
     * @param string $file
     * @return User
     */
    public function setFile($file)
    {
        $this->file = $file;

        return $this;
    }

    /**
     * Get file
     *
     * @return string 
     */
    public function getFile()
    {
        return $this->file;
    }
}
