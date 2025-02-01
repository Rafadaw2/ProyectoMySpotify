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
        $playlist->setReproducciones(3);
        $playlist->setLikes(2);

        $entityManager->persist($playlist);

        $entityManager->flush();

        return $this->render('playlist/index.html.twig', [
            'controller_name' => 'PlaylistController',
        ]);
    }
}
