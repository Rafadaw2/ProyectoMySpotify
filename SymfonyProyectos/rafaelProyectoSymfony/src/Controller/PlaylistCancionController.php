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
        
        $genero=new Estilo();
        $genero->setNombre('Tecno');
        $genero->setDescripcion('genero tecno');
        $cancion->setGenero($genero);
        
        $cancion->setReproducciones(2);
        $cancion->setLikes(5);

        $playlist=new Playlist();
        $playlist->setNombre('Mi musica tecno');
        $playlist->setVisibilidad('privada');

        $usuario=new Usuario();
        $usuario->setEmail('usuario1@gmail.com');
        $usuario->setPassword('12345678');
        $usuario->setNombre('usuario1');
        $usuario->setFechaNacimiento(new \DateTime('1993-05-08'));

        $perfil=new Perfil();
        $perfil->setFoto('fotoperfil');
        $perfil->setDescripcion('descripcion perfil');
        $perfil->setEstiloMusicaPreferido($genero);

        $usuario->setPerfil($perfil);

        $playlist->setPropietario($usuario);
        $playlist->setReproducciones(5);
        $playlist->setLikes(3);
        
        $lista=new PlaylistCancion();
        
        $lista->setPlaylist($playlist);
        $lista->setCancion($cancion);

        $entityManager->persist($genero);
        $entityManager->persist($cancion);
        $entityManager->persist($perfil);
        $entityManager->persist($usuario);
        $entityManager->persist($playlist);
        $entityManager->persist($lista);

        $entityManager->flush();

        return $this->render('playlist_cancion/index.html.twig', [
            'controller_name' => 'PlaylistCancionController',
        ]);
    }
}
