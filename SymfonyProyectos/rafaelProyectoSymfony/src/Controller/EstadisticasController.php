<?php

namespace App\Controller;

use App\Entity\Cancion;
use App\Entity\Playlist;
use App\Entity\Usuario;
use App\Repository\CancionRepository;
use App\Repository\PlaylistRepository;
use App\Repository\UsuarioRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Validator\Constraints\DateTime;

final class EstadisticasController extends AbstractController
{
    #[Route('/manager/estadisticas', name: 'app_estadisticas')]
    public function getIndex(): Response
    {
        return $this->render('estadisticas/index.html.twig', [
            'titulo' => 'Bienvenido al dashboard Manager',
        ]);
    }
    #[Route('/manager/estadisticas/Playlist', name: 'app_Playlist')]
    public function getStatsPlaylist(EntityManagerInterface $entityManager): Response
    {
        $playlistsRepository = $entityManager->getRepository(Playlist::class);
        $playlists = $playlistsRepository->findAll();
        $datos = [];
        foreach ($playlists as $playlist) {
            $datos[] = [
                'nombre' => $playlist->getNombre(),
                'reproducciones' => $playlist->getReproducciones(),
                'likes' => $playlist->getLikes()
            ];
        }
        return $this->json($datos);
    }
    #[Route('/manager/estadisticas/Edad', name: 'app_statsEdad')]
    public function getStatsEdadPLaylist(EntityManagerInterface $entityManager): Response
    {
        $usuarioRepository = $entityManager->getRepository(Usuario::class);
        $usuarios = $usuarioRepository->findAll();

        $tramosEdad  = [
            'menos_de_20' => 0,
            'de_20_a_30' => 0,
            'de_40_en_adelante' => 0
        ];

        foreach ($usuarios as $usuario) {
            $fechaNacimiento = $usuario->getFechaNacimiento();  

            $hoy = new \DateTime(); 
            $edad = $hoy->diff($fechaNacimiento)->y;

            if ($edad < 20) {
                $tramosEdad ['menos_de_20']++;
            } elseif ($edad >= 20 && $edad <= 30) {
                $tramosEdad ['de_20_a_30']++;
            } elseif ($edad >= 40) {
                $tramosEdad ['de_40_en_adelante']++;
            }
        }
        $datos = [
            ['tramo' => 'Menos de 20', 'usuarios' => $tramosEdad['menos_de_20']],
            ['tramo' => 'De 20 a 30', 'usuarios' => $tramosEdad['de_20_a_30']],
            ['tramo' => 'De 40 en adelante', 'usuarios' => $tramosEdad['de_40_en_adelante']],
        ];

        return $this->json($datos);
    }
    #[Route('/manager/estadisticas/Canciones', name: 'app_statsCanciones')]
    public function getStatsCanciones(EntityManagerInterface $entityManager): Response
    {
        $cancionsRepository = $entityManager->getRepository(Cancion::class);
        $cancions = $cancionsRepository->findAll();
        $datos = [];
        foreach ($cancions as $cancion) {
            $datos[] = [
                'nombre' => $cancion->getTitulo(),
                'reproducciones' => $cancion->getReproducciones(),
            ];
        }
        return $this->json($datos);
    }
    #[Route('/manager/estadisticas/Estilos', name: 'app_statsEstilos')]
    public function getStatsEstilos(CancionRepository $cancion): Response
    {
        $datos = $cancion->getReprosPorEstilo();

        return $this->json($datos);
    }
}
