<?php

namespace App\Form;

use App\Entity\Renseignements;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class RenseignementsType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nom')
            ->add('email')
            ->add('tetephone') 
            ->add('sonoEclairage')
            ->add('sonLumiere')
            ->add('photoVideo')
            ->add('autres')
            ->add('sujet')
            ->add('message')
//            ->add('dateCreation')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Renseignements::class,
        ]);
    }
}
