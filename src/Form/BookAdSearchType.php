<?php

namespace App\Form;

use App\DTO\BookAdCriteria;
use App\Entity\BookAd;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\MoneyType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class BookAdSearchType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('title', TextType::class, [
                'label' => 'Titre :',
                'required' => false,
            ])
            ->add('states', ChoiceType::class, [
                'label' => 'États :',
                'required' => false,
                'choices' => [
                    'Très bon état' => BookAd::STATE_VERY_GOOD,
                    'Bon état' => BookAd::STATE_GOOD,
                    'Usé' => BookAd::STATE_USED,
                    'Très usé' => BookAd::STATE_VERY_USED,
                ],
                'multiple' => true,
                'expanded' => true,
            ])
            ->add('minPrice', MoneyType::class, [
                'label' => 'Prix min :',
                'required' => false,
            ])
            ->add('maxPrice', MoneyType::class, [
                'label' => 'Prix max :',
                'required' => false,
            ])
            ->add('user', TextType::class, [
                'label' => 'Vendu par :',
                'required' => false,
            ])
            ->add('limit', NumberType::class, [
                'label' => 'Limite :',
                'required' => false,
                'empty_data' => 25,
            ])
            ->add('page', NumberType::class, [
                'label' => 'Page :',
                'required' => false,
                'empty_data' => 1,
            ])
            ->add('orderBy', ChoiceType::class, [
                'label' => 'Trier par :',
                'required' => false,
                'empty_data' => 'createdAt',
                'choices' => [
                    'Date' => 'createdAt',
                    'Prix' => 'price',
                    'Titre' => 'title',
                ],
            ])
            ->add('direction', ChoiceType::class, [
                'label' => 'Sens du trie :',
                'required' => false,
                'empty_data' => 'DESC',
                'choices' => [
                    'Croissant' => 'ASC',
                    'Décroissant' => 'DESC',
                ],
            ])
            ->add('submit', SubmitType::class, [
                'label' => 'Rechercher',
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => BookAdCriteria::class,
            'method' => 'GET',
            'empty_data' => new BookAdCriteria(),
            'data' => new BookAdCriteria(),
            'csrf_protection' => false,
        ]);
    }

    public function getBlockPrefix()
    {
        return '';
    }
}
