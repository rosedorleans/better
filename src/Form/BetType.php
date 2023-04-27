<?php

namespace App\Form;

use App\Entity\Bet;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use App\Entity\Statut;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;

class BetType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name', TextareaType::class, [
                'label' => 'Titre'
            ])
            ->add('description', TextareaType::class)
            ->add('statut', EntityType::class, [
                'class' => Statut::class,
                'choice_label' => 'name',
                'attr' => [
                    'required'   => true,
                ]
            ]);
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Bet::class,
        ]);
    }
}
