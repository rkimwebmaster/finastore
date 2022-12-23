<?php

namespace App\Controller\Admin;

use App\Entity\Adresse;
use App\Entity\Entreprise;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class EntrepriseCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Entreprise::class;
    }

    
    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')->hideOnForm(),
            TextField::new('nom'),
            TextField::new('idNat'),
            TextField::new('RCCM'),
            TextField::new('sigle'),
            TextField::new('logo'),
            DateTimeField::new('createdAt')->hideOnForm(),
            DateTimeField::new('updatedAt')->hideOnForm(),
            TextField::new('emailEntreprise'),
            TextField::new('telephoneEntreprise'),
            TextField::new('websiteEntreprise'),
            TextField::new('description'),
            TextField::new('responsable'),
            TextField::new('imageHeroPrimaire'),
            TextField::new('imageHeroSecondaire'),
            TextEditorField::new('description'),
            AssociationField::new('adresse')->renderAsEmbeddedForm(AdresseCrudController::class),
            // yield AssociationField::new('...')->renderAsEmbeddedForm(CategoryCrudController::class);
            // yield AssociationField::new('...')->renderAsNativeWidget();

        ];
    }
    
}
