<?php

namespace App\Controller\Admin;

use App\Entity\PageLivraison;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class PageLivraisonCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return PageLivraison::class;
    }

    /*
    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id'),
            TextField::new('title'),
            TextEditorField::new('description'),
        ];
    }
    */
}
