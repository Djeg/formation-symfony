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
                'required' => false,
            ])
            ->add('authorName', TextType::class, [
                'label' => 'Par nom d\'auteur :',
                'required' => false,
            ])
            ->add('categoryName', TextType::class, [
                'label' => 'Par nom de catégorie :',
                'required' => false,
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
            // !!! POUR UN FORMULAIRE DE RECHERCHE UTILISEZ LA METHODE GET !!!
            'method' => 'GET',
            // !!! POUR UN FORMULAIRE DE RECHERCHE PAS BESOIN DE TOKEN DE SECURITE !!!
            'csrf_protection' => false,
        ]);
    }

    /**
     * !! ON DESACTIVE LE PREFIX
     *
     * 
     * Désactive le prefix du formulaire, permettant d'avoir
     * de belle urls.
     */
    public function getBlockPrefix(): string
    {
        return '';
    }
}
