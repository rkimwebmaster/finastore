<?php

namespace App\Form;

use App\Entity\Client;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ClientType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('codeClient', null, [
                'disabled'=>true,
                'help'=>"Bien retenir ce code, il vous servira dans le future.",
            ])
            // ->add('createdAt')
            // ->add('updatedAt')
            ->add('identite', IdentiteType::class)
            ->add('adresse', AdresseType::class)
            // ->add('utilisateur')
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Client::class,
        ]);
    }
}
