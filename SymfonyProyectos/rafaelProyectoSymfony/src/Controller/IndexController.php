<?php

namespace App\Controller;
use App\Entity\Cancion;
use App\Entity\Playlist;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use App\Repository\CancionRepository;
use App\Repository\PlaylistRepository;
use Doctrine\ORM\EntityManager;

final class IndexController extends AbstractController
{
    #[Route('/index', name: 'app_index')]
    public function index(PlaylistRepository $playlistRepository,CancionRepository $cancionRepository): Response
    {
        $playlist=$playlistRepository->getPlaylistMasEscuchadas();
        $canciones= $cancionRepository->getCancionesMasEscuchadas();
        return $this->render('index/index.html.twig', [
            'titulo' => 'Bienvenido a MySpotify',
            'canciones' => $canciones,
            'playlists' => $playlist,
        ]);
    }
}
