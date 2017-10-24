<?php

namespace DroidInfotech\DroidBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * EventImages
 *
 * @ORM\Table(name="event_images")
 * @ORM\Entity(repositoryClass="DroidInfotech\DroidBundle\Repository\EventImagesRepository")
 */
class EventImages
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
     * @ORM\Column(name="photo", type="string", length=255)
     */
    private $photo;

     /**
     * @var int
     * @ORM\ManyToOne(targetEntity="Events", inversedBy="eventimageId")
     */
    private $eventId;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="createdOn", type="datetime")
     */
    private $createdOn;



    

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
     * Set photo
     *
     * @param string $photo
     *
     * @return EventImages
     */
    public function setPhoto($photo)
    {
        $this->photo = $photo;

        return $this;
    }

    /**
     * Get photo
     *
     * @return string
     */
    public function getPhoto()
    {
        return $this->photo;
    }

    /**
     * Set createdOn
     *
     * @param \DateTime $createdOn
     *
     * @return EventImages
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

    /**
     * Set eventId
     *
     * @param \DroidInfotech\DroidBundle\Entity\Events $eventId
     *
     * @return EventImages
     */
    public function setEventId(\DroidInfotech\DroidBundle\Entity\Events $eventId = null)
    {
        $this->eventId = $eventId;

        return $this;
    }

    /**
     * Get eventId
     *
     * @return \DroidInfotech\DroidBundle\Entity\Events
     */
    public function getEventId()
    {
        return $this->eventId;
    }
}
