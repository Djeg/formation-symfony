<?php

namespace App\Form;

use App\Entity\Address;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

/**
 * Formulaire d'une addresse utilisé un peu partout sur
 * l'application et nottament dans le « ClientType »
 */
class AddressType extends AbstractType
{
    /**
     * Configure les champs du formulaire
     */
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('postCode', TextType::class)
            ->add('city', TextType::class)
            ->add('street', TextType::class)
            ->add('country', TextType::class);
    }

    /**
     * Configure les options du formulaire
     */
    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Address::class,
        ]);
    }
}
