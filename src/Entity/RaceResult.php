<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\OrderBy;

/**
 * @ORM\Entity(repositoryClass="App\Repository\RaceResultRepository")
 */
class RaceResult
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Race", inversedBy="raceResults")
     * @ORM\JoinColumn(nullable=false)
     */
    private $race;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Athlete", inversedBy="raceResults")
     * @ORM\JoinColumn(nullable=false)
     */
    private $athlete;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Club", inversedBy="raceResults")
     * @ORM\JoinColumn(nullable=false)
     */
    private $club;

    /**
     * @ORM\Column(type="time")
     */
    private $run_1;

    /**
     * @ORM\Column(type="time")
     */
    private $run_2;

    /**
     * @ORM\Column(type="time")
     */
    private $run_average;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getRace(): ?Race
    {
        return $this->race;
    }

    public function setRace(?Race $race): self
    {
        $this->race = $race;

        return $this;
    }

    public function getAthlete(): ?Athlete
    {
        return $this->athlete;
    }

    public function setAthlete(?Athlete $athlete): self
    {
        $this->athlete = $athlete;

        return $this;
    }

    public function getClub(): ?Club
    {
        return $this->club;
    }

    public function setClub(?Club $club): self
    {
        $this->club = $club;

        return $this;
    }

    public function getRun1(): ?\DateTimeInterface
    {
        return $this->run_1;
    }

    public function setRun1(\DateTimeInterface $run_1): self
    {
        $this->run_1 = $run_1;

        return $this;
    }

    public function getRun2(): ?\DateTimeInterface
    {
        return $this->run_2;
    }

    public function setRun2(\DateTimeInterface $run_2): self
    {
        $this->run_2 = $run_2;

        return $this;
    }

    public function getRunAverage(): ?\DateTimeInterface
    {
        return $this->run_average;
    }

    public function setRunAverage(\DateTimeInterface $run_average): self
    {
        $this->run_average = $run_average;

        return $this;
    }
}
