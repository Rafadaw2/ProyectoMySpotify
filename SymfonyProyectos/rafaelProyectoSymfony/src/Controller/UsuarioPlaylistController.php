<?php

namespace App\Controller;
use App\Entity\Estilo;
use App\Entity\Playlist;
use App\Entity\Perfil;
use App\Entity\Usuario;
use App\Entity\UsuarioPlaylist;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class UsuarioPlaylistController extends AbstractController
{
    #[Route('/usuario/playlist', name: 'app_usuario_playlist')]
    public function index(): Response
    {
        return $this->render('usuario_playlist/index.html.twig', [
            'controller_name' => 'UsuarioPlaylistController',
        ]);
    }
    #[Route('/usuarioPlaylist/new', name: 'new_usuario_playlist')]
    public function new(EntityManagerInterface $entityManager): Response
    {
        $genero=new Estilo();
        $genero->setNombre('Electronica');
        $genero->setDescripcion('genero electronico');

        $playlist=new Playlist();
        $playlist->setNombre('Mi musica electronica');
        $playlist->setVisibilidad('privada');

        $usuario=new Usuario();
        $usuario->setEmail('usuario4@gmail.com');
        $usuario->setPassword('12345678');
        $usuario->setNombre('usuario4');
        $usuario->setFechaNacimiento(new \DateTime('1993-09-08'));

        $perfil=new Perfil();
        $perfil->setFoto('foto perfil usuario4');
        $perfil->setDescripcion('descripcion perfil usuario4');
        $perfil->setEstiloMusicaPreferido($genero);

        $usuario->setPerfil($perfil);

        $playlist->setPropietario($usuario);
        $playlist->setReproducciones(7);
        $playlist->setLikes(8);

        $usuarioPlaylist=new UsuarioPlaylist();
        $usuarioPlaylist->setUsuario($usuario);
        $usuarioPlaylist->setPlaylist($playlist);
        $usuarioPlaylist->setReproducida(5);

        $entityManager->persist($genero);
        $entityManager->persist($perfil);
        $entityManager->persist($usuario);
        $entityManager->persist($playlist);
        $entityManager->persist($usuarioPlaylist);

        $entityManager->flush();

        return $this->render('usuario_playlist/index.html.twig', [
            'controller_name' => 'UsuarioPlaylistController',
        ]);
    }

}
