<?php

namespace App\Form\API;

use App\DTO\BookSearch;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ApiSearchBookType extends AbstractType
{
    public BookSearch $emptyData;

    public function __construct()
    {
        $this->emptyData = new BookSearch();
    }

    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('limit', IntegerType::class, [
                'required' => false,
                'empty_data' => $this->emptyData->limit,
            ])
            ->add('page', IntegerType::class, [
                'required' => false,
                'empty_data' => $this->emptyData->page,
            ])
            ->add('sortBy', ChoiceType::class, [
                'required' => false,
                'choices' => [
                    'id' => 'id',
                    'title' => 'title',
                    'price' => 'price',
                ],
                'empty_data' => $this->emptyData->sortBy,
            ])
            ->add('direction', ChoiceType::class, [
                'required' => false,
                'choices' => [
                    'ASC' => 'ASC',
                    'DESC' => 'DESC',
                ],
                'empty_data' => $this->emptyData->direction,
            ])
            ->add('title', TextType::class, [
                'required' => false,
            ])
            ->add('authorName', TextType::class, [
                'required' => false,
            ])
            ->add('categoryName', TextType::class, [
                'required' => false,
            ])
            ->add('authorId', TextType::class, [
                'required' => false,
            ])
            ->add('maxPrice', NumberType::class, [
                'required' => false,
            ])
            ->add('minPrice', NumberType::class, [
                'required' => false,
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => BookSearch::class,
            'method' => 'GET',
            'csrf_protection' => false,
            'empty_data' => $this->emptyData,
        ]);
    }

    /**
     * Désactive le préfix dans le cas d'un formulaire d'api.
     * 
     * Cela permet de mettre direction dans l'url le nom du champs
     * sans avoir à spécifier de préfix :).
     */
    public function getBlockPrefix(): string
    {
        return '';
    }
}
