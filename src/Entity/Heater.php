<?php

namespace App\Entity;

use App\Repository\HeaterRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Timestampable\Traits\TimestampableEntity;

/**
 * @ORM\Entity(repositoryClass=HeaterRepository::class)
 */
class Heater
{
    use TimestampableEntity;
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=20)
     */
    private $heaterNumber;

    /**
     * @ORM\Column(type="boolean")
     */
    private $isDeleted=false;

    /**
     * @ORM\ManyToOne(targetEntity=Room::class, inversedBy="heaters")
     * @ORM\JoinColumn(nullable=false)
     */
    private $room;

    /**
     * @ORM\OneToMany(targetEntity=YearHeaterReading::class, mappedBy="heater")
     */
    private $yearHeaterReadings;

    public function __construct()
    {
        $this->yearHeaterReadings = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getHeaterNumber(): ?string
    {
        return $this->heaterNumber;
    }

    public function setHeaterNumber(string $heaterNumber): self
    {
        $this->heaterNumber = $heaterNumber;

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

    public function getRoom(): ?Room
    {
        return $this->room;
    }

    public function setRoom(?Room $room): self
    {
        $this->room = $room;

        return $this;
    }

    /**
     * @return Collection|YearHeaterReading[]
     */
    public function getYearHeaterReadings(): Collection
    {
        return $this->yearHeaterReadings;
    }

    public function addYearHeaterReading(YearHeaterReading $yearHeaterReading): self
    {
        if (!$this->yearHeaterReadings->contains($yearHeaterReading)) {
            $this->yearHeaterReadings[] = $yearHeaterReading;
            $yearHeaterReading->setHeater($this);
        }

        return $this;
    }

    public function removeYearHeaterReading(YearHeaterReading $yearHeaterReading): self
    {
        if ($this->yearHeaterReadings->removeElement($yearHeaterReading)) {
            // set the owning side to null (unless already changed)
            if ($yearHeaterReading->getHeater() === $this) {
                $yearHeaterReading->setHeater(null);
            }
        }

        return $this;
    }

    public function __toString(): string
    {
        return $this->getHeaterNumber();
    }

}
