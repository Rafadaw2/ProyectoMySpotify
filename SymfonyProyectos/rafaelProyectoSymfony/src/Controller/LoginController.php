<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;
use DateTime;
use Psr\Log\LoggerInterface;


final class LoginController extends AbstractController
{
    #[Route('/login', name: 'app_login')]
    public function index(AuthenticationUtils $authenticationUtils, LoggerInterface $tracabilityLogger): Response
    {
        // get the login error if there is one
        $error = $authenticationUtils->getLastAuthenticationError();

        // last username entered by the user
        $lastUsername = $authenticationUtils->getLastUsername();

               //traza
        /*$usuario = $this->getUser();  
        $marcaTemporal=new DateTime();
        $marcaTemporal=$marcaTemporal->format('Y-m-d H:i:s');
        
        $tracabilityLogger->info('Logeado ', [
            'usuario' => $usuario->getNombre(),
            'fecha'=> $marcaTemporal,
        ]);*/
        
        return $this->render('login/index.html.twig', [
            'last_username' => $lastUsername,
            'error' => $error,
        ]);
    }
}
