<?php

namespace Wf3\KikaBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * User
 *
 * @ORM\Table("kika_user")
 * @ORM\Entity(repositoryClass="Wf3\KikaBundle\Entity\UserRepository")
 */
class User
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
     * @ORM\Column(name="pseudo", type="string", length=100)
     *
     * @Assert\NotBlank()
     *
     * @Assert\Length(
     *      min = "2",
     *      max = "255",
     *      minMessage = "Votre pseudo doit faire au moins {{ limit }} caractères",
     *      maxMessage = "Votre pseudo ne peut pas être plus long que {{ limit }} caractères"
     * )
     *
     */
    private $pseudo;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255)
     *
     * @Assert\Length(
     *      min = "2",
     *      max = "255",
     *      minMessage = "Votre nom doit faire au moins {{ limit }} caractères",
     *      maxMessage = "Votre nom ne peut pas être plus long que {{ limit }} caractères"
     *)   
     *
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="firstname", type="string", length=255)
     *
     * @Assert\Length(
     *      min = "2",
     *      max = "255",
     *      minMessage = "Votre prénom doit faire au moins {{ limit }} caractères",
     *      maxMessage = "Votre prénom ne peut pas être plus long que {{ limit }} caractères"
     *)
     *
     */
    private $firstname;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="birthDate", type="datetime")
     */
    private $birthDate;

    /**
     * @var string
     *
     * @ORM\Column(name="gender", type="string", length=1)
     */
    private $gender;

    /**
     * @var string
     *
     * @ORM\Column(name="job", type="string", length=150)
     */
    private $job;

    /**
     * @var string
     *
     * @ORM\Column(name="trainerDesc", type="text")
     */
    private $trainerDesc;

    /**
     * @var string
     *
     * @ORM\Column(name="studentDesc", type="text")
     */
    private $studentDesc;

    /**
     * @var string
     *
     * @ORM\Column(name="img", type="string", length=255, nullable=true)
     *     
     */
    private $img;

    /**
     * @var string
     *
     * @ORM\Column(name="email", type="string", length=255)
     */
    private $email;

    /**
     * @var string
     *
     * @ORM\Column(name="password", type="string", length=255)
     */
    private $password;

    /**
     * @var string
     *
     * @ORM\Column(name="salt", type="string", length=255)
     */
    private $salt;

    /**
     * @var string
     *
     * @ORM\Column(name="token", type="string", length=255)
     */
    private $token;

    /**
     * @var integer
     *
     * @ORM\Column(name="kikoCredit", type="integer")
     */
    private $kikoCredit;

    /**
     * @var boolean
     *
     * @ORM\Column(name="isActive", type="boolean")
     */
    private $isActive;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="dateCreated", type="datetime")
     */
    private $dateCreated;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="dateModified", type="datetime")
     */
    private $dateModified;

    /**
     * @var \Doctrine\Common\Collections\ArrayCollection
     *
     * @ORM\ManyToMany(targetEntity="Role")
     */
    private $roles;


    // un utilisateur peut avoir plusieurs inscriptions  : $subscriptions
    // une inscription n a  qu utilisateur    : $user 
    
    /**
     * @var \Doctrine\Common\Collections\ArrayCollection
     *
     * @ORM\OneToMany(targetEntity="Subscription", mappedBy="user")
     */
    private $subscriptions;


    // un coach peut donner plusieurs formation  

    /**
     * @var \Doctrine\Common\Collections\ArrayCollection
     *
     * @ORM\OneToMany(targetEntity="Training", mappedBy="coach")
     */
    private $coachTrainings;

    
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
     * Set pseudo
     *
     * @param string $pseudo
     * @return User
     */
    public function setPseudo($pseudo)
    {
        $this->pseudo = $pseudo;

        return $this;
    }

    /**
     * Get pseudo
     *
     * @return string 
     */
    public function getPseudo()
    {
        return $this->pseudo;
    }

    /**
     * Set name
     *
     * @param string $name
     * @return User
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
     * Set firstname
     *
     * @param string $firstname
     * @return User
     */
    public function setFirstname($firstname)
    {
        $this->firstname = $firstname;

        return $this;
    }

    /**
     * Get firstname
     *
     * @return string 
     */
    public function getFirstname()
    {
        return $this->firstname;
    }

    /**
     * Set birthDate
     *
     * @param \DateTime $birthDate
     * @return User
     */
    public function setBirthDate($birthDate)
    {
        $this->birthDate = $birthDate;

        return $this;
    }

    /**
     * Get birthDate
     *
     * @return \DateTime 
     */
    public function getBirthDate()
    {
        return $this->birthDate;
    }

    /**
     * Set gender
     *
     * @param string $gender
     * @return User
     */
    public function setGender($gender)
    {
        $this->gender = $gender;

        return $this;
    }

    /**
     * Get gender
     *
     * @return string 
     */
    public function getGender()
    {
        return $this->gender;
    }

    /**
     * Set job
     *
     * @param string $job
     * @return User
     */
    public function setJob($job)
    {
        $this->job = $job;

        return $this;
    }

    /**
     * Get job
     *
     * @return string 
     */
    public function getJob()
    {
        return $this->job;
    }

    /**
     * Set trainerDesc
     *
     * @param string $trainerDesc
     * @return User
     */
    public function setTrainerDesc($trainerDesc)
    {
        $this->trainerDesc = $trainerDesc;

        return $this;
    }

    /**
     * Get trainerDesc
     *
     * @return string 
     */
    public function getTrainerDesc()
    {
        return $this->trainerDesc;
    }

    /**
     * Set studentDesc
     *
     * @param string $studentDesc
     * @return User
     */
    public function setStudentDesc($studentDesc)
    {
        $this->studentDesc = $studentDesc;

        return $this;
    }

    /**
     * Get studentDesc
     *
     * @return string 
     */
    public function getStudentDesc()
    {
        return $this->studentDesc;
    }

    /**
     * Set img
     *
     * @param string $img
     * @return User
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
     * Set email
     *
     * @param string $email
     * @return User
     */
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Get email
     *
     * @return string 
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set password
     *
     * @param string $password
     * @return User
     */
    public function setPassword($password)
    {
        $this->password = $password;

        return $this;
    }

    /**
     * Get password
     *
     * @return string 
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * Set salt
     *
     * @param string $salt
     * @return User
     */
    public function setSalt($salt)
    {
        $this->salt = $salt;

        return $this;
    }

    /**
     * Get salt
     *
     * @return string 
     */
    public function getSalt()
    {
        return $this->salt;
    }

    /**
     * Set token
     *
     * @param string $token
     * @return User
     */
    public function setToken($token)
    {
        $this->token = $token;

        return $this;
    }

    /**
     * Get token
     *
     * @return string 
     */
    public function getToken()
    {
        return $this->token;
    }

    /**
     * Set kikoCredit
     *
     * @param integer $kikoCredit
     * @return User
     */
    public function setKikoCredit($kikoCredit)
    {
        $this->kikoCredit = $kikoCredit;

        return $this;
    }

    /**
     * Get kikoCredit
     *
     * @return integer 
     */
    public function getKikoCredit()
    {
        return $this->kikoCredit;
    }

    /**
     * Set isActive
     *
     * @param boolean $isActive
     * @return User
     */
    public function setIsActive($isActive)
    {
        $this->isActive = $isActive;

        return $this;
    }

    /**
     * Get isActive
     *
     * @return boolean 
     */
    public function getIsActive()
    {
        return $this->isActive;
    }

    /**
     * Set dateCreated
     *
     * @param \DateTime $dateCreated
     * @return User
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
     * Set dateModified
     *
     * @param \DateTime $dateModified
     * @return User
     */
    public function setDateModified($dateModified)
    {
        $this->dateModified = $dateModified;

        return $this;
    }

    /**
     * Get dateModified
     *
     * @return \DateTime 
     */
    public function getDateModified()
    {
        return $this->dateModified;
    }
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->roles = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add roles
     *
     * @param \Wf3\KikaBundle\Entity\Role $roles
     * @return User
     */
    public function addRole(\Wf3\KikaBundle\Entity\Role $roles)
    {
        $this->roles[] = $roles;

        return $this;
    }

    /**
     * Remove roles
     *
     * @param \Wf3\KikaBundle\Entity\Role $roles
     */
    public function removeRole(\Wf3\KikaBundle\Entity\Role $roles)
    {
        $this->roles->removeElement($roles);
    }

    /**
     * Get roles
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getRoles()
    {
        return $this->roles;
    }

    /**
     * Add subscriptions
     *
     * @param \Wf3\KikaBundle\Entity\Subscription $subscriptions
     * @return User
     */
    public function addSubscription(\Wf3\KikaBundle\Entity\Subscription $subscriptions)
    {
        $this->subscriptions[] = $subscriptions;

        return $this;
    }

    /**
     * Remove subscriptions
     *
     * @param \Wf3\KikaBundle\Entity\Subscription $subscriptions
     */
    public function removeSubscription(\Wf3\KikaBundle\Entity\Subscription $subscriptions)
    {
        $this->subscriptions->removeElement($subscriptions);
    }

    /**
     * Get subscriptions
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getSubscriptions()
    {
        return $this->subscriptions;
    }

    /**
     * Add coachTrainings
     *
     * @param \Wf3\KikaBundle\Entity\Training $coachTrainings
     * @return User
     */
    public function addCoachTraining(\Wf3\KikaBundle\Entity\Training $coachTrainings)
    {
        $this->coachTrainings[] = $coachTrainings;

        return $this;
    }

    /**
     * Remove coachTrainings
     *
     * @param \Wf3\KikaBundle\Entity\Training $coachTrainings
     */
    public function removeCoachTraining(\Wf3\KikaBundle\Entity\Training $coachTrainings)
    {
        $this->coachTrainings->removeElement($coachTrainings);
    }

    /**
     * Get coachTrainings
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getCoachTrainings()
    {
        return $this->coachTrainings;
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
