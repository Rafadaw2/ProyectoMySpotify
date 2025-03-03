<?php

namespace App\Entity;

use App\Repository\PerfilRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: PerfilRepository::class)]
class Perfil
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $foto = null;

    #[ORM\Column(length: 255)]
    private ?string $descripcion = null;

    /**
     * @var Collection<int, Estilo>
     */
    #[ORM\ManyToMany(targetEntity: Estilo::class, inversedBy: 'perfils')]
    private Collection $estilosMusicalesPreferidos;

    #[ORM\OneToOne(mappedBy: 'perfil', cascade: ['persist', 'remove'])]
    private ?Usuario $usuario = null;

    public function __construct()
    {
        $this->estilosMusicalesPreferidos = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getFoto(): ?string
    {
        return $this->foto;
    }

    public function setFoto(string $foto): static
    {
        $this->foto = $foto;

        return $this;
    }

    public function getDescripcion(): ?string
    {
        return $this->descripcion;
    }

    public function setDescripcion(string $descripcion): static
    {
        $this->descripcion = $descripcion;

        return $this;
    }

    /**
     * @return Collection<int, Estilo>
     */
    public function getEstilosMusicalesPreferidos(): Collection
    {
        return $this->estilosMusicalesPreferidos;
    }

    public function addEstilosMusicalesPreferido(Estilo $estilosMusicalesPreferido): static
    {
        if (!$this->estilosMusicalesPreferidos->contains($estilosMusicalesPreferido)) {
            $this->estilosMusicalesPreferidos->add($estilosMusicalesPreferido);
        }

        return $this;
    }

    public function removeEstilosMusicalesPreferido(Estilo $estilosMusicalesPreferido): static
    {
        $this->estilosMusicalesPreferidos->removeElement($estilosMusicalesPreferido);

        return $this;
    }

    public function getUsuario(): ?Usuario
    {
        return $this->usuario;
    }

    public function setUsuario(?Usuario $usuario): static
    {
        // unset the owning side of the relation if necessary
        if ($usuario === null && $this->usuario !== null) {
            $this->usuario->setPerfil(null);
        }

        // set the owning side of the relation if necessary
        if ($usuario !== null && $usuario->getPerfil() !== $this) {
            $usuario->setPerfil($this);
        }

        $this->usuario = $usuario;

        return $this;
    }
}
