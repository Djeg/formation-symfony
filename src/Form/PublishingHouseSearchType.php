<?php

namespace App\Form;

use App\DTO\PublishingHouseSearchCriteria;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

/**
 * Formulaire de recherche pour les maisos d'éditions
 */
class PublishingHouseSearchType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('title', TextType::class, [
                'label' => 'Titre :',
                'required' => false,
            ])
            ->add('limit', NumberType::class, [
                'label' => 'Limite :',
            ])
            ->add('page', NumberType::class, [
                'label' => 'Page :',
            ])
            ->add('submit', SubmitType::class, [
                'label' => 'Rechercher',
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => PublishingHouseSearchCriteria::class,
            'method' => 'GET',
            'empty_data' => new PublishingHouseSearchCriteria(),
            'data' => new PublishingHouseSearchCriteria(),
            'csrf_protection' => false,
        ]);
    }
}
