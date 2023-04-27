<?php

namespace App\Form;

use App\Entity\Vote;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use App\Entity\Bet;
use App\Entity\User;

class VoteType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $today = new \DateTime();

        $builder
            ->add('bet', EntityType::class, [
                'class' => Bet::class,
                'choice_label' => 'name',
                'disabled' => true,
                'label' => ' ',
            ])
            ->add('date', DateType::class, [
                'widget' => 'single_text',
                // 'data'  =>  array('year' => $today->format('Y'), 'month' => $today->format('m'), 'day' => $today->format('d')), 
            ])
            ->add('user', EntityType::class, [
                'class' => User::class,
                'label' => 'Pseudo',
                'choice_label' => 'username',
                'attr' => [
                    'required'   => true,
                ]
            ]);
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Vote::class,
        ]);
    }
}
