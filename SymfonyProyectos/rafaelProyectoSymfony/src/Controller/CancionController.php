<?php

namespace App\Controller;
use App\Entity\Cancion;
use App\Repository\CancionRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
USE Symfony\Component\HttpFoundation\BinaryFileResponse;
use DateTime;
use Psr\Log\LoggerInterface;


final class CancionController extends AbstractController
{

    #[Route('/cancion', name: 'show_canciones')]
    public function mostrarTodas(CancionRepository $cancionRepository): Response
    {
        $canciones= $cancionRepository->getCanciones();
        return $this->render('cancion/index.html.twig', [
            'titulo' => 'Todo lo que te puedas imaginar',
            'canciones' => $canciones,
        ]);
    }
    // #[Route('/cancion/new', name: 'new_cancion')]
    // public function new(EntityManagerInterface $entityManager): Response
    // {
    //     $cancion=new Cancion();
    //     $cancion->setTitulo('cancion1');
    //     $cancion->setDuracion(120);
    //     $cancion->setAlbum('album1');
    //     $cancion->setAutor('autor1');
  
    //     $cancion->setReproducciones(1);
    //     $cancion->setLikes(1);

    //     $entityManager->persist($cancion);

    //     $entityManager->flush();

    //     return $this->render('cancion/index.html.twig', [
    //         'controller_name' => 'CancionController',
    //     ]);
    // }
    #[Route('/cancion/{songName}/play', name: 'play_music', methods:['GET'])]
    public function playMusic(string $songName, LoggerInterface $tracabilityLogger): Response
    {
        
        $usuario = $this->getUser();
        if($usuario){
            $marcaTemporal=new DateTime();
        $marcaTemporal=$marcaTemporal->format('Y-m-d H:i:s');
        $tracabilityLogger->info('Escucha canción', [
            'usuario' => $usuario->getNombre(),
            'fecha'=> $marcaTemporal,
        ]);
        }
        
        $musicDirectory=$this->getParameter('kernel.project_dir').'/songs/';
        $filePath=$musicDirectory.$songName;
        if(!file_exists($filePath)){
            return new Response('Archivo no encontrado',404);
        }

        return new BinaryFileResponse($filePath);
    }
    
}
