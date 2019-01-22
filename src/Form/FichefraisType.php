<?php

namespace App\Form;

use App\Entity\Fichefrais;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class FichefraisType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('mois')
            ->add('nbjustificatifs')
            ->add('montantvalide')
            ->add('datemodif')
            //->add('idetat')
            //->add('idvisiteur')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Fichefrais::class,
        ]);
    }
}
