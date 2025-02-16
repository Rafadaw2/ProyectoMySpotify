<?php

namespace App\Controller;
use App\Entity\Estilo;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class EstiloController extends AbstractController
{
    // #[Route('/estilo', name: 'app_estilo')]
    // public function index(): Response
    // {
    //     return $this->render('estilo/index.html.twig', [
    //         'controller_name' => 'EstiloController',
    //     ]);
    // }
    // #[Route('/estilo/new', name: 'new_estilo')]
    // public function new(EntityManagerInterface $entiManager): Response
    // {
    //     $estilo=new Estilo();
    //     $estilo->setNombre('Rock');
    //     $estilo->setDescripcion('genero rock');

    //     $entiManager->persist($estilo);
    //     $entiManager->flush();

    //     return $this->render('estilo/index.html.twig', [
    //         'controller_name' => 'EstiloController',
    //     ]);
    // }
}
