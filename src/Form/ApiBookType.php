<?php

namespace App\Form;

use App\Entity\Book;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ApiBookType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('title', TextType::class)
            ->add('description', TextareaType::class)
            ->add('genre', ChoiceType::class, [
                'choices' => [
                    'faintaisie' => 'fantaisie',
                    'science-fiction' => 'science-fiction',
                    'policier' => 'policier',
                    'autobiographie' => 'autobiograpie',
                    'roman' => 'roman',
                ]
            ])
            ->add('author', EntityType::class, [
                'class' => Author::class,
                'choice_label' => 'title',
            ])
            ->add('publishingHouse', EntityType::class, [
                'class' => PublishingHouse::class,
                'choice_label' => 'title',
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Book::class,
            'csrf_protection' => false,
        ]);
    }

    public function getBlockPrefix(): string
    {
        return '';
    }
}
