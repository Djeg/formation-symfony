<?php

namespace App\Form;

use App\DTO\Paiment;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

/**
 * Contient le formulaire permettant de passer une commande.
 * Ce formulaire reprend les différents champs de paiment
 * ainsi que l'adresse de l'utilisateur.
 */
class OrderType extends AbstractType
{
    /**
     * Construit les champs du formulaire
     */
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('address', AddressType::class)
            ->add('number', TextType::class, [
                'label' => 'Numéro de carte bleu :',
                'required' => true,
            ])
            ->add('expirationMonth', TextType::class, [
                'label' => 'Mois d\'éxpiration :',
                'required' => true,
            ])
            ->add('expirationYear', TextType::class, [
                'label' => 'Année d\'éxpiration :',
                'required' => true,
            ])
            ->add('cvc', TextType::class, [
                'label' => 'Code CVC :',
                'required' => true,
            ]);
    }

    /**
     * Configure les options du formulaire
     */
    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Paiment::class,
        ]);
    }
}
