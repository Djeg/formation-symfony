<?php

namespace App\Form;

use App\Entity\Offer;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\MoneyType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

/**
 * Formulaire de création d'une offre
 */
class OfferType extends AbstractType
{
    /**
     * Configure les champs du formulaire
     */
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('price', MoneyType::class)
            ->add('message', TextareaType::class, [
                'required' => false,
            ])
            ->add('cash', ChoiceType::class, [
                'required' => true,
                'choices' => [
                    'Oui' => true,
                    'Non' => false,
                ],
            ]);
    }

    /**
     * Configure les options du formulaire
     */
    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Offer::class,
        ]);
    }
}
