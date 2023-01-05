<?php

namespace App\Controller\Admin;

use App\Entity\TeamMember;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class TeamMemberCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return TeamMember::class;
    }

    
    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')->hideOnForm(),
            TextField::new('noms'),
            TextField::new('fonction'),
            TextField::new('description'),
            ImageField::new('photoCouleur')->setBasePath('uploads/images/team/')->setUploadDir('public/uploads/images/team/'),
            ImageField::new('photoNoirBlanc')->setBasePath('uploads/images/team/')->setUploadDir('public/uploads/images/team/'),
            TextField::new('facebook'),
            TextField::new('twitter'),
            TextField::new('dribble'),
            TextField::new('pinterest'),
            TextField::new('behance'),
        ];
    }
    
}
