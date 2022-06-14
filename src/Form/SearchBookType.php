<?php

namespace App\Form;

use App\DTO\SearchBookCriteria;
use App\Entity\Author;
use App\Entity\Category;
use App\Entity\PublishingHouse;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\MoneyType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class SearchBookType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('title', TextType::class, [
                'label' => 'Titre de livre :',
                'required' => false,
            ])
            ->add('authors', EntityType::class, [
                'label' => 'Auteurs :',
                'class' => Author::class,
                'choice_label' => 'name',
                'multiple' => true,
                'expanded' => true,
                'required' => false,
            ])
            ->add('categories', EntityType::class, [
                'label' => 'Catégories :',
                'class' => Category::class,
                'choice_label' => 'name',
                'multiple' => true,
                'expanded' => true,
                'required' => false,
            ])
            ->add('minPrice', MoneyType::class, [
                'label' => 'Prix minimum :',
                'required' => false,
            ])
            ->add('maxPrice', MoneyType::class, [
                'label' => 'Prix maximum :',
                'required' => false,
            ])
            ->add('publishingHouses', EntityType::class, [
                'label' => "Maisons d'édition :",
                'class' => PublishingHouse::class,
                'choice_label' => 'name',
                'multiple' => true,
                'expanded' => true,
                'required' => false,
            ])
            ->add('orderBy', ChoiceType::class, [
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
                ]
            ])
            ->add('limit', NumberType::class, [
                'label' => 'Nombre de résultat :',
                'required' => true,
            ])
            ->add('page', NumberType::class, [
                'label' => 'Page :',
                'required' => true,
            ])
            ->add('send', SubmitType::class, [
                'label' => 'Envoyer',
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => SearchBookCriteria::class,
            'method' => 'GET',
            'csrf_protection' => false,
        ]);
    }
}
