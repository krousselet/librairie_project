<?php

namespace App\Form;

use App\Entity\Emprunt;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Date;

class CommandeFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            //->add('dateEmprunt')  // commented out, make sure you want this line commented
            //->add('dateRetour', DateTimeType::class, ["attr" => ["class" => "Test", "html" => false]])  // also commented out
            ->add('dateRetour', ChoiceType::class, [
                'choices' => [
                    'One Day' => true,
                    'One week' => true,
                    'One Month' => true,
                ],
            ])
            ->add('dateEmprunt', DateTimeType::class, ["attr"=>["hidden"=>"hidden"], "label_attr"=>["hidden"=>"hidden"]]);
    }


    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Emprunt::class,
        ]);
    }
}
