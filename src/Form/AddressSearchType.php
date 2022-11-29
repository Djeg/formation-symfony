<?php

namespace App\Form;

use App\DTO\AddressSearchCriteria;
use App\Entity\User;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

/**
 * Formulaire de recherche pour des adresses. L'objectif de ce formulaire est de remplir
 * les critéres de recherche pour nos adresses.
 * 
 * Entant donné que c'est un formulaire de recherche :
 * - On désactive la protection CSRF
 * - La method est GET
 * - On désactive le block prefix
 * - On spécifie la data et la empty_data
 */
class AddressSearchType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $criteria = $options['empty_data'];

        $builder
            ->add('user', EntityType::class, [
                'class' => User::class,
                'required' => false,
            ])
            ->add('limit', NumberType::class, [
                'required' => false,
                'empty_data' => (string)$criteria->limit,
            ])
            ->add('page', NumberType::class, [
                'required' => false,
                'empty_data' => (string)$criteria->page,
            ])
            ->add('orderBy', ChoiceType::class, [
                'choices' => [
                    'id' => 'id',
                    'createdAt' => 'createdAt',
                    'updatedAt' => 'updatedAt',
                    'country' => 'country',
                    'street' => 'street',
                    'city' => 'city',
                ],
                'required' => false,
                'empty_data' => $criteria->orderBy,
            ])
            ->add('direction', ChoiceType::class, [
                'choices' => [
                    'DESC' => 'DESC',
                    'ASC' => 'ASC',
                ],
                'required' => false,
                'empty_data' => $criteria->direction,
            ])
            ->add('searchText', TextType::class, [
                'required' => false,
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => AddressSearchCriteria::class,
            'csrf_protection' => false,
            'method' => 'GET',
            'data' => new AddressSearchCriteria(),
            'empty_data' => new AddressSearchCriteria(),
        ]);
    }

    public function getBlockPrefix(): string
    {
        return '';
    }
}
