<?php

namespace App\Form\API;

use App\DTO\CategorySearch;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ApiSearchCategoryType extends AbstractType
{
    public CategorySearch $emptyData;

    public function __construct()
    {
        $this->emptyData = new CategorySearch();
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
                    'name' => 'name',
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
            ->add('name', TextType::class, [
                'required' => false,
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => CategorySearch::class,
            'method' => 'GET',
            'csrf_protection' => false,
            'data' => $this->emptyData,
        ]);
    }

    public function getBlockPrefix(): string
    {
        return '';
    }
}
