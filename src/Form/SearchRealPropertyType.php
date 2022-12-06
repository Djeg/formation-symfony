<?php

namespace App\Form;

use App\DTO\RealPropertySearchCriteria;
use App\Entity\RealProperty;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

/**
 * Formulaire de recherche pour les bien immobiliers !
 */
class SearchRealPropertyType extends AbstractType
{
    /**
     * Configure les champs du formulaire de recherche
     */
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        /**
         * @var RealPropertySearchCriteria
         */
        $criteria = $options['empty_data'];

        $builder
            ->add('page', NumberType::class, [
                'required' => false,
                'empty_data' => (int)$criteria->page,
            ])
            ->add('limit', NumberType::class, [
                'required' => false,
                'empty_data' => (int)$criteria->limit,
            ])
            ->add('orderBy', ChoiceType::class, [
                'required' => false,
                'empty_data' => $criteria->orderBy,
                'choices' => $criteria::getOrderByChoices(),
            ])
            ->add('direction', ChoiceType::class, [
                'required' => false,
                'empty_data' => $criteria->direction,
                'choices' => $criteria::getDirectionChoices(),
            ])
            ->add('type', ChoiceType::class, [
                'required' => false,
                'choices' => RealProperty::TYPES,
            ])
            ->add('minTotalArea', NumberType::class, [
                'required' => false,
            ])
            ->add('maxTotalArea', NumberType::class, [
                'required' => false,
            ])
            ->add('minPrice', NumberType::class, [
                'required' => false,
            ])
            ->add('maxPrice', NumberType::class, [
                'required' => false,
            ])
            ->add('minRooms', NumberType::class, [
                'required' => false,
            ])
            ->add('maxRooms', NumberType::class, [
                'required' => false,
            ])
            ->add('address', TextType::class, [
                'required' => false,
            ]);
    }

    /**
     * Configure les options du formulaire de recherche
     */
    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => RealPropertySearchCriteria::class,
            'method' => 'GET',
            'empty_data' => new RealPropertySearchCriteria(),
            'data' => new RealPropertySearchCriteria(),
            'csrf_protection' => false,
        ]);
    }

    public function getBlockPrefix(): string
    {
        return '';
    }
}
