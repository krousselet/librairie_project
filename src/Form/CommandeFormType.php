<?php

namespace App\Form;

use App\Domain\Emprunt\Emprunt;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CommandeFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('dateEmprunt', DateTimeType::class, [
                "attr" => ["hidden" => "hidden"],
                "label_attr" => ["hidden" => "hidden"]
            ])
            ->add('dateRetour', ChoiceType::class, [
                'choices' => [
                    'One Week' => 'one_week',
                    'One Month' => 'one_month',
                ],
            ])
            ->addEventListener(FormEvents::SUBMIT, function (FormEvent $event) {
                $form = $event->getForm();
                $emprunt = $event->getData();
                $chosenOption = $form['dateRetour']->getData();

                switch ($chosenOption) {
                    case 'one_week':
                        $emprunt->setDateRetour((new \DateTime())->modify('+1 week'));
                        break;
                    case 'one_month':
                        $emprunt->setDateRetour((new \DateTime())->modify('+1 month'));
                        break;
                }
            });
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Emprunt::class,
        ]);
    }
}
