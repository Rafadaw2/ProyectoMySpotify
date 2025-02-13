<?php

namespace App\Entity;

use App\Repository\PlaylistCancionRepository;
use Doctrine\ORM\Mapping as ORM;
#[ORM\Entity(repositoryClass: PlaylistCancionRepository::class)]
class PlaylistCancion
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'playlistCancions')]
    private ?Playlist $playlist = null;

    #[ORM\ManyToOne(inversedBy: 'playlistCancions')]
    private ?Cancion $cancion = null;

    #[ORM\Column(nullable: true)]
    private ?int $repdroducciones = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPlaylist(): ?Playlist
    {
        return $this->playlist;
    }

    public function setPlaylist(?Playlist $playlist): static
    {
        $this->playlist = $playlist;

        return $this;
    }

    public function getCancion(): ?Cancion
    {
        return $this->cancion;
    }

    public function setCancion(?Cancion $cancion): static
    {
        $this->cancion = $cancion;

        return $this;
    }

    public function getRepdroducciones(): ?int
    {
        return $this->repdroducciones;
    }

    public function setRepdroducciones(int $repdroducciones): static
    {
        $this->repdroducciones = $repdroducciones;

        return $this;
    }
    public function __toString(): string
    {
        return $this->getCancion()->getTitulo() ?? 'Sin nombre';
    }

   
}
