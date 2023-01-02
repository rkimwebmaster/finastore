<?php

namespace App\Controller\Admin;

use App\Entity\MobileMoney;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class MobileMoneyCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return MobileMoney::class;
    }

    
    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')->hideOnForm(),
            TextField::new('designation'),
            TextField::new('numero'),
            TextEditorField::new('description'),
        ];
    }
    
}
