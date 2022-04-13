<?php

namespace App\Form;

use App\Entity\Author;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;

class AuthorType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name', TextType::class, [
                'label' => 'Nom :',
            ])
            ->add('description', TextareaType::class, [
                'label' => 'Description :',
            ]);

        if ($options['handleDates']) {
            $builder
                ->add('createdAt', DateTimeType::class, [
                    'label' => 'Date de création :',
                ])
                ->add('updatedAt', DateTimeType::class, [
                    'label' => 'Date de mise à jour :',
                ]);
        }
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->define('handleDates');

        $resolver->setDefaults([
            'data_class' => Author::class,
        ]);
    }
}
