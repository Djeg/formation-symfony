<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TelType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class RegistrationType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('email', EmailType::class, [
                'label' => 'Votre email :',
                'required' => true,
            ])
            ->add('password', RepeatedType::class, [
                'type' => PasswordType::class,
                'required' => true,
                'first_options' => [
                    'label' => 'Votre mot de passe :',
                ],
                'second_options' => [
                    'label' => 'Répéter votre mot de passe :',
                ]
            ])
            ->add('firstname', TextType::class, [
                'label' => 'Prénom :',
                'required' => true,
            ])
            ->add('lastname', TextType::class, [
                'label' => 'Nom :',
                'required' => true,
            ])
            ->add('phone', TelType::class, [
                'label' => 'Téléphone :',
                'required' => true,
            ])
            ->add('address', AddressType::class, [
                'label' => 'Votre Adresse :',
            ])
            ->add('send', SubmitType::class, [
                'label' => "S'inscrire",
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
