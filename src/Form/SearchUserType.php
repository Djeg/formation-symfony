<?php

namespace App\Form;

use App\DTO\SearchUserCriteria;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class SearchUserType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('limit', NumberType::class, [
                'label' => 'Nombre de résultats :',
                'required' => false,
                'empty_data' => 25,
            ])
            ->add('page', NumberType::class, [
                'label' => 'Page :',
                'required' => false,
                'empty_data' => 1,
            ])
            ->add('sortBy', ChoiceType::class, [
                'label' => 'Trier par :',
                'required' => false,
                'choices' => [
                    'identifiant' => 'id',
                    'Email' => 'email',
                ],
                'empty_data' => 'id',
            ])
            ->add('direction', ChoiceType::class, [
                'label' => 'Sens du trie :',
                'required' => false,
                'choices' => [
                    'Croissant' => 'ASC',
                    'Décroissant' => 'DESC'
                ],
                'empty_data' => 'DESC'
            ])
            ->add('send', SubmitType::class, [
                'label' => 'Envoyer',
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => SearchUserCriteria::class,
            'method' => 'GET',
        ]);
    }
}
