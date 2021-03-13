<?php

namespace App\Entity;

use App\Repository\HeaterReadingRepository;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Timestampable\Traits\TimestampableEntity;

/**
 * @ORM\Entity(repositoryClass=HeaterReadingRepository::class)
 */
class HeaterReading
{
    use TimestampableEntity;
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="date")
     */
    private $readingDate;

    /**
     * @ORM\Column(type="integer")
     */
    private $heaterReading;

    /**
     * @ORM\Column(type="boolean")
     */
    private $isDeleted=false;

    /**
     * @ORM\ManyToOne(targetEntity=Heater::class, inversedBy="heaterReadings")
     * @ORM\JoinColumn(nullable=false)
     */
    private $heater;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getReadingDate(): ?\DateTimeInterface
    {
        return $this->readingDate;
    }

    public function setReadingDate(\DateTimeInterface $readingDate): self
    {
        $this->readingDate = $readingDate;

        return $this;
    }

    public function getHeaterReading(): ?int
    {
        return $this->heaterReading;
    }

    public function setHeaterReading(int $heaterReading): self
    {
        $this->heaterReading = $heaterReading;

        return $this;
    }

    public function getIsDeleted(): ?bool
    {
        return $this->isDeleted;
    }

    public function setIsDeleted(bool $isDeleted): self
    {
        $this->isDeleted = $isDeleted;

        return $this;
    }

    public function getHeater(): ?Heater
    {
        return $this->heater;
    }

    public function setHeater(?Heater $heater): self
    {
        $this->heater = $heater;

        return $this;
    }
}
