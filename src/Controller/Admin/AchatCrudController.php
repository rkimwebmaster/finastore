<?php

namespace App\Controller\Admin;

use App\Entity\Achat;
use EasyCorp\Bundle\EasyAdminBundle\Config\Action;
use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\BooleanField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\MoneyField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class AchatCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Achat::class;
    }

    
    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')->hideOnForm(),
            TextField::new('codeClient')->hideWhenUpdating(),
            TextField::new('etat')->hideWhenUpdating(),
            DateTimeField::new('dateAchat')->hideWhenUpdating(),
            DateTimeField::new('dateLivraison')->hideWhenUpdating(),
            MoneyField::new('prixTotal')->setCurrency('USD')->hideWhenUpdating(),
            TextField::new('numeroReference')->hideWhenUpdating(),
            BooleanField::new('isApprouve')->onlyWhenUpdating(),
            BooleanField::new('isAnnule')->onlyWhenUpdating(),
            BooleanField::new('isLivre')->onlyWhenUpdating(),
        ];
    }
    
    public function configureActions(Actions $actions): Actions
    {
        return $actions
            // ...
            ->remove(Crud::PAGE_INDEX, Action::NEW)
            // ->remove(Crud::PAGE_DETAIL, Action::EDIT)
        ;
    }
}
