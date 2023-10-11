<?php

namespace App\Form;

use App\Entity\Exemplaires;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CommandeFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('etat')
            // ->add('statut') Pas besoin étant donné qu'il est disponible sur /location
            ->add('id_utilisateur');
        // ->add('id_livre');
        // ->add('livres')
        // ->add('emprunt');
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Exemplaires::class,
        ]);
    }
}
