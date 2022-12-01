<?php

namespace App\Form;

use App\DTO\BookSearchCriteria;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

/**
 * Formulaire de recherche pour les livres
 */
class SearchBookType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $criterias = $options['empty_data'];

        $builder
            ->add('genre', ChoiceType::class, [
                'choices' => [
                    'Science Fiction' => 'science-fiction',
                    'Policier' => 'policier',
                    'Fantastique' => 'fantastique',
                    'Romantique' => 'romantique',
                ],
                'required' => false,
            ])
            ->add('limit', NumberType::class, [
                'required' => false,
                'empty_data' => (string)$criterias->limit,
            ])
            ->add('page', NumberType::class, [
                'required' => false,
                'empty_data' => (string)$criterias->page,
            ])
            ->add('orderBy', ChoiceType::class, [
                'choices' => [
                    'id' => 'id',
                    'title' => 'title',
                    'genre' => 'genre',
                    'createdAt' => 'createdAt',
                    'updatedAt' => 'updatedAt',
                ],
                'required' => false,
                'empty_data' => $criterias->orderBy,
            ])
            ->add('direction', ChoiceType::class, [
                'choices' => [
                    'desc' => 'DESC',
                    'asc' => 'ASC',
                ],
                'required' => false,
                'empty_data' => $criterias->direction
            ])
            ->add('searchText', TextType::class, [
                'required' => false,
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => BookSearchCriteria::class,
            'csrf_protection' => false,
            'method' => 'GET',
            'data' => new BookSearchCriteria(),
            'empty_data' => new BookSearchCriteria(),
        ]);
    }

    public function getBlockPrefix(): string
    {
        return '';
    }
}
