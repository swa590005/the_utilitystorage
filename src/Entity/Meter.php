<?php

namespace App\Entity;

use App\Repository\MeterRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Timestampable\Traits\TimestampableEntity;

/**
 * @ORM\Entity(repositoryClass=MeterRepository::class)
 */
class Meter
{
    use TimestampableEntity;
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=15)
     */
    private $meterNumber;

    /**
     * @ORM\Column(type="boolean")
     */
    private $isDeleted = false;

    /**
     * @ORM\OneToMany(targetEntity=MeterReading::class, mappedBy="meter")
     */
    private $meterReadings;

    public function __construct()
    {
        $this->meterReadings = new ArrayCollection();
    }



    public function getId(): ?int
    {
        return $this->id;
    }

    public function getMeterNumber(): ?string
    {
        return $this->meterNumber;
    }

    public function setMeterNumber(string $meterNumber): self
    {
        $this->meterNumber = $meterNumber;

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

    /**
     * @return Collection|MeterReading[]
     */
    public function getMeterReadings(): Collection
    {
        return $this->meterReadings;
    }

    public function addMeterReading(MeterReading $meterReading): self
    {
        if (!$this->meterReadings->contains($meterReading)) {
            $this->meterReadings[] = $meterReading;
            $meterReading->setMeter($this);
        }

        return $this;
    }

    public function removeMeterReading(MeterReading $meterReading): self
    {
        if ($this->meterReadings->removeElement($meterReading)) {
            // set the owning side to null (unless already changed)
            if ($meterReading->getMeter() === $this) {
                $meterReading->setMeter(null);
            }
        }

        return $this;
    }
    public function __toString(): string
    {
        return $this->getMeterNumber();
    }

}
