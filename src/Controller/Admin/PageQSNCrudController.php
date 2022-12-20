<?php

namespace App\Controller\Admin;

use App\Entity\PageQSN;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;

class PageQSNCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return PageQSN::class;
    }


    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')->hideOnForm(),
            TextEditorField::new('contenu'),
            DateTimeField::new('createdAt'),
            DateTimeField::new('updatedAt'),
        ];
    }

}
