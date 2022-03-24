<?php

namespace App\Form;

use App\DTO\SearchBook;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class SearchBookType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('title')
            ->add('limit')
            ->add('page')
            ->add('sortBy')
            ->add('direction')
            ->add('authorName')
            ->add('categories');
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => SearchBook::class,
        ]);
    }
}
