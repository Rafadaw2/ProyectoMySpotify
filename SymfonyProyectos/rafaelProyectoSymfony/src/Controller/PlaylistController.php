<?php

namespace App\Controller;

use App\Entity\Playlist;
use App\Entity\Usuario;
use App\Entity\Perfil;
use App\Entity\Estilo;
use App\Repository\PlaylistRepository;
use Doctrine\ORM\EntityManagerInterface;
use PhpParser\Node\Expr\Cast\String_;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Bundle\MakerBundle\Str;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class PlaylistController extends AbstractController
{

    #[Route('/playlist', name: 'show_playlist')]
    public function mostrarTodas(PlaylistRepository $playlistRepository): Response
    {
        $playlist= $playlistRepository->getPlaylist();
        return $this->render('playlist/index.html.twig', [
            'titulo' => 'Playlist disponibles',
            'playlists' => $playlist,
        ]);
    }

    #[Route('/playlist/cancions/{playlist}', name: 'show_playlist_cancions')]
    public function playlistCancions(Playlist $playlist): Response
    {
        $playlistCancions=$playlist->getPlaylistCancions();
        $cancions=[];
        foreach($playlistCancions as $playlistCancion){
            $cancions[]=$playlistCancion->getCancion();
        }
        $nombre=$playlist->getNombre();
        return $this->render('playlist/cancions/index.html.twig', [
            'nombre'=> $nombre,
            'canciones' => $cancions,
        ]);
    }

    #[Route('/playlist/new', name: 'new_playlist')]
    public function new(EntityManagerInterface $entityManager): Response
    {
        $playlist=new Playlist();
        $playlist->setNombre('Tops verano');
        $playlist->setVisibilidad('privada');
        $playlist->setReproducciones(3);
        $playlist->setLikes(2);

        $entityManager->persist($playlist);

        $entityManager->flush();

        return $this->render('playlist/index.html.twig', [
            'controller_name' => 'PlaylistController',
        ]);
    }
}
