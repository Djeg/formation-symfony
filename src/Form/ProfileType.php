<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\UrlType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;

class ProfileType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('email', EmailType::class, [
                'label' => 'Email :',
                'required' => true,
            ])
            ->add('imageUrl', UrlType::class, [
                'label' => 'Image URL :',
                'required' => false,
            ])
            ->add('description', TextareaType::class, [
                'label' => 'Description :',
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
            ->add('send', SubmitType::class, [
                'label' => 'Modifier',
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
