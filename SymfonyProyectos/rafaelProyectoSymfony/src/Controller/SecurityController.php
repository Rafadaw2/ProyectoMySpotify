<?php
namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class SecurityController extends AbstractController
{
    #[Route('/acceso-denegado', name: 'acceso_denegado')]
    public function accesoDenegado(): Response
    {
        return $this->render('security/acceso_denegado.html.twig', [
            'mensaje' => 'No tienes permisos para acceder a esta página.',
        ]);
    }
}
