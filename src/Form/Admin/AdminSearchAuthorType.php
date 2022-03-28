<?php

namespace App\Form\Admin;

use App\DTO\Admin\AdminAuthorSearch;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class AdminSearchAuthorType extends AbstractType
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
                    'Nom' => 'name',
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
            ->add('name', TextType::class, [
                'label' => 'Nom :',
                'required' => false,
            ])
            ->add('submit', SubmitType::class, [
                'label' => 'Rechercher',
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => AdminAuthorSearch::class,
            'method' => 'GET',
            'csrf_protection' => false,
        ]);
    }
}
