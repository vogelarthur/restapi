<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Flight
 *
 * @ORM\Table(name="flight")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\FlightRepository")
 */
class Flight
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
     * @ORM\Column(name="departAirportId", type="string", length=20)
     */
    private $departAirportId;

    /**
     * @var int
     *
     * @ORM\Column(name="arriveAirportId", type="string", length=20)
     */
    private $arriveAirportId;

    /**
     * @var string
     *
     * @ORM\Column(name="depart_time", type="string", length=20)
     */
    private $departTime;

    /**
     * @var string
     *
     * @ORM\Column(name="arrive_time", type="string", length=20)
     */
    private $arriveTime;

    /**
     * @var int
     *
     * @ORM\Column(name="status", type="integer")
     */
    private $status;

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
     * Set departAirportId
     *
     * @param integer $departAirportId
     *
     * @return Flight
     */
    public function setDepartAirportId($departAirportId)
    {
        $this->departAirportId = $departAirportId;

        return $this;
    }

    /**
     * Get departAirportId
     *
     * @return int
     */
    public function getDepartAirportId()
    {
        return $this->departAirportId;
    }

    /**
     * Set arriveAirportId
     *
     * @param integer $arriveAirportId
     *
     * @return Flight
     */
    public function setArriveAirportId($arriveAirportId)
    {
        $this->arriveAirportId = $arriveAirportId;

        return $this;
    }

    /**
     * Get arriveAirportId
     *
     * @return int
     */
    public function getArriveAirportId()
    {
        return $this->arriveAirportId;
    }

    /**
     * Set departTime
     *
     * @param string $departTime
     *
     * @return Flight
     */
    public function setDepartTime($departTime)
    {
        $this->departTime = $departTime;

        return $this;
    }

    /**
     * Get departTime
     *
     * @return string
     */
    public function getDepartTime()
    {
        return $this->departTime;
    }

    /**
     * Set arriveTime
     *
     * @param string $arriveTime
     *
     * @return Flight
     */
    public function setArriveTime($arriveTime)
    {
        $this->arriveTime = $arriveTime;

        return $this;
    }

    /**
     * Get arriveTime
     *
     * @return string
     */
    public function getArriveTime()
    {
        return $this->arriveTime;
    }

    /**
     * Set status
     *
     * @param integer $status
     *
     * @return Flight
     */
    public function setStatus($status)
    {
        $this->status = $status;

        return $this;
    }

    /**
     * Get status
     *
     * @return int
     */
    public function getStatus()
    {
        return $this->status;
    }
}

