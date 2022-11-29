<?php

namespace App\Form;

use App\Entity\Address;
use App\Entity\User;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\CountryType;
use Symfony\Component\Form\Extension\Core\Type\TelType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

/**
 * Configure le formulaire d'api de création et de mise à jour des adresses.
 * 
 * Ce formulaire est un formulaire d'API :
 * - on désactive la protection CSRF
 * - on désactive le block prefix
 */
class ApiAddressType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        // On doit attacher et configurer chaques champs de notre formulaire :
        // https://symfony.com/doc/current/reference/forms/types.html
        $builder
            ->add('country', CountryType::class)
            ->add('zipCode', TextType::class)
            ->add('street', TextType::class)
            ->add('city', TextType::class)
            ->add('state', TextType::class, [
                'required' => false,
            ])
            ->add('phone', TelType::class, [
                'required' => false,
            ])
            ->add('firstname', TextType::class, [
                'required' => false,
            ])
            ->add('lastname', TextType::class, [
                'required' => false,
            ])
            ->add('type', ChoiceType::class, [
                'choices' => [
                    'Livraison' => 'delivery',
                    'Facturation' => 'billing',
                    'Les deux' => 'both',
                    'Aucune' => 'none',
                ]
            ])
            ->add('user', EntityType::class, [
                'class' => User::class,
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Address::class,
            'csrf_protection' => false,
        ]);
    }

    public function getBlockPrefix(): string
    {
        return '';
    }
}
