<?php

namespace App\Controller\Admin;

use App\Entity\Produit;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\BooleanField;
use EasyCorp\Bundle\EasyAdminBundle\Field\CollectionField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ColorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\FormField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IntegerField;
use EasyCorp\Bundle\EasyAdminBundle\Field\MoneyField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\UrlField;

class ProduitCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Produit::class;
    }

    
    public function configureFields(string $pageName): iterable
    {
        return [
            // FormField::addTab('Descriptions'),
            IdField::new('id')->hideOnForm(),
            TextField::new('nom'),
            BooleanField::new('categorie'),
            MoneyField::new('prixVente')->setCurrency("USD"),
            BooleanField::new('isArrivage')->onlyOnForms(),
            TextField::new('code')->hideOnForm(),
            // FormField::addTab('Stock'),
            // IntegerField::new('qteStock'),
            // IntegerField::new('qteAlerte')->hideOnIndex(),
            // FormField::addTab('Caracteristiques'),
            ColorField::new('couleur')->hideOnIndex(),
            ImageField::new('photoPrincipale')->setBasePath('uploads/images/produits/')->setUploadDir('public/uploads/images/produits/'),
            ImageField::new('photoPrincipaleNoirBlanc')->setBasePath('uploads/images/produits/')->setUploadDir('public/uploads/images/produits/'),
            CollectionField::new('photos')->useEntryCrudForm(PhotoCrudController::class)->hideOnIndex(),
            // yield CollectionField::new('...')->useEntryCrudForm(CategoryCrudController::class);

            // ImageField::new('photos')->setBasePath("uploads/images/produits/")->setUploadDir("public/uploads/images/produits/"),
            // ImageField::new('image')->setBasePath('assets/images/')->setUploadDir('public/assets/images/'),
            UrlField::new('urlVideoYoutube')->hideOnIndex(),
            TextEditorField::new('description')->hideOnIndex(),
            AssociationField::new('categorie'),
        ];
    }
    
}
