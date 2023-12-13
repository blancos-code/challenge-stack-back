<?php

namespace App\Controller\Admin;


use App\Entity\Categorie;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Router\AdminUrlGenerator;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;

class DashboardController extends AbstractDashboardController
{
    #[Route('/admin', name: 'admin')]
    public function index(): Response
    {
        $adminUrlGenerator = $this->container->get(AdminUrlGenerator::class);

        // Option 1. Make your dashboard redirect to the same page for all users
        return $this->redirect($adminUrlGenerator->setController(CategorieCrudController::class)->generateUrl());

        // Option 2. Make your dashboard redirect to different pages depending on the user
        /*if ('estelle' === $this->getUser()->getUsername()) {
            return $this->redirect('cuisine');
        }*/
        
        return parent::index();

        // return $this->render('some/path/my-dashboard.html.twig');
    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('Tété dashboard')
            ->setLocales([
                'fr' => '🇫🇷 Français',
                'en' => '🇬🇧 English'
            ]);
    }

    public function configureMenuItems(): iterable
    {
        return [
            MenuItem::linkToDashboard('Dashboard', 'fa fa-home'),

            MenuItem::section('Marché'),
            MenuItem::linkToCrud('Marchés', 'fa fa-tags', MarcheCrudController::getEntityFqcn()),
            MenuItem::linkToCrud('Categories', 'fa fa-tags', CategorieCrudController::getEntityFqcn()),
            
            MenuItem::section('Producteurs'),
            MenuItem::linkToCrud('Producteurs', 'fa fa-file-text', ProducteurCrudController::getEntityFqcn()),
            MenuItem::linkToCrud('Produits', 'fa fa-file-text', ProduitCrudController::getEntityFqcn()),

            MenuItem::section('Utilisateurs'),
            MenuItem::linkToCrud('Utilisateurs', 'fa fa-user', UserCrudController::getEntityFqcn()),
        ];
    }
}