<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Validator\Constraints as Assert;


/**
 * User
 *
 * @property string salt
 * @ORM\Table(name="user")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\UserRepository")
 */
class User implements UserInterface, \Serializable
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
     * @var string
     *
     * @ORM\Column(name="User_Lastname", type="string", length=35)
     */
    private $userLastname;

    /**
     * @var string
     *
     * @ORM\Column(name="User_Name", type="string", length=35)
     */
    private $userName;

    /**
     * @var string
     *
     * @ORM\Column(name="Email", type="string", length=255, unique=true)
     */
    private $email;

    /**
     * @var string
     *
     * @ORM\Column(name="Phone_Number", type="string", length=20)
     */
    private $phoneNumber;

    /**
     * @var string
     *
     * @ORM\Column(name="Login", type="string", length=35, unique=true)
     */
    private $login;

    /**
     * @Assert\NotBlank()
     * @Assert\Length(max=4096)
     */
    private $plainPassword;

    /**
     *
     * @ORM\Column(type="string", length=64)
     */
    private $password;

    /**
     * @var array
     *
     * @ORM\Column(name="roles", type="array", length=255)
     */
    private $roles;

    /**
     * @ORM\Column(name="is_active", type="boolean")
     */
    private $isActive;
    
    /**
     * @var \DateTime
     *
     * @ORM\Column(name="Account_Creation_Date", type="datetime")
     */
    private $accountCreationDate;
    
    public function __construct()
    {
        $this->roles = array('ROLE_USER');
        $this->isActive = true;
        $this->accountCreationDate = new \DateTime('Now');
    }


    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set userLastname
     *
     * @param string $userLastname
     *
     * @return User
     */
    public function setUserLastname($userLastname)
    {
        $this->userLastname = $userLastname;

        return $this;
    }

    /**
     * Get userLastname
     *
     * @return string
     */
    public function getUserLastname()
    {
        return $this->userLastname;
    }

    /**
     * Set userName
     *
     * @param string $userName
     *
     * @return User
     */
    public function setUserName($userName)
    {
        $this->userName = $userName;

        return $this;
    }

    /**
     * Get userName
     *
     * @return string
     */
    public function getUserName()
    {
        return $this->userName;
    }

    /**
     * Set email
     *
     * @param string $email
     *
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
     * Set phoneNumber
     *
     * @param string $phoneNumber
     *
     * @return User
     */
    public function setPhoneNumber($phoneNumber)
    {
        $this->phoneNumber = $phoneNumber;

        return $this;
    }

    /**
     * Get phoneNumber
     *
     * @return string
     */
    public function getPhoneNumber()
    {
        return $this->phoneNumber;
    }

    /**
     * Set login
     *
     * @param string $login
     *
     * @return User
     */
    public function setLogin($login)
    {
        $this->login = $login;

        return $this;
    }

    /**
     * Get login
     *
     * @return string
     */
    public function getLogin()
    {
        return $this->login;
    }

    /**
     * Set password
     *
     * @param string $password
     *
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
     * Get salt
     *
     * @return string
     */
    public function getSalt()
    {
        return null;
        #salt;
    }

    /**
     * Get roles
     *
     * @return string
     */
    public function getroles()
    {
        return $this->roles;
    }

    /**
     * Set accountCreationDate
     *
     * @param \DateTime $accountCreationDate
     *
     * @return User
     */
    public function setAccountCreationDate($accountCreationDate)
    {
        $this->accountCreationDate = $accountCreationDate;

        return $this;
    }

    /**
     * Get accountCreationDate
     *
     * @return \DateTime
     */
    public function getAccountCreationDate()
    {
        return $this->accountCreationDate;
    }

    public function eraseCredentials()
    {
    }

    /** @see \Serializable::serialize() */
    public function serialize()
    {
        return serialize(array(
            $this->id,
            $this->login,
            $this->password,
        ));
    }

    /** @see \Serializable::unserialize()
     * @param string $serialized
     */
    public function unserialize($serialized)
    {
        list (
            $this->id,
            $this->login,
            $this->password,
            ) = unserialize($serialized);
    }

    /**
     * Set salt
     *
     * @param string $salt
     *
     * @return User
     */
    public function setSalt($salt)
    {
        $this->salt = $salt;

        return $this;
    }

    /**
     * Set roles
     *
     * @param string $roles
     *
     * @return User
     */
    public function setroles($roles)
    {
        $this->roles = $roles;

        return $this;
    }

    /**
     * Set isActive
     *
     * @param boolean $isActive
     *
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

    public function getPlainPassword()
    {
        return $this->plainPassword;
    }

    public function setPlainPassword($password)
    {
        $this->plainPassword = $password;
    }

    /**
     * Set roles
     *
     * @param string $roless
     *
     * @return User
     */
    public function setRoless($roless)
    {
        $this->roles = $roless;

        return $this;
    }

    /**
     * Get roles
     *
     * @return string
     */
    public function getRoless()
    {
        return $this->roles;
    }
}
