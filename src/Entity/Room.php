<?php

namespace App\Entity;

use App\Repository\RoomRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Timestampable\Traits\TimestampableEntity;

/**
 * @ORM\Entity(repositoryClass=RoomRepository::class)
 */
class Room
{
    use TimestampableEntity;
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $roomName;

    /**
     * @ORM\Column(type="boolean")
     */
    private $isDeleted =false;

    /**
     * @ORM\OneToMany(targetEntity=Heater::class, mappedBy="room")
     */
    private $heaters;

    public function __construct()
    {
        $this->heaters = new ArrayCollection();
    }



    public function getId(): ?int
    {
        return $this->id;
    }

    public function getRoomName(): ?string
    {
        return $this->roomName;
    }

    public function setRoomName(string $roomName): self
    {
        $this->roomName = $roomName;

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
     * @return Collection|Heater[]
     */
    public function getHeaters(): Collection
    {
        return $this->heaters;
    }

    public function addHeater(Heater $heater): self
    {
        if (!$this->heaters->contains($heater)) {
            $this->heaters[] = $heater;
            $heater->setRoom($this);
        }

        return $this;
    }

    public function removeHeater(Heater $heater): self
    {
        if ($this->heaters->removeElement($heater)) {
            // set the owning side to null (unless already changed)
            if ($heater->getRoom() === $this) {
                $heater->setRoom(null);
            }
        }

        return $this;
    }
    public function __toString(): string
    {
        return $this->getRoomName();
    }
}
