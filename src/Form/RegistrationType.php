<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\TelType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class RegistrationType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('email', EmailType::class, [
                'label' => 'Email :',
            ])
            ->add('firstname', TextType::class, [
                'label' => 'Prénom :',
            ])
            ->add('lastname', TextType::class, [
                'label' => 'Nom :',
            ])
            ->add('password', RepeatedType::class, [
                'type' => PasswordType::class,
                'first_options' => [
                    'label' => 'Mot de passe :',
                ],
                'second_options' => [
                    'label' => 'Répétez votre mot de passe :',
                ]
            ])
            ->add('phone', TelType::class, [
                'label' => 'Téléphone :',
            ])
            ->add('city', TextType::class, [
                'label' => 'Ville :',
            ])
            ->add('zipCode', TextType::class, [
                'label' => 'Code postale :',
            ])
            ->add('street', TextType::class, [
                'label' => 'N° de voie :',
            ])
            ->add('supplement', TextareaType::class, [
                'label' => 'Complément :',
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
