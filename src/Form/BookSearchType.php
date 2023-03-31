<?php

namespace App\Form;

use App\DTO\BookSearchCriteria;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

/**
 * Formulaire de recherche des livres
 */
class BookSearchType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('title', TextType::class, [
                'label' => 'Titre :',
                'required' => false,
            ])
            ->add('author', TextType::class, [
                'label' => 'Auteur :',
                'required' => false,
            ])
            ->add('publishingHouse', TextType::class, [
                'label' => 'Maison d\'édition :',
                'required' => false,
            ])
            ->add('limit', NumberType::class, [
                'label' => 'Limite :',
                'empty_data' => 25,
            ])
            ->add('page', NumberType::class, [
                'label' => 'Page :',
                'empty_data' => 1,
            ])
            ->add('startAt', DateTimeType::class, [
                'label' => 'Créé à partir de :',
                'date_widget' => 'single_text',
                'required' => false,
            ])
            ->add('endAt', DateTimeType::class, [
                'label' => 'Créé jusqu\'à :',
                'date_widget' => 'single_text',
                'required' => false,
            ])
            ->add('submit', SubmitType::class, [
                'label' => 'Rechercher',
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => BookSearchCriteria::class,
            'method' => 'GET',
            'empty_data' => new BookSearchCriteria(),
            'data' => new BookSearchCriteria(),
            'csrf_protection' => false,
        ]);
    }

    public function getBlockPrefix(): string
    {
        return '';
    }
}
