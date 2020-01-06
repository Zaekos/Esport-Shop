<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\TailleVetementRepository")
 */
class TailleVetement
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $libellé;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLibellé(): ?string
    {
        return $this->libellé;
    }

    public function setLibellé(?string $libellé): self
    {
        $this->libellé = $libellé;

        return $this;
    }
}
