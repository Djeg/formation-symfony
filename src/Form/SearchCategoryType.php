<?php

namespace App\Form;

use App\DTO\SearchCategoryCriteria;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class SearchCategoryType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name', TextType::class, [
                'label' => "Nom de la catégorie :",
                'required' => false,
            ])
            ->add('orderBy', ChoiceType::class, [
                'label' => 'Trier par :',
                'choices' => [
                    'Nom' => 'name',
                    'Identifiant' => 'id',
                ],
                'required' => true,
            ])
            ->add('direction', ChoiceType::class, [
                'label' => 'Diréction :',
                'choices' => [
                    'Croissant' => 'ASC',
                    'Décroissant' => 'DESC',
                ],
                'required' => true,
            ])
            ->add('limit', NumberType::class, [
                'label' => 'Limite :',
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
            'data_class' => SearchCategoryCriteria::class,
            'method' => 'GET',
            'csrf_protection' => false,
        ]);
    }
}
