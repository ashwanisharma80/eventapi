<?php

namespace DroidInfotech\DroidBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Core\Encoder\EncoderAwareInterface;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * User
 *
 * @ORM\Table(name="user")
 * @ORM\Entity(repositoryClass="DroidInfotech\DroidBundle\Repository\UserRepository")
 */
class User implements UserInterface, EncoderAwareInterface {

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
     * @ORM\Column(name="name", type="string", length=255, nullable=true)
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="lname", type="string", length=255, nullable=true)
     */
    private $lname;

    /**
     * @var string
     *
     * @ORM\Column(name="username", type="string", length=255, nullable=true)
     */
    private $username;

    /**
     * @var string
     *
     * @ORM\Column(name="email", type="string", length=255, nullable=true)
     */
    private $email;
    /**
     * @var string
     *
     * @ORM\Column(name="mobile", type="string", length=255, nullable=true)
     */
    private $mobile;

    /**
     * @var string
     *
     * @ORM\Column(name="password", type="string", length=255)
     */
    private $password;

    /**
     * @var string
     *
     * @ORM\Column(name="roles", type="json_array")
     */
    private $roles = [];

    /**
     * @var string
     *
     * @ORM\Column(name="facebook_id", type="string", length=255, nullable=true)
     */
    private $facebookId;

    /**
     * @var string
     *
     * @ORM\Column(name="facebook_token", type="string", length=255, nullable=true)
     */
    private $facebookToken;

    /**
     * @var string
     *
     * @ORM\Column(name="access_code", type="string", length=255, nullable=true)
     */
    private $accessCode;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="createdOn", type="datetime")
     */
    private $createdOn;

    /**
     * Get id
     *
     * @return int
     */
    public function getId() {
        return $this->id;
    }

    /**
     * Set name
     *
     * @param string $name
     *
     * @return User
     */
    public function setName($name) {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName() {
        return $this->name;
    }

    
    
    /**
     * Set mobile
     *
     * @param string $mobile
     *
     * @return User
     */
    public function setMobile($mobile) {
        $this->mobile = $mobile;

        return $this;
    }

    /**
     * Get mobile
     *
     * @return string
     */
    public function getMobile() {
        return $this->mobile;
    }

    /**
     * Set username
     *
     * @param string $username
     *
     * @return User
     */
    public function setUsername($username) {
        $this->username = $username;

        return $this;
    }

    /**
     * Get username
     *
     * @return string
     */
    public function getUsername() {
        return $this->username;
    }

    /**
     * Set email
     *
     * @param string $email
     *
     * @return User
     */
    public function setEmail($email) {
        $this->email = $email;

        return $this;
    }

    /**
     * Get email
     *
     * @return string
     */
    public function getEmail() {
        return $this->email;
    }

    /**
     * Set accessCode
     *
     * @param string $accesscode
     *
     * @return User
     */
    public function setaccessCode($accesscode) {
        $this->accessCode = $accesscode;

        return $this;
    }

    /**
     * Get accessCode
     *
     * @return string
     */
    public function getaccessCode() {
        return $this->accessCode;
    }

    /**
     * Set password
     *
     * @param string $password
     *
     * @return User
     */
    public function setPassword($password) {
        $this->password = $password;

        return $this;
    }

    /**
     * Get password
     *
     * @return string
     */
    public function getPassword() {
        return $this->password;
    }

    /**
     * Set facebook_id
     *
     * @param string $facebook_id
     *
     * @return User
     */
    public function setFacebookId($facebook_id) {
        $this->facebookId = $facebook_id;

        return $this;
    }

    /**
     * Get facebook_id
     *
     * @return string
     */
    public function getFacebookId() {
        return $this->facebookId;
    }

    /**
     * Set facebook_token
     *
     * @param string $facebook_token
     *
     * @return User
     */
    public function setFacebookToken($facebook_token) {
        $this->facebookToken = $facebook_token;

        return $this;
    }

    /**
     * Get facebook_token
     *
     * @return string
     */
    public function getFacebookToken() {
        return $this->facebookToken;
    }

    /**
     * Set roles
     *
     * @param string $roles
     *
     * @return User
     */
    public function setRoles(array $roles) {
        $this->roles = $roles;
    }

    /**
     * Get roles
     *
     * @return string
     */
    public function getRoles() {
        $roles = $this->roles;
        return $roles;
    }

    /**
     * Set createdOn
     *
     * @param string $createdOn
     *
     * @return User
     */
    public function setCreatedOn($createdOn) {
        $this->createdOn = $createdOn;

        return $this;
    }

    /**
     * Get createdOn
     *
     * @return string
     */
    public function getCreatedOn() {
        return $this->createdOn;
    }

    public function getSalt() {
        
    }

    public function eraseCredentials() {
        
    }

    public function getEncoderName() {
        
    }

    public function isGranted($role) {
        return in_array($role, $this->getRoles());
    }

    /**
     * Constructor
     */
    public function __construct() {
        $this->userids = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Get userids
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getUserids() {
        return $this->userids;
    }

    public function __toString() {
        return $this->username;
    }


    /**
     * Set lname
     *
     * @param string $lname
     *
     * @return User
     */
    public function setLname($lname)
    {
        $this->lname = $lname;

        return $this;
    }

    /**
     * Get lname
     *
     * @return string
     */
    public function getLname()
    {
        return $this->lname;
    }
}
