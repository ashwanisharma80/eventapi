<?php

namespace DroidInfotech\DroidBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * EventSchedule
 *
 * @ORM\Table(name="event_schedule")
 * @ORM\Entity(repositoryClass="DroidInfotech\DroidBundle\Repository\EventScheduleRepository")
 */
class EventSchedule {

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
     * @ORM\ManyToOne(targetEntity="Events", inversedBy="eventscheduleId")
     **/
    private $eventId;

    /**
     * @var string
     *
     * @ORM\Column(name="schedule_day_time", type="datetime")
     */
    private $scheduleDayTime;

    /**
     * @var string
     *
     * @ORM\Column(name="schedule_end_time", type="datetime")
     */
    private $scheduleEndTime;

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
     * Set scheduleDayTime
     *
     * @param \DateTime $scheduleDayTime
     *
     * @return EventSchedule
     */
    public function setScheduleDayTime($scheduleDayTime)
    {
        $this->scheduleDayTime = $scheduleDayTime;

        return $this;
    }

    /**
     * Get scheduleDayTime
     *
     * @return \DateTime
     */
    public function getScheduleDayTime()
    {
        return $this->scheduleDayTime;
    }

    /**
     * Set scheduleEndTime
     *
     * @param \DateTime $scheduleEndTime
     *
     * @return EventSchedule
     */
    public function setScheduleEndTime($scheduleEndTime)
    {
        $this->scheduleEndTime = $scheduleEndTime;

        return $this;
    }

    /**
     * Get scheduleEndTime
     *
     * @return \DateTime
     */
    public function getScheduleEndTime()
    {
        return $this->scheduleEndTime;
    }

    /**
     * Set createdOn
     *
     * @param \DateTime $createdOn
     *
     * @return EventSchedule
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
     * @return EventSchedule
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
