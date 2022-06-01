<?php

namespace App\Controller\Admin;

use App\Entity\Contact;
use App\Entity\User;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;

class DashboardController extends AbstractDashboardController
{
    #[Route('/admin', name: 'admin')]
    #[IsGranted('ROLE_ADMIN')]
    public function index(): Response
    {
        // return parent::index();
        return $this->render('admin/dashboard.html.twig');
    }



    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('Projet1 Admin')
            ->renderContentMaximized();
    }



    public function configureMenuItems(): iterable
    {
        yield MenuItem::linkToDashboard('Dashboard', 'fa fa-home');
        yield MenuItem::linkToCrud('Utilisateurs', 'fa fa-user', User::class);
        yield MenuItem::linkToCrud('Contact', 'fa fa-envelope', Contact::class);
        // yield MenuItem::linkToCrud('The Label', 'fas fa-list', User::class);
    }
}
