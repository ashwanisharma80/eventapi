<?php

namespace DroidInfotech\DroidBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * UserFavourite
 *
 * @ORM\Table(name="user_favourite")
 * @ORM\Entity(repositoryClass="DroidInfotech\DroidBundle\Repository\UserFavouriteRepository")
 */
class UserFavourite
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
     * @var int
     *
     * @ORM\Column(name="user_id", type="integer")
     */
    private $userId;

    /**
     * @var int
     *
     * @ORM\Column(name="exhibitor_id", type="integer")
     */
    private $exhibitorId;

    /**
     * @var bool
     *
     * @ORM\Column(name="favourite", type="boolean")
     */
    private $favourite;

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
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set userId
     *
     * @param integer $userId
     *
     * @return UserFavourite
     */
    public function setUserId($userId)
    {
        $this->userId = $userId;

        return $this;
    }

    /**
     * Get userId
     *
     * @return int
     */
    public function getUserId()
    {
        return $this->userId;
    }

    /**
     * Set exhibitorId
     *
     * @param integer $exhibitorId
     *
     * @return UserFavourite
     */
    public function setExhibitorId($exhibitorId)
    {
        $this->exhibitorId = $exhibitorId;

        return $this;
    }

    /**
     * Get exhibitorId
     *
     * @return int
     */
    public function getExhibitorId()
    {
        return $this->exhibitorId;
    }

    /**
     * Set favourite
     *
     * @param boolean $favourite
     *
     * @return UserFavourite
     */
    public function setFavourite($favourite)
    {
        $this->favourite = $favourite;

        return $this;
    }

    /**
     * Get favourite
     *
     * @return bool
     */
    public function getFavourite()
    {
        return $this->favourite;
    }

    /**
     * Set createdOn
     *
     * @param \DateTime $createdOn
     *
     * @return UserFavourite
     */
    public function setCreatedOn($createdOn)
    {
        $this->createdOn = $createdOn;

        return $this;
    }

    /**
     * Get createdOn
     *
     * @return \DateTime
     */
    public function getCreatedOn()
    {
        return $this->createdOn;
    }
}
