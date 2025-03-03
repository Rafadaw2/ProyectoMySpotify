<?php

namespace App\Controller;
use Symfony\Component\Security\Http\Attribute\IsGranted;

use App\Entity\Playlist;
use App\Entity\Usuario;
use App\Entity\Perfil;
use App\Entity\Estilo;
use App\Entity\Cancion;
use App\Entity\PlaylistCancion;
use App\Repository\PlaylistRepository;
use App\Repository\CancionRepository;
use Doctrine\ORM\EntityManagerInterface;
use PhpParser\Node\Expr\Cast\String_;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Bundle\MakerBundle\Str;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use DateTime;
use Psr\Log\LoggerInterface;

final class PlaylistController extends AbstractController
{
    #[IsGranted('ROLE_USER')]
    #[Route('/user/playlist', name: 'show_playlistUser')]
    public function mostrarTodasUser(PlaylistRepository $playlistRepository): Response
    {

        $usuario = $this->getUser();
        $playlists = $playlistRepository->getPlaylist();
        $playlistUser = [];
        foreach ($playlists as $playlist) {
            if ($playlist->getPropietario() !== null && $playlist->getPropietario()->getId() === $usuario->getId()) {
                $playlistUser[] = $playlist;
            }
        }

        return $this->render('playlist/index.html.twig', [
            'titulo' => 'Tus Playlist',
            'playlists' => $playlistUser,
        ]);
    }
    #[Route('/playlist', name: 'show_playlist')]
    public function mostrarPlaylistSistema(PlaylistRepository $playlistRepository): Response
    {
        $playlists = $playlistRepository->getPlaylist();
        $playlistSistema = [];
        foreach ($playlists as $playlist) {
            if ($playlist->getPropietario() == null) {
                $playlistSistema[] = $playlist;
            }
        }
        return $this->render('playlist/index.html.twig', [
            'titulo' => 'Playlist disponibles',
            'playlists' => $playlistSistema,
        ]);
    }

    #[Route('/playlist/cancions/{playlist}', name: 'show_playlist_cancions')]
    public function playlistCancions(Playlist $playlist): Response
    {
        $playlistCancions = $playlist->getPlaylistCancions();
        $cancions = [];
        foreach ($playlistCancions as $playlistCancion) {
            $cancions[] = $playlistCancion->getCancion();
        }
        $nombre = $playlist->getNombre();
        return $this->render('playlist/cancions/index.html.twig', [
            'nombre' => $nombre,
            'canciones' => $cancions,
        ]);
    }
    #[Route('/playlistSistemCancionsPu/{subcadena}', name: 'app_searchSistemPu')]
    public function searchPublic(PlaylistRepository $playlistRepository, CancionRepository $cancionRepository, string $subcadena): Response
    {
        $playlists = $playlistRepository->getCoincidenciasPlaylist($subcadena);
        $canciones = $cancionRepository->getCoincidenciasCanciones($subcadena);
        $playlistRespuesta = [];
        foreach ($playlists as $playlist) {
            if ($playlist->getPropietario() == null) {
                $playlistRespuesta[] = $playlist;
            }
        }
        return $this->render('index/index.html.twig', [
            'titulo' => 'Resultados',
            'canciones' => $canciones,
            'playlists' => $playlistRespuesta,
        ]);
    }
    #[Route('/user/playlistSistemCancionsPri/{subcadena}', name: 'app_searchSistemPri')]
    public function searchPri(PlaylistRepository $playlistRepository, CancionRepository $cancionRepository, string $subcadena): Response
    {
        $usuario = $this->getUser();
        $playlists = $playlistRepository->getCoincidenciasPlaylist($subcadena);
        $canciones = $cancionRepository->getCoincidenciasCanciones($subcadena);
        $playlistUser = [];
        foreach ($playlists as $playlist) {
            if ($playlist->getPropietario() == null || $playlist->getPropietario() == $usuario) {
                $playlistUser[] = $playlist;
            }
        }
        return $this->render('index/index.html.twig', [
            'titulo' => 'Resultados',
            'canciones' => $canciones,
            'playlists' => $playlistUser,
        ]);
    }
    #[Route('/user/playlist/form', name: 'form_playlist')]
    public function form(CancionRepository $cancionRepository): Response
    {
        
        $canciones= $cancionRepository->getCanciones();
        return $this->render('playlist/form.html.twig', [
            'nombre' => 'Crea tu playlist',
            'canciones' => $canciones,
        ]);
    }

    #[Route('/user/playlist/new', name: 'new_playlist')]
    public function new(EntityManagerInterface $entityManager, Request $request, LoggerInterface $tracabilityLogger): JsonResponse
    {
        $data = json_decode($request->getContent(), true);

        $nombrePlaylist = $data['nombre'];
        $visibilidad = $data['visibilidad'];
        $cancionesIds = $data['canciones']; 
    
        $playlist = new Playlist();
        $playlist->setNombre($nombrePlaylist);
        $playlist->setVisibilidad($visibilidad);
        $playlist->setReproducciones(0);
        $playlist->setLikes(0);
        $usuario = $this->getUser();
        $playlist->setPropietario($usuario);
    
        foreach ($cancionesIds as $idCancion) {
            $cancion = $entityManager->getRepository(Cancion::class)->find($idCancion);
    
            if ($cancion) {
                $playlistCancion = new PlaylistCancion();
                $playlistCancion->setPlaylist($playlist);
                $playlistCancion->setCancion($cancion);
    
                $entityManager->persist($playlistCancion);
            }
        }
    
        $entityManager->persist($playlist);
        $entityManager->flush();

        //traza
        $usuario = $this->getUser();  
        $marcaTemporal=new DateTime();
        $marcaTemporal=$marcaTemporal->format('Y-m-d H:i:s');
        
        $tracabilityLogger->info('Crea playlist', [
            'usuario' => $usuario->getNombre(),
            'nombre' => $nombrePlaylist,
            'fecha'=> $marcaTemporal,
        ]);
    
        return new JsonResponse([
            'status' => 'success',
            'message' => 'Playlist creada correctamente',
            'redirect' => $this->generateUrl('show_playlistUser')
        ]);
        
    }
}
