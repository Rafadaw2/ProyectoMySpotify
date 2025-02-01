<?php

namespace App\Controller;
use App\Entity\Estilo;
use App\Entity\Perfil;
use App\Entity\Usuario;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class UsuarioController extends AbstractController
{
    #[Route('/usuario', name: 'app_usuario')]
    public function index(): Response
    {
        return $this->render('usuario/index.html.twig', [
            'controller_name' => 'UsuarioController',
        ]);
    }
    #[Route('/usuario/new', name: 'new_usuario')]
    public function new(EntityManagerInterface $entityManager): Response
    {
        $usuario=new Usuario();
        $usuario->setEmail('usuario3@gmail.com');
        $usuario->setPassword('1234345678');
        $usuario->setNombre('usuario3');
        $usuario->setFechaNacimiento(new \DateTime('1993-06-08'));

        $entityManager->persist($usuario);

        $entityManager->flush();
        
        return $this->render('usuario/index.html.twig', [
            'controller_name' => 'UsuarioController',
        ]);
    }
}
