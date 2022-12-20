<?php

namespace App\Controller\Admin;

use App\Entity\MobileMoney;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class MobileMoneyCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return MobileMoney::class;
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
