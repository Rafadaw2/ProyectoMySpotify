<?php

namespace App\Controller;
use App\Entity\Cancion;
use App\Entity\Estilo;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class CancionController extends AbstractController
{
    #[Route('/cancion', name: 'app_cancion')]
    public function index(): Response
    {
        return $this->render('cancion/index.html.twig', [
            'controller_name' => 'CancionController',
        ]);
    }
    #[Route('/cancion/new', name: 'new_cancion')]
    public function new(EntityManagerInterface $entityManager): Response
    {
        $cancion=new Cancion();
        $cancion->setTitulo('cancion1');
        $cancion->setDuracion(120);
        $cancion->setAlbum('album1');
        $cancion->setAutor('autor1');
        $genero=new Estilo();
        $genero->setNombre('Pop');
        $genero->setDescripcion('Genero pop');
        $cancion->setGenero($genero);
        $cancion->setReproducciones(1);
        $cancion->setLikes(1);

        $entityManager->persist($genero);
        $entityManager->persist($cancion);

        $entityManager->flush();

        return $this->render('cancion/index.html.twig', [
            'controller_name' => 'CancionController',
        ]);
    }
}
