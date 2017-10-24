<?php

namespace DroidInfotech\DroidBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * Events
 *
 * @ORM\Table(name="events")
 * @ORM\Entity(repositoryClass="DroidInfotech\DroidBundle\Repository\EventsRepository")
 */
class Events {

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
    * @ORM\ManyToMany(targetEntity="Exhibitor", mappedBy="eventids",cascade={"remove"}, orphanRemoval=false)
    */
   private $exhibitorIds;

   /**
    * @ORM\OneToMany(targetEntity="EventSchedule", mappedBy="eventId",cascade={"remove"}, orphanRemoval=false)
    * */
   protected $eventscheduleId;

   /**
    * @ORM\OneToMany(targetEntity="EventImages", mappedBy="eventId",cascade={"remove"}, orphanRemoval=false)
    * */
   protected $eventimageId;

   /**
    * @ORM\OneToMany(targetEntity="Maps", mappedBy="eventId",cascade={"remove"}, orphanRemoval=false)
    * */
   protected $eventmapId;

   /**
    * @ORM\OneToMany(targetEntity="Survey", mappedBy="eventId",cascade={"remove"}, orphanRemoval=false)
    * */
   protected $eventsurveyId;

   /**
    * @var string
    *
    * @ORM\Column(name="title", type="string", length=255)
    */
   private $title;

   /**
    * @var string
    *
    * @ORM\Column(name="description", type="text")
    */
   private $description;

   /**
    * @var string
    *
    * @ORM\Column(name="location", type="string", length=255)
    */
   private $location;

   /**
    * @var string
    *
    * @ORM\Column(name="latitude", type="decimal", precision=10, scale=6)
    */
   private $latitude;

   /**
    * @var string
    *
    * @ORM\Column(name="longitude",  type="decimal", precision=10, scale=6)
    */
   private $longitude;

   /**
    * @var string
    *
    * @ORM\Column(name="address", type="string", length=255)
    */
   private $address;

   /**
    * @var string
    *
    * @ORM\Column(name="website", type="string", length=255)
    */
   private $website;

   /**
    * @var string
    *
    * @ORM\Column(name="faqslink", type="string", length=255)
    */
   private $faqslink;

   /**
    * @var string
    *
    * @ORM\Column(name="schedulelink", type="string", length=255)
    */
   private $schedulelink;

   /**
    * @var string
    *
    * @ORM\Column(name="logo", type="string", length=255,nullable=true)
    */
   private $logo;

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
   public function __construct() {
      $this->exhibitorIds = new \Doctrine\Common\Collections\ArrayCollection();
      $this->eventscheduleId = new \Doctrine\Common\Collections\ArrayCollection();
      $this->eventimageId = new \Doctrine\Common\Collections\ArrayCollection();
   }

   /**
    * Get id
    *
    * @return integer
    */
   public function getId() {
      return $this->id;
   }

   /**
    * Set title
    *
    * @param string $title
    *
    * @return Events
    */
   public function setTitle($title) {
      $this->title = $title;

      return $this;
   }

   /**
    * Get title
    *
    * @return string
    */
   public function getTitle() {
      return $this->title;
   }

   /**
    * Set description
    *
    * @param string $description
    *
    * @return Events
    */
   public function setDescription($description) {
      $this->description = $description;

      return $this;
   }

   /**
    * Get description
    *
    * @return string
    */
   public function getDescription() {
      return $this->description;
   }

   /**
    * Set location
    *
    * @param string $location
    *
    * @return Events
    */
   public function setLocation($location) {
      $this->location = $location;

      return $this;
   }

   /**
    * Get location
    *
    * @return string
    */
   public function getLocation() {
      return $this->location;
   }

   /**
    * Set latitude
    *
    * @param string $latitude
    *
    * @return Events
    */
   public function setLatitude($latitude) {
      $this->latitude = $latitude;

      return $this;
   }

   /**
    * Get latitude
    *
    * @return string
    */
   public function getLatitude() {
      return $this->latitude;
   }

   /**
    * Set longitude
    *
    * @param string $longitude
    *
    * @return Events
    */
   public function setLongitude($longitude) {
      $this->longitude = $longitude;

      return $this;
   }

   /**
    * Get longitude
    *
    * @return string
    */
   public function getLongitude() {
      return $this->longitude;
   }

   /**
    * Set address
    *
    * @param string $address
    *
    * @return Events
    */
   public function setAddress($address) {
      $this->address = $address;

      return $this;
   }

   /**
    * Get address
    *
    * @return string
    */
   public function getAddress() {
      return $this->address;
   }

   /**
    * Set website
    *
    * @param string $website
    *
    * @return Events
    */
   public function setWebsite($website) {
      $this->website = $website;

      return $this;
   }

   /**
    * Get website
    *
    * @return string
    */
   public function getWebsite() {
      return $this->website;
   }

   /**
    * Set faqslink
    *
    * @param string $faqslink
    *
    * @return Events
    */
   public function setFaqslink($faqslink) {
      $this->faqslink = $faqslink;

      return $this;
   }

   /**
    * Get faqslink
    *
    * @return string
    */
   public function getFaqslink() {
      return $this->faqslink;
   }

   /**
    * Set schedulelink
    *
    * @param string $schedulelink
    *
    * @return Events
    */
   public function setSchedulelink($schedulelink) {
      $this->schedulelink = $schedulelink;

      return $this;
   }

   /**
    * Get schedulelink
    *
    * @return string
    */
   public function getSchedulelink() {
      return $this->schedulelink;
   }

   /**
    * Set logo
    *
    * @param string $logo
    *
    * @return Events
    */
   public function setLogo($logo) {
      $this->logo = $logo;

      return $this;
   }

   /**
    * Get logo
    *
    * @return string
    */
   public function getLogo() {
      return $this->logo;
   }

   /**
    * Set active
    *
    * @param boolean $active
    *
    * @return Events
    */
   public function setActive($active) {
      $this->active = $active;

      return $this;
   }

   /**
    * Get active
    *
    * @return boolean
    */
   public function getActive() {
      return $this->active;
   }

   /**
    * Set createdOn
    *
    * @param \DateTime $createdOn
    *
    * @return Events
    */
   public function setCreatedOn($createdOn) {
      $this->createdOn = $createdOn;

      return $this;
   }

   /**
    * Get createdOn
    *
    * @return \DateTime
    */
   public function getCreatedOn() {
      return $this->createdOn;
   }

   /**
    * Add exhibitorId
    *
    * @param \DroidInfotech\DroidBundle\Entity\Exhibitor $exhibitorId
    *
    * @return Events
    */
   public function addExhibitorId(\DroidInfotech\DroidBundle\Entity\Exhibitor $exhibitorId) {
      $this->exhibitorIds[] = $exhibitorId;

      return $this;
   }

   /**
    * Remove exhibitorId
    *
    * @param \DroidInfotech\DroidBundle\Entity\Exhibitor $exhibitorId
    */
   public function removeExhibitorId(\DroidInfotech\DroidBundle\Entity\Exhibitor $exhibitorId) {
      $this->exhibitorIds->removeElement($exhibitorId);
   }

   /**
    * Get exhibitorIds
    *
    * @return \Doctrine\Common\Collections\Collection
    */
   public function getExhibitorIds() {
      return $this->exhibitorIds;
   }

   /**
    * Add eventscheduleId
    *
    * @param \DroidInfotech\DroidBundle\Entity\EventSchedule $eventscheduleId
    *
    * @return Events
    */
   public function addEventscheduleId(\DroidInfotech\DroidBundle\Entity\EventSchedule $eventscheduleId) {
      $this->eventscheduleId[] = $eventscheduleId;

      return $this;
   }

   /**
    * Remove eventscheduleId
    *
    * @param \DroidInfotech\DroidBundle\Entity\EventSchedule $eventscheduleId
    */
   public function removeEventscheduleId(\DroidInfotech\DroidBundle\Entity\EventSchedule $eventscheduleId) {
      $this->eventscheduleId->removeElement($eventscheduleId);
   }

   /**
    * Get eventscheduleId
    *
    * @return \Doctrine\Common\Collections\Collection
    */
   public function getEventscheduleId() {
      return $this->eventscheduleId;
   }

   /**
    * Add eventimageId
    *
    * @param \DroidInfotech\DroidBundle\Entity\EventImages $eventimageId
    *
    * @return Events
    */
   public function addEventimageId(\DroidInfotech\DroidBundle\Entity\EventImages $eventimageId) {
      $this->eventimageId[] = $eventimageId;

      return $this;
   }

   /**
    * Remove eventimageId
    *
    * @param \DroidInfotech\DroidBundle\Entity\EventImages $eventimageId
    */
   public function removeEventimageId(\DroidInfotech\DroidBundle\Entity\EventImages $eventimageId) {
      $this->eventimageId->removeElement($eventimageId);
   }

   /**
    * Get eventimageId
    *
    * @return \Doctrine\Common\Collections\Collection
    */
   public function getEventimageId() {
      return $this->eventimageId;
   }

   /**
    * Add eventmapId
    *
    * @param \DroidInfotech\DroidBundle\Entity\Maps $eventmapId
    *
    * @return Events
    */
   public function addEventmapId(\DroidInfotech\DroidBundle\Entity\Maps $eventmapId) {
      $this->eventmapId[] = $eventmapId;

      return $this;
   }

   /**
    * Remove eventmapId
    *
    * @param \DroidInfotech\DroidBundle\Entity\Maps $eventmapId
    */
   public function removeEventmapId(\DroidInfotech\DroidBundle\Entity\Maps $eventmapId) {
      $this->eventmapId->removeElement($eventmapId);
   }

   /**
    * Get eventmapId
    *
    * @return \Doctrine\Common\Collections\Collection
    */
   public function getEventmapId() {
      return $this->eventmapId;
   }

   /**
    * Add eventsurveyId
    *
    * @param \DroidInfotech\DroidBundle\Entity\Survey $eventsurveyId
    *
    * @return Events
    */
   public function addEventsurveyId(\DroidInfotech\DroidBundle\Entity\Survey $eventsurveyId) {
      $this->eventsurveyId[] = $eventsurveyId;

      return $this;
   }

   /**
    * Remove eventsurveyId
    *
    * @param \DroidInfotech\DroidBundle\Entity\Survey $eventsurveyId
    */
   public function removeEventsurveyId(\DroidInfotech\DroidBundle\Entity\Survey $eventsurveyId) {
      $this->eventsurveyId->removeElement($eventsurveyId);
   }

   /**
    * Get eventsurveyId
    *
    * @return \Doctrine\Common\Collections\Collection
    */
   public function getEventsurveyId() {
      return $this->eventsurveyId;
   }

}
