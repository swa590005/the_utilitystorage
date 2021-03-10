<?php

namespace App\Entity;

use App\Repository\MeterReadingRepository;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Timestampable\Traits\TimestampableEntity;

/**
 * @ORM\Entity(repositoryClass=MeterReadingRepository::class)
 */
class MeterReading
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
    private $meterReading;

    /**
     * @ORM\Column(type="boolean")
     */
    private $isDeleted=false;

    /**
     * @ORM\ManyToOne(targetEntity=Meter::class, inversedBy="meterReadings")
     * @ORM\JoinColumn(nullable=false)
     */
    private $meter;

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

    public function getMeterReading(): ?int
    {
        return $this->meterReading;
    }

    public function setMeterReading(int $meterReading): self
    {
        $this->meterReading = $meterReading;

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

    public function getMeter(): ?Meter
    {
        return $this->meter;
    }

    public function setMeter(?Meter $meter): self
    {
        $this->meter = $meter;

        return $this;
    }

}
