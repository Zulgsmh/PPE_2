<?php

namespace App\Form;

use App\Entity\Lignefraisforfait;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class LignefraisforfaitType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('idvisiteur')
            ->add('mois')
            ->add('idfraisforfait')
            ->add('quantite')
            ->add('montant')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Lignefraisforfait::class,
        ]);
    }
}
