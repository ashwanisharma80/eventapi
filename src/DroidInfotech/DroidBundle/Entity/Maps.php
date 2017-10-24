<?php

namespace DroidInfotech\DroidBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Maps
 *
 * @ORM\Table(name="maps")
 * @ORM\Entity(repositoryClass="DroidInfotech\DroidBundle\Repository\MapsRepository")
 */
class Maps
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
     * @ORM\ManyToOne(targetEntity="Events", inversedBy="eventmapId")
     */
    private $eventId;
    /**
     * @var string
     *
     * @ORM\Column(name="title", type="string", length=255)
     */
    private $title;
     /**
     * @var string
     *
     * @ORM\Column(name="logo", type="string", length=255,nullable=true)
     */
    private $logo;
    /**
     * @var string
     *
     * @ORM\Column(name="pdfimage", type="string", length=255,nullable=true)
     */
    private $pdfimage;

    /**
     * @var bool
     *
     * @ORM\Column(name="active", type="boolean")
     */
    private $active;

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
     * Set title
     *
     * @param string $title
     *
     * @return Maps
     */
    public function setTitle($title)
    {
        $this->title = $title;

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
     * Set logo
     *
     * @param string $logo
     *
     * @return Maps
     */
    public function setLogo($logo)
    {
        $this->logo = $logo;

        return $this;
    }

    /**
     * Get logo
     *
     * @return string
     */
    public function getLogo()
    {
        return $this->logo;
    }
    /**
     * Set pdfimage
     *
     * @param string $pdfimage
     *
     * @return Maps
     */
    public function setPdfimage($pdfimage)
    {
        $this->pdfimage = $pdfimage;

        return $this;
    }

    /**
     * Get pdfimage
     *
     * @return string
     */
    public function getPdfimage()
    {
        return $this->pdfimage;
    }

    /**
     * Set active
     *
     * @param boolean $active
     *
     * @return Maps
     */
    public function setActive($active)
    {
        $this->active = $active;

        return $this;
    }

    /**
     * Get active
     *
     * @return bool
     */
    public function getActive()
    {
        return $this->active;
    }

    /**
     * Set createdOn
     *
     * @param \DateTime $createdOn
     *
     * @return Maps
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
     * @param integer $eventId
     *
     * @return Maps
     */
    public function setEventId($eventId)
    {
        $this->eventId = $eventId;

        return $this;
    }

    /**
     * Get eventId
     *
     * @return integer
     */
    public function getEventId()
    {
        return $this->eventId;
    }
}
