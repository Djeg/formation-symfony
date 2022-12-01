<?php

namespace App\Form;

use App\DTO\AdSearchCriteria;
use App\Entity\User;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\MoneyType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

/**
 * Formulaire de recherche pour les annonces
 */
class SearchAdType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $defaultCriterias = $options['empty_data'];

        $builder
            ->add('searchText', TextType::class, [
                'label' => 'Rechercher :',
                'required' => false,
            ])
            ->add('genre', ChoiceType::class, [
                'label' => 'Genre :',
                'required' => false,
                'choices' => [
                    'Science Fiction' => 'science-fiction',
                    'Policier' => 'policier',
                    'Fantastique' => 'fantastique',
                    'Romantique' => 'romantique',
                ],
            ])
            ->add('author', EntityType::class, [
                'label' => 'Auteur :',
                'required' => false,
                'class' => User::class,
                'choice_label' => 'email',
            ])
            ->add('minPrice', MoneyType::class, [
                'label' => 'Prix minimum :',
                'required' => false,
            ])
            ->add('maxPrice', MoneyType::class, [
                'label' => 'Prix maximum :',
                'required' => false,
            ])
            ->add('orderBy', ChoiceType::class, [
                'label' => 'Trier par :',
                'choices' => [
                    'Date de création' => 'createdAt',
                    'Date de dernière modification' => 'updatedAt',
                    'Titre' => 'title',
                    'Prix' => 'price',
                ],
                'empty_data' => $defaultCriterias->orderBy,
                'required' => false,
            ])
            ->add('direction', ChoiceType::class, [
                'label' => 'Sens du trie :',
                'choices' => [
                    'Croissant' => 'ASC',
                    'Décroissant' => 'DESC',
                ],
                'empty_data' => $defaultCriterias->direction,
                'required' => false,
            ])
            ->add('limit', NumberType::class, [
                'label' => 'Nombre de résultats par page :',
                'empty_data' => (string)$defaultCriterias->limit,
                'required' => false,
            ])
            ->add('page', NumberType::class, [
                'label' => 'Page :',
                'empty_data' => (string)$defaultCriterias->page,
                'required' => false,
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => AdSearchCriteria::class,
            'csrf_protection' => false,
            'method' => 'GET',
            'empty_data' => new AdSearchCriteria(),
            'data' => new AdSearchCriteria(),
        ]);
    }

    public function getBlockPrefix(): string
    {
        return '';
    }
}
