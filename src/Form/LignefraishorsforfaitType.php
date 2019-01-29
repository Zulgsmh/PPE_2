<?php

namespace App\Form;

use App\Entity\Lignefraishorsforfait;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\FileType;



class LignefraishorsforfaitType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('libelle')
            ->add('mois')
            ->add('date')
            ->add('montant')
            ->add('fichier', FileType::class)
            ->add('idvisiteur')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Lignefraishorsforfait::class,
        ]);
    }
}
