<?php

namespace DroidInfotech\DroidBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Device
 *
 * @ORM\Table(name="device")
 * @ORM\Entity(repositoryClass="DroidInfotech\DroidBundle\Repository\DeviceRepository")
 */
class Device
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
     * @ORM\Column(name="deviceId", type="string", length=255)
     */
    private $deviceId;

    /**
     * @var string
     *
     * @ORM\Column(name="devicetoken", type="string", length=255)
     */
    private $devicetoken;

    /**
     * @var string
     *
     * @ORM\Column(name="imei", type="string", length=255)
     */
    private $imei;
     /**
     * @var string
     *
     * @ORM\Column(name="devicetype", type="string", length=255)
     */
    private $devicetype;
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
     * Set deviceId
     *
     * @param string $deviceId
     *
     * @return Device
     */
    public function setDeviceId($deviceId)
    {
        $this->deviceId = $deviceId;

        return $this;
    }

    /**
     * Get deviceId
     *
     * @return string
     */
    public function getDeviceId()
    {
        return $this->deviceId;
    }

    /**
     * Set devicetoken
     *
     * @param string $devicetoken
     *
     * @return Device
     */
    public function setDevicetoken($devicetoken)
    {
        $this->devicetoken = $devicetoken;

        return $this;
    }

    /**
     * Get devicetoken
     *
     * @return string
     */
    public function getDevicetoken()
    {
        return $this->devicetoken;
    }

    /**
     * Set imei
     *
     * @param string $imei
     *
     * @return Device
     */
    public function setImei($imei)
    {
        $this->imei = $imei;

        return $this;
    }

    /**
     * Get imei
     *
     * @return string
     */
    public function getImei()
    {
        return $this->imei;
    }
     /**
     * Set devicetype
     *
     * @param string $devicetype
     *
     * @return Device
     */
    public function setDevicetype($devicetype)
    {
        $this->devicetype = $devicetype;

        return $this;
    }

    /**
     * Get devicetype
     *
     * @return string
     */
    public function getDevicetype()
    {
        return $this->devicetype;
    }
    /**
     * Set active
     *
     * @param boolean $active
     *
     * @return Device
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
     * @return Device
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
