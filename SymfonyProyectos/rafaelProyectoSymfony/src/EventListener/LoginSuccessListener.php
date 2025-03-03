<?php

namespace App\EventListener;

use Symfony\Component\Security\Http\Event\LoginSuccessEvent;
use Psr\Log\LoggerInterface;
use Symfony\Component\Security\Http\Event\LogoutEvent;

class LoginSuccessListener
{
    private LoggerInterface $tracabilityLogger;

    public function __construct(LoggerInterface $tracabilityLogger)
    {
        $this->tracabilityLogger = $tracabilityLogger;
    }

    public function registroLogin(LoginSuccessEvent $event): void
    {
        $usuario = $event->getUser();
        $ip = $event->getRequest()->getClientIp();
        $tipoFecha = date('Y-m-d H:i:s');

        $this->tracabilityLogger->info("Inicio sesion de {$usuario->getUserIdentifier()}, ip: {$ip}, fecha: {$tipoFecha}", [
            'username' => $usuario->getUserIdentifier(),
            'ip' => $ip,
            'fecha' => $tipoFecha,
        ]);
    }


    public function registroLogout(LogoutEvent $event): void
    {
        $usuario = $event->getToken()->getUser();
        $ip = $event->getRequest()->getClientIp();
        $tipoFecha = date('Y-m-d H:i:s');

        $this->tracabilityLogger->info("El usuario {$usuario->getUserIdentifier()} ha cerrado sesión desde {$ip} el {$tipoFecha}", [
            'username' => $usuario->getUserIdentifier(),
            'ip' => $ip,
            'fecha' => $tipoFecha,
        ]);
    }
}
