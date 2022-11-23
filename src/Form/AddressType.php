<?php

namespace App\Form;

use App\Entity\Address;
use App\Entity\User;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\CountryType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TelType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

/**
 * Contient les champs du formulaire d'une adresse.
 */
class AddressType extends AbstractType
{
    /**
     * Configure les champs du formulaire d'un adresse
     */
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('country', CountryType::class, [
                'label' => 'Pays :',
            ])
            ->add('city', TextType::class, [
                'label' => 'Ville :',
            ])
            ->add('zipCode', TextType::class, [
                'label' => 'Code Postal :',
            ])
            ->add('street', TextType::class, [
                'label' => 'N° et nom de la rue :',
            ])
            ->add('state', TextType::class, [
                'label' => 'Êtat :',
                'required' => false,
            ])
            ->add('phone', TelType::class, [
                'label' => 'Téléphone :',
                'required' => false,
            ])
            ->add('firstname', TextType::class, [
                'label' => 'Prénom :',
                'required' => false,
            ])
            ->add('lastname', TextType::class, [
                'label' => 'Nom :',
                'required' => false,
            ])
            ->add('type', ChoiceType::class, [
                'label' => 'Type :',
                'choices' => [
                    'Livraison' => 'delivery',
                    'Facturation' => 'billing',
                    'Les deux' => 'both',
                    'Aucune' => 'none',
                ]
            ])
            ->add('user', EntityType::class, [
                'label' => 'Utilisateur :',
                'class' => User::class,
                'choice_label' => 'email',
            ])
            ->add('submit', SubmitType::class, [
                'label' => 'Envoyer',
            ]);
    }

    /**
     * Configure les options générale du formulaire d'adresse
     */
    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Address::class,
        ]);
    }
}
