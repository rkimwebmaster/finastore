<?php

namespace App\Form;

use App\Entity\Adresse;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CountryType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class AdresseType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('adresse',null,[
                'help'=>"Exemple: 2 avenue des ardènnes , Belair.",
            ])
            ->add('ville')
            ->add('pays', CountryType::class,[
                "preferred_choices"=>['CD'],
                "attr"=>['class'=>"form-control mb-4"]
            ])
            ->add('telephone')
            // ->add('email')
            // ->add('createdAt')
            // ->add('updatedAt')
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Adresse::class,
        ]);
    }
}
