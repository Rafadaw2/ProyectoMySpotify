<?php

namespace App\Controller;

use App\Entity\Estilo;
use App\Entity\Perfil;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class PerfilController extends AbstractController
{
    #[Route('/perfil', name: 'app_perfil')]
    public function index(): Response
    {
        return $this->render('perfil/index.html.twig', [
            'controller_name' => 'PerfilController',
        ]);
    }
    #[Route('/perfil/new', name: 'new_perfil')]
    public function new(EntityManagerInterface $entityManager): Response
    {
        $perfil=new Perfil();
        $perfil->setFoto('fotoperfil');
        $perfil->setDescripcion('foto de este perfil');

        $entityManager->persist($perfil);
        $entityManager->flush();
        
        return $this->render('perfil/index.html.twig', [
            'controller_name' => 'PerfilController',
        ]);
    }
    
}
