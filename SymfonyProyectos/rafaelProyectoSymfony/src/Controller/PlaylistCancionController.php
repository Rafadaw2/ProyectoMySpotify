<?php

namespace App\Controller;
use App\Entity\Playlist;
use App\Entity\Cancion;
use App\Entity\Estilo;
use App\Entity\Perfil;
use App\Entity\PlaylistCancion;
use App\Entity\Usuario;
use DateTime;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class PlaylistCancionController extends AbstractController
{
    #[Route('/playlistCancion', name: 'app_playlist_cancion')]
    public function index(): Response
    {
        return $this->render('playlist_cancion/index.html.twig', [
            'controller_name' => 'PlaylistCancionController',
        ]);
    }
    #[Route('/playlistCancion/new', name: 'new_playlistCancion')]
    public function new(EntityManagerInterface $entityManager): Response
    {
        $cancion=new Cancion();
        $cancion->setTitulo('cancion2');
        $cancion->setDuracion(140);
        $cancion->setAlbum('album2');
        $cancion->setAutor('autor2');
        $cancion->setReproducciones(2);
        $cancion->setLikes(5);

        $playlist=new Playlist();
        $playlist->setNombre('Mi musica tecno');
        $playlist->setVisibilidad('privada');
        $playlist->setReproducciones(5);
        $playlist->setLikes(3);
        
        $lista=new PlaylistCancion();
        
        $lista->setPlaylist($playlist);
        $lista->setCancion($cancion);
        $lista->setRepdroducciones(5);

        $entityManager->persist($cancion);
        $entityManager->persist($playlist);
        $entityManager->persist($lista);

        $entityManager->flush();

        return $this->render('playlist_cancion/index.html.twig', [
            'controller_name' => 'PlaylistCancionController',
        ]);
    }
}
