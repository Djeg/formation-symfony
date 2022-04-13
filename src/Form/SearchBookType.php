<?php

namespace App\Form;

use App\DTO\BookSearchCriteria;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class SearchBookType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('title', TextType::class, [
                'label' => 'Par titre :',
            ])
            ->add('authorName', TextType::class, [
                'label' => 'Par nom d\'auteur :',
            ])
            ->add('categoryName', TextType::class, [
                'label' => 'Par nom de catégorie :',
            ])
            ->add('limit', IntegerType::class, [
                'label' => 'Nombre de résultat :',
            ])
            ->add('page', IntegerType::class, [
                'label' => 'Page :',
            ])
            ->add('orderBy', ChoiceType::class, [
                'label' => 'Trier par :',
                'choices' => [
                    'prix' => 'price',
                    'identifiant' => 'id',
                    'date de création' => 'createdAt',
                    'date de mise à jour' => 'updatedAt',
                ],
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => BookSearchCriteria::class,
        ]);
    }
}
