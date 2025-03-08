<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

final class ErrorHandlerController extends AbstractController
{
    public function handler(\Throwable $exception)
    {

        return $this->render('error_handler/index.html.twig', [
            'message' => $exception->getMessage()
        ]);
    }
}
