<?php

namespace DroidInfotech\DroidBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * exhibitor
 *
 * @ORM\Table(name="exhibitor")
 * @ORM\Entity(repositoryClass="DroidInfotech\DroidBundle\Repository\ExhibitorRepository")
 */
class Exhibitor {

    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @ORM\ManyToMany(targetEntity="Events", inversedBy="exhibitorIds",cascade={"remove"}, orphanRemoval=false)
     * @ORM\JoinTable(name="events_exhibitor")
     * */
    protected $eventids;

    /**
     * @var int
     * @ORM\ManyToMany(targetEntity="Category", inversedBy="categoryId",cascade={"remove"}, orphanRemoval=false)
     * @ORM\JoinTable(name="exhibitor_category")
     */
    private $categoryIds;
    
    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255)
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="boothno", type="string", length=255)
     */
    private $boothno;

    /**
     * @var string
     *
     * @ORM\Column(name="location", type="string", length=255)
     */
    private $location;

    /**
     * @var string
     *
     * @ORM\Column(name="logo", type="string", length=255,nullable=true)
     */
    private $logo;

    /**
     * @var string
     *
     * @ORM\Column(name="image", type="string", length=255,nullable=true)
     */
    private $image;

    /**
     * @var string
     *
     * @ORM\Column(name="contact_number", type="string", length=255)
     */
    private $contactNumber;

    /**
     * @var string
     *
     * @ORM\Column(name="email_add", type="string", length=255)
     */
    private $emailAdd;

    /**
     * @var string
     *
     * @ORM\Column(name="url", type="string", length=255,nullable=true)
     */
    private $url;

    /**
     * @var string
     *
     * @ORM\Column(name="product_desc", type="text",nullable=true)
     */
    private $productDesc;

    /**
     * @var bool
     *
     * @ORM\Column(name="event_showcase", type="boolean")
     */
    private $eventShowcase;

    /**
     * @var string
     *
     * @ORM\Column(name="eventshowcase_info", type="text",nullable=true)
     */
    private $eventshowcaseInfo;

    /**
     * @var string
     *
     * @ORM\Column(name="eventshowcaseimage", type="string", length=255,nullable=true)
     */
    private $eventshowcaseimage;

    /**
     * @var string
     *
     * @ORM\Column(name="Facebooklink", type="string", length=255,nullable=true)
     */
    private $Facebooklink;

    /**
     * @var string
     *
     * @ORM\Column(name="Youtubelink", type="string", length=255,nullable=true)
     */
    private $Youtubelink;

    /**
     * @var string
     *
     * @ORM\Column(name="Instagram", type="string", length=255,nullable=true)
     */
    private $Instagram;

    /**
     * @var string
     *
     * @ORM\Column(name="Twiterlink", type="string", length=255,nullable=true)
     */
    private $Twiterlink;

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
     * Constructor
     */
    public function __construct()
    {
        $this->eventids = new \Doctrine\Common\Collections\ArrayCollection();
        $this->categoryIds = new \Doctrine\Common\Collections\ArrayCollection();
    }

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
     *
     * @return Exhibitor
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
     * Set boothno
     *
     * @param string $boothno
     *
     * @return Exhibitor
     */
    public function setBoothno($boothno)
    {
        $this->boothno = $boothno;

        return $this;
    }

    /**
     * Get boothno
     *
     * @return string
     */
    public function getBoothno()
    {
        return $this->boothno;
    }

    /**
     * Set location
     *
     * @param string $location
     *
     * @return Exhibitor
     */
    public function setLocation($location)
    {
        $this->location = $location;

        return $this;
    }

    /**
     * Get location
     *
     * @return string
     */
    public function getLocation()
    {
        return $this->location;
    }

    /**
     * Set logo
     *
     * @param string $logo
     *
     * @return Exhibitor
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
     * Set image
     *
     * @param string $image
     *
     * @return Exhibitor
     */
    public function setImage($image)
    {
        $this->image = $image;

        return $this;
    }

    /**
     * Get image
     *
     * @return string
     */
    public function getImage()
    {
        return $this->image;
    }

    /**
     * Set contactNumber
     *
     * @param string $contactNumber
     *
     * @return Exhibitor
     */
    public function setContactNumber($contactNumber)
    {
        $this->contactNumber = $contactNumber;

        return $this;
    }

    /**
     * Get contactNumber
     *
     * @return string
     */
    public function getContactNumber()
    {
        return $this->contactNumber;
    }

    /**
     * Set emailAdd
     *
     * @param string $emailAdd
     *
     * @return Exhibitor
     */
    public function setEmailAdd($emailAdd)
    {
        $this->emailAdd = $emailAdd;

        return $this;
    }

    /**
     * Get emailAdd
     *
     * @return string
     */
    public function getEmailAdd()
    {
        return $this->emailAdd;
    }

    /**
     * Set url
     *
     * @param string $url
     *
     * @return Exhibitor
     */
    public function setUrl($url)
    {
        $this->url = $url;

        return $this;
    }

    /**
     * Get url
     *
     * @return string
     */
    public function getUrl()
    {
        return $this->url;
    }

    /**
     * Set productDesc
     *
     * @param string $productDesc
     *
     * @return Exhibitor
     */
    public function setProductDesc($productDesc)
    {
        $this->productDesc = $productDesc;

        return $this;
    }

    /**
     * Get productDesc
     *
     * @return string
     */
    public function getProductDesc()
    {
        return $this->productDesc;
    }

    /**
     * Set eventShowcase
     *
     * @param boolean $eventShowcase
     *
     * @return Exhibitor
     */
    public function setEventShowcase($eventShowcase)
    {
        $this->eventShowcase = $eventShowcase;

        return $this;
    }

    /**
     * Get eventShowcase
     *
     * @return boolean
     */
    public function getEventShowcase()
    {
        return $this->eventShowcase;
    }

    /**
     * Set eventshowcaseInfo
     *
     * @param string $eventshowcaseInfo
     *
     * @return Exhibitor
     */
    public function setEventshowcaseInfo($eventshowcaseInfo)
    {
        $this->eventshowcaseInfo = $eventshowcaseInfo;

        return $this;
    }

    /**
     * Get eventshowcaseInfo
     *
     * @return string
     */
    public function getEventshowcaseInfo()
    {
        return $this->eventshowcaseInfo;
    }

    /**
     * Set eventshowcaseimage
     *
     * @param string $eventshowcaseimage
     *
     * @return Exhibitor
     */
    public function setEventshowcaseimage($eventshowcaseimage)
    {
        $this->eventshowcaseimage = $eventshowcaseimage;

        return $this;
    }

    /**
     * Get eventshowcaseimage
     *
     * @return string
     */
    public function getEventshowcaseimage()
    {
        return $this->eventshowcaseimage;
    }

    /**
     * Set facebooklink
     *
     * @param string $facebooklink
     *
     * @return Exhibitor
     */
    public function setFacebooklink($facebooklink)
    {
        $this->Facebooklink = $facebooklink;

        return $this;
    }

    /**
     * Get facebooklink
     *
     * @return string
     */
    public function getFacebooklink()
    {
        return $this->Facebooklink;
    }

    /**
     * Set youtubelink
     *
     * @param string $youtubelink
     *
     * @return Exhibitor
     */
    public function setYoutubelink($youtubelink)
    {
        $this->Youtubelink = $youtubelink;

        return $this;
    }

    /**
     * Get youtubelink
     *
     * @return string
     */
    public function getYoutubelink()
    {
        return $this->Youtubelink;
    }

    /**
     * Set instagram
     *
     * @param string $instagram
     *
     * @return Exhibitor
     */
    public function setInstagram($instagram)
    {
        $this->Instagram = $instagram;

        return $this;
    }

    /**
     * Get instagram
     *
     * @return string
     */
    public function getInstagram()
    {
        return $this->Instagram;
    }

    /**
     * Set twiterlink
     *
     * @param string $twiterlink
     *
     * @return Exhibitor
     */
    public function setTwiterlink($twiterlink)
    {
        $this->Twiterlink = $twiterlink;

        return $this;
    }

    /**
     * Get twiterlink
     *
     * @return string
     */
    public function getTwiterlink()
    {
        return $this->Twiterlink;
    }

    /**
     * Set active
     *
     * @param boolean $active
     *
     * @return Exhibitor
     */
    public function setActive($active)
    {
        $this->active = $active;

        return $this;
    }

    /**
     * Get active
     *
     * @return boolean
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
     * @return Exhibitor
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
     * Add eventid
     *
     * @param \DroidInfotech\DroidBundle\Entity\Events $eventid
     *
     * @return Exhibitor
     */
    public function addEventid(\DroidInfotech\DroidBundle\Entity\Events $eventid)
    {
        $this->eventids[] = $eventid;

        return $this;
    }

    /**
     * Remove eventid
     *
     * @param \DroidInfotech\DroidBundle\Entity\Events $eventid
     */
    public function removeEventid(\DroidInfotech\DroidBundle\Entity\Events $eventid)
    {
        $this->eventids->removeElement($eventid);
    }

    /**
     * Get eventids
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getEventids()
    {
        return $this->eventids;
    }

    /**
     * Add categoryId
     *
     * @param \DroidInfotech\DroidBundle\Entity\Category $categoryId
     *
     * @return Exhibitor
     */
    public function addCategoryId(\DroidInfotech\DroidBundle\Entity\Category $categoryId)
    {
        $this->categoryIds[] = $categoryId;

        return $this;
    }

   

    /**
     * Get categoryIds
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getCategoryIds()
    {
        return $this->categoryIds;
    }

    /**
     * Remove categoryId
     *
     * @param \DroidInfotech\DroidBundle\Entity\Category $categoryId
     */
    public function removeCategoryId(\DroidInfotech\DroidBundle\Entity\Category $categoryId)
    {
        $this->categoryIds->removeElement($categoryId);
    }
}
