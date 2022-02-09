<?php

namespace App\Form;

use App\DTO\SearchDishCriteria;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class SearchDishType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('title', TextType::class, [
                'label' => 'Rechercher par titre :',
                'required' => false,
            ])
            ->add('limit', NumberType::class, [
                'label' => 'Limite de résultats par page :',
            ])
            ->add('page', NumberType::class, [
                'label' => 'N° page :',
            ])
            ->add('submit', SubmitType::class, [
                'label' => 'Rechercher',
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => SearchDishCriteria::class,
            'method' => 'GET',
            'csrf_protection' => false,
        ]);
    }
}
