<?php

namespace App\Form;

use App\Entity\Achat;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class AchatType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            // ->add('dateAchat')
            // ->add('dateLivraison')
            // ->add('prixTotal')
            ->add('mobileMoney', null, [
                'help'=>'Faites le transfert au numéro indiquez ci-dessus et recuperer le code de confirmation',
            ])
            ->add('numeroReference',null,[
                'help'=>'Veuillez entrer le code referennce que votre opérateur mobile vous a envoyer',
            ])
            // ->add('isApprouve')
            // ->add('isAnnule')
            // ->add('isEnCours')
            // ->add('isPaye')
            // ->add('isLivre')
            // ->add('createdAt')
            // ->add('updatedAt')
            // ->add('client')
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Achat::class,
        ]);
    }
}
