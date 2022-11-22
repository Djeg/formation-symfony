<?php

namespace App\Form;

use App\DTO\AdSearchCriteria;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class AdSearchType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('searchText', TextType::class, [
                'label' => 'Rechercher :',
            ])
            ->add('genre')
            ->add('author')
            ->add('minPrice')
            ->add('maxPrice')
            ->add('startedAt')
            ->add('endedAt')
            ->add('orderBy')
            ->add('direction')
            ->add('limit')
            ->add('page');
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => AdSearchCriteria::class,
            'method' => 'GET',
        ]);
    }

    public function getBlockPrefix(): string
    {
        return '';
    }
}
