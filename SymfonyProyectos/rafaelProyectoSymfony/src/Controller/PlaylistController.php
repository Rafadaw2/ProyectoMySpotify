<?php

namespace App\Controller;

use App\Entity\Playlist;
use App\Entity\Usuario;
use App\Entity\Perfil;
use App\Entity\Estilo;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class PlaylistController extends AbstractController
{
    #[Route('/playlist', name: 'app_playlist')]
    public function index(): Response
    {
        return $this->render('playlist/index.html.twig', [
            'controller_name' => 'PlaylistController',
        ]);
    }
    #[Route('/playlist/new', name: 'new_playlist')]
    public function new(EntityManagerInterface $entityManager): Response
    {
        $playlist=new Playlist();
        $playlist->setNombre('Tops verano');
        $playlist->setVisibilidad('privada');

        $usuario=new Usuario();
        $usuario->setEmail('usuario2@gmail.com');
        $usuario->setPassword('1234345678');
        $usuario->setNombre('usuario2');
        $usuario->setFechaNacimiento(new \DateTime('1993-06-08'));

        $genero=new Estilo();
        $genero->setNombre('Clasica');
        $genero->setDescripcion('genero clasica');
        
        $perfil=new Perfil();
        $perfil->setFoto('foto perfil user2');
        $perfil->setDescripcion('descripcion perfil user2');
        $perfil->setEstiloMusicaPreferido($genero);

        $usuario->setPerfil($perfil);

        $playlist->setPropietario($usuario);
        $playlist->setReproducciones(3);
        $playlist->setLikes(2);

        $entityManager->persist($genero);
        $entityManager->persist($perfil);
        $entityManager->persist($usuario);
        $entityManager->persist($playlist);

        $entityManager->flush();

        return $this->render('playlist/index.html.twig', [
            'controller_name' => 'PlaylistController',
        ]);
    }
}
