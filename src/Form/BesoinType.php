<?php

namespace App\Form;

use App\Entity\Besoin;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class BesoinType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('Description', TextareaType::class, [
                'attr' => [
                    'class'=> 'form-control required'
                ]
            ])
            ->add('Priorite', ChoiceType::class,[
            'choices'   => [
                'P1 * Important et urgent (moins de 3 mois)' => 'P1',
                'P2 * Important mais pas urgent (3 - 6 mois)' => 'P2',
                'P3 * Important (à prévoir)' => 'P3',
            ],
            'expanded' => true,
            'label' => " Degré de priorité ",
            ])
            ->add('Cadre', NumberType::class, [
            'attr' => [
                'class' => 'form-control required'
            ]
        ])
            ->add('Agent', NumberType::class, [
            'attr' => [
                'class' => 'form-control required'
            ]
        ])
            ->add('Employer', NumberType::class, [
            'attr' => [
                'class' => 'form-control required'
            ]
        ])
            ->add('Observation', TextareaType::class, [
            'attr' => [
                'class' => 'form-control required'
            ]
        ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Besoin::class,
        ]);
    }
}
