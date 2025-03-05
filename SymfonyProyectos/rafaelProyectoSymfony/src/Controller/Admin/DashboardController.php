<?php

namespace App\Controller\Admin;

use App\Entity\Cancion;
use App\Entity\Estilo;
use App\Entity\Playlist;
use Symfony\Component\Routing\Annotation\Route;
use EasyCorp\Bundle\EasyAdminBundle\Attribute\AdminDashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use Symfony\Component\HttpFoundation\Response;
use DateTime;
use Psr\Log\LoggerInterface;

#[AdminDashboard(routePath: '/admin', routeName: 'admin')]
class DashboardController extends AbstractDashboardController
{
    private LoggerInterface $tracabilityLogger;

    public function __construct(LoggerInterface $tracabilityLogger)
    {
        $this->tracabilityLogger = $tracabilityLogger;
    }
    #[Route('/admin', name: 'admin')]
    public function index(): Response
    {

        $usuario = $this->getUser();  
        $marcaTemporal=new DateTime();
        $marcaTemporal=$marcaTemporal->format('Y-m-d H:i:s');
        
        $this->tracabilityLogger->info('Acceso admin al dashboard ', [
            'usuario' => $usuario->getNombre(),
            'fecha'=> $marcaTemporal,
        ]);
        return $this->render('admin/dashboard.html.twig');

        // Option 1. You can make your dashboard redirect to some common page of your backend
        //
        // 1.1) If you have enabled the "pretty URLs" feature:
        // return $this->redirectToRoute('admin_user_index');
        //
        // 1.2) Same example but using the "ugly URLs" that were used in previous EasyAdmin versions:
        // $adminUrlGenerator = $this->container->get(AdminUrlGenerator::class);
        // return $this->redirect($adminUrlGenerator->setController(OneOfYourCrudController::class)->generateUrl());

        // Option 2. You can make your dashboard redirect to different pages depending on the user
        //
        // if ('jane' === $this->getUser()->getUsername()) {
        //     return $this->redirectToRoute('...');
        // }

        // Option 3. You can render some custom template to display a proper dashboard with widgets, etc.
        // (tip: it's easier if your template extends from @EasyAdmin/page/content.html.twig)
        //
        // return $this->render('some/path/my-dashboard.html.twig');
    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('Gestión de procesos');
    }

    public function configureMenuItems(): iterable
    {
        yield MenuItem::linkToDashboard('Dashboard', 'fa fa-home');
        yield MenuItem::linkToCrud('Cancion', 'fas fa-list', Cancion::class);
        yield MenuItem::linkToCrud('Estilo', 'fas fa-list', Estilo::class);
        yield MenuItem::linkToCrud('Playlist', 'fas fa-list', Playlist::class);
    }
}
