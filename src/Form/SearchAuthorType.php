<?php

namespace App\Form;

use App\DTO\AuthorSearchCriteria;
use DateTime;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class SearchAuthorType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name', TextType::class, [
                'label' => 'Nom :',
                'required' => false,
            ])
            ->add('limit', IntegerType::class, [
                'label' => 'Nombre de résultat par page :',
                'required' => false,
                'empty_data' => '15',
            ])
            ->add('page', IntegerType::class, [
                'label' => 'Page :',
                'required' => false,
                'empty_data' => '1',
            ])
            ->add('orderBy', ChoiceType::class, [
                'label' => 'Trier par :',
                'required' => false,
                'choices' => [
                    'Identifiant' => 'id',
                    'Nom' => 'name',
                    'Date de création' => 'createdAt',
                    'Date de mise à jour' => 'updatedAt',
                ],
                'empty_data' => 'id',
            ])
            ->add('direction', ChoiceType::class, [
                'label' => 'Sens du trie :',
                'required' => false,
                'choices' => [
                    'Croissant' => 'ASC',
                    'Décroissant' => 'DESC',
                ],
                'empty_data' => 'ASC',
            ])
            ->add('updatedAtStart', DateTimeType::class, [
                'label' => 'Mise à jour à partie de :',
                'required' => false,
            ])
            ->add('updatedAtStop', DateTimeType::class, [
                'label' => 'Mise à jour au plus tard :',
                'required' => false,
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => AuthorSearchCriteria::class,
            'method' => 'GET',
            'csrf_protection' => false,
        ]);
    }

    public function getBlockPrefix(): string
    {
        return '';
    }
}
