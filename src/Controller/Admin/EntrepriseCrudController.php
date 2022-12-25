<?php

namespace App\Controller\Admin;

use App\Entity\Adresse;
use App\Entity\Entreprise;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
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
            TextField::new('idNat')->hideOnIndex(),
            TextField::new('RCCM')->hideOnIndex(),
            TextField::new('sigle'),
            ImageField::new('logo')->setBasePath('uploads/images/produits/')->setUploadDir('public/uploads/images/produits/'),
            DateTimeField::new('createdAt')->hideOnForm(),
            DateTimeField::new('updatedAt')->hideOnForm(),
            TextField::new('emailEntreprise'),
            TextField::new('telephoneEntreprise'),
            TextField::new('websiteEntreprise')->hideOnIndex(),
            TextField::new('description')->hideOnIndex(),
            TextField::new('responsable')->hideOnIndex(),
            ImageField::new('imageHeroPrimaire')->setBasePath('uploads/images/produits/')->setUploadDir('public/uploads/images/produits/'),
            ImageField::new('imageHeroSecondaire')->setBasePath('uploads/images/produits/')->setUploadDir('public/uploads/images/produits/'),
            AssociationField::new('adresse')->renderAsEmbeddedForm(AdresseCrudController::class),
            // yield AssociationField::new('...')->renderAsEmbeddedForm(CategoryCrudController::class);
            // yield AssociationField::new('...')->renderAsNativeWidget();

        ];
    }
    
}
