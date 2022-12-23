<?php

namespace App\Controller\Admin;

use App\Entity\PagePolicy;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class PagePolicyCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return PagePolicy::class;
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
