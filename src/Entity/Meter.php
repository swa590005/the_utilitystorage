<?php

namespace App\Entity;

use App\Repository\MeterRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=MeterRepository::class)
 */
class Meter
{
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
}
