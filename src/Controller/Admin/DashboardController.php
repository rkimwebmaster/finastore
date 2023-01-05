<?php

namespace App\Controller\Admin;

use App\Entity\Achat;
use App\Entity\Annulation;
use App\Entity\Categorie;
use App\Entity\Client;
use App\Entity\Contact;
use App\Entity\Entreprise;
use App\Entity\MobileMoney;
use App\Entity\NewsLetter;
use App\Entity\PageLivraison;
use App\Entity\PagePolicy;
use App\Entity\PageQSN;
use App\Entity\Partenaire;
use App\Entity\Photo;
use App\Entity\Produit;
use App\Entity\Recherche;
use App\Entity\Service;
use App\Entity\TeamMember;
use App\Entity\User;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Router\AdminUrlGenerator;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DashboardController extends AbstractDashboardController
{

    public function __construct(private AdminURLGenerator $adminURL)
    {
    }
    #[Route('/admin', name: 'admin')]
    public function index(): Response
    {
        $adminUrlGenerator = $this->container->get(AdminUrlGenerator::class);
        
        return $this->render('admin/my-dashboard.html.twig');
    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->generateRelativeUrls()
            ->setTitle('Fina Admin');
    }

    public function configureMenuItems(): iterable
    {
        return [
            MenuItem::linkToDashboard('WebSite', 'fa fa-home')->setLinkTarget('app_accueil'),

            
            MenuItem::subMenu('Achats ')->setSubItems([
                MenuItem::linkToCrud('Liste ', 'fa fa-tags', Achat::class)->setAction(Crud::PAGE_INDEX),
                // MenuItem::linkToCrud('Nouveau', 'fa fa-plus-circle', Categorie::class)->setAction(Crud::PAGE_NEW),

            ]),
            MenuItem::section('Configuration', 'fa fa-search-plus'),
            MenuItem::subMenu('Entreprise')->setSubItems([
                MenuItem::linkToCrud('Liste ', 'fa fa-tags', Entreprise::class)->setAction(Crud::PAGE_INDEX),
                MenuItem::linkToCrud('Nouveau', 'fa fa-plus-circle', Entreprise::class)->setAction(Crud::PAGE_NEW),

            ]),
            MenuItem::subMenu('Categories')->setSubItems([
                MenuItem::linkToCrud('Liste ', 'fa fa-tags', Categorie::class)->setAction(Crud::PAGE_INDEX),
                MenuItem::linkToCrud('Nouveau', 'fa fa-plus-circle', Categorie::class)->setAction(Crud::PAGE_NEW),

            ]),
            MenuItem::subMenu('Produits')->setSubItems([
                MenuItem::linkToCrud('Liste ', 'fa fa-tags', Produit::class)->setAction(Crud::PAGE_INDEX),
                MenuItem::linkToCrud('Nouveau', 'fa fa-plus-circle', Produit::class)->setAction(Crud::PAGE_NEW),

            ]),
            MenuItem::subMenu('Page Qui Sommes-nous')->setSubItems([
                MenuItem::linkToCrud('Liste ', 'fa fa-tags', PageQSN::class)->setAction(Crud::PAGE_INDEX),
                MenuItem::linkToCrud('Nouveau', 'fa fa-plus-circle', PageQSN::class)->setAction(Crud::PAGE_NEW),

            ]),
            MenuItem::subMenu('Page Livraison')->setSubItems([
                MenuItem::linkToCrud('Liste ', 'fa fa-tags', PageLivraison::class)->setAction(Crud::PAGE_INDEX),
                MenuItem::linkToCrud('Nouveau', 'fa fa-plus-circle', PageLivraison::class)->setAction(Crud::PAGE_NEW),

            ]),
            MenuItem::subMenu('Page Policy')->setSubItems([
                MenuItem::linkToCrud('Liste ', 'fa fa-tags', PagePolicy::class)->setAction(Crud::PAGE_INDEX),
                MenuItem::linkToCrud('Nouveau', 'fa fa-plus-circle', PagePolicy::class)->setAction(Crud::PAGE_NEW),

            ]),
            MenuItem::subMenu('Partenaires ')->setSubItems([
                MenuItem::linkToCrud('Liste ', 'fa fa-tags', Partenaire::class)->setAction(Crud::PAGE_INDEX),
                MenuItem::linkToCrud('Nouveau', 'fa fa-plus-circle', Partenaire::class)->setAction(Crud::PAGE_NEW),

            ]),
            MenuItem::subMenu('Equipe ')->setSubItems([
                MenuItem::linkToCrud('Liste ', 'fa fa-tags', TeamMember::class)->setAction(Crud::PAGE_INDEX),
                MenuItem::linkToCrud('Nouveau', 'fa fa-plus-circle', TeamMember::class)->setAction(Crud::PAGE_NEW),

            ]),
            MenuItem::subMenu('Services')->setSubItems([
                MenuItem::linkToCrud('Liste ', 'fa fa-tags', Service::class)->setAction(Crud::PAGE_INDEX),
                MenuItem::linkToCrud('Nouveau', 'fa fa-plus-circle', Service::class)->setAction(Crud::PAGE_NEW),

            ]),
            MenuItem::section('Modes de paiement'),
            MenuItem::subMenu('Mobile Money')->setSubItems([
                MenuItem::linkToCrud('Liste ', 'fa fa-tags', MobileMoney::class)->setAction(Crud::PAGE_INDEX),
                MenuItem::linkToCrud('Nouveau', 'fa fa-plus-circle', MobileMoney::class)->setAction(Crud::PAGE_NEW),

            ]),
            
            MenuItem::section('Gestion des utilisateurs'),
            MenuItem::subMenu('Utilisateurs')->setSubItems([
                MenuItem::linkToCrud('Liste ', 'fa fa-tags', User::class)->setAction(Crud::PAGE_INDEX),
                MenuItem::linkToCrud('Nouveau', 'fa fa-plus-circle', User::class)->setAction(Crud::PAGE_NEW),

            ]),
            MenuItem::section('Métiers '),
            MenuItem::subMenu('Liste des éléments ')->setSubItems([
                MenuItem::linkToCrud('Achats', 'fa fa-tags', Achat::class),
                MenuItem::linkToCrud('Annulations', 'fa fa-tags', Annulation::class),
                MenuItem::linkToCrud('NewsLetters ', 'fa fa-tags', NewsLetter::class),
                MenuItem::linkToCrud('Contacts', 'fa fa-tags', Contact::class),
                MenuItem::linkToCrud('Clients', 'fa fa-tags', Client::class),
                MenuItem::linkToCrud('Recherches ', 'fa fa-tags', Recherche::class),

            ]),
            MenuItem::section('Infos entreprise'),
            MenuItem::linkToCrud('Entreprise', 'fa fa-tags', Entreprise::class),
            // MenuItem::section('Statistiques'),
            // MenuItem::linkToCrud('Achats', 'fa fa-tags', Achat::class),
            // MenuItem::linkToCrud('Annualtion', 'fa fa-tags', Annulation::class),

            // MenuItem::linkToCrud('Blog Posts', 'fa fa-file-text', BlogPost::class),

        ];
    }
}
