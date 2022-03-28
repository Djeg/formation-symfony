<?php

namespace App\Form\Admin;

use App\DTO\Admin\AdminBookSearch;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class AdminSearchBookType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('limit', IntegerType::class, [
                'label' => 'Limite :',
                'required' => true,
            ])
            ->add('page', IntegerType::class, [
                'label' => 'Page :',
                'required' => true,
            ])
            ->add('sortBy', ChoiceType::class, [
                'label' => 'Trier par :',
                'required' => true,
                'choices' => [
                    'Identifiant' => 'id',
                    'Titre' => 'title',
                    'Prix' => 'price',
                ],
            ])
            ->add('direction', ChoiceType::class, [
                'label' => 'Sens du trie :',
                'required' => true,
                'choices' => [
                    'Croissant' => 'ASC',
                    'Décroissant' => 'DESC',
                ],
            ])
            ->add('title', TextType::class, [
                'label' => 'Titre :',
                'required' => false,
            ])
            ->add('authorName', TextType::class, [
                'label' => 'Nom d\'auteur :',
                'required' => false,
            ])
            ->add('maxPrice', NumberType::class, [
                'label' => 'Prix maximum :',
                'required' => false,
            ])
            ->add('minPrice', NumberType::class, [
                'label' => 'Prix minimum :',
                'required' => false,
            ])
            ->add('submit', SubmitType::class, [
                'label' => 'Rechercher',
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => AdminBookSearch::class,
            'method' => 'GET',
            'csrf_protection' => false,
        ]);
    }
}
