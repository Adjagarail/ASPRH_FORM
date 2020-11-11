<?php

namespace App\Form;

use App\Entity\Structure;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TelType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;

class StructureType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('Nom')
            ->add('SecteurActivite')
            ->add('Membre', ChoiceType::class, [
                'choices'   => [
                    'OUI'=>'OUI',
                    'NON'=>'NON',
                ],
                'choice_attr' => [
                    'OUI'=>['class'=> 'container_radio mr-3'],
                    'NON'=>['class' => 'container_radio mr-3']
                ],
            'label'=> ' ',
            'label_attr' => [
                'class' => 'label_none'
            ],
            'expanded' => true,
            ])

            ->add('Cfce', ChoiceType::class, [
            'choices'   => [
                'OUI' => 'OUI',
                'NON' => 'NON',
            ],
            'choice_attr' => [
                'OUI' => ['class' => 'container_radio mr-3'],
                'NON' => ['class' => 'container_radio mr-3']
            ],
            'label'=> ' ',
            'label_attr'=> [
                'class' => 'label_none'
            ],
            'expanded' => true,
            ])

            ->add('PrenomNomReferent', TextType::class)
            ->add('FonctionReferent', TextType::class)
            ->add('Telephone', TelType::class)
            ->add('Email', EmailType::class) ;

        $builder->add('Besoin', CollectionType::class, [
            'entry_type' => BesoinType::class,
            'entry_options' => ['label' => false],
            'allow_add' => true,
            'by_reference' => false,
            'allow_delete' => true,
        ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Structure::class,
        ]);
    }
}
