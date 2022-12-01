<?php

namespace App\Form;

use App\Entity\Account;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Email;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\Regex;

/**
 * Créé et met à jour des comptes sur l'api
 */
class ApiAccountType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('email', EmailType::class, [
                // On spécifie des contraintes
                'constraints' => [
                    new Email(),
                    new NotBlank(),
                    new Length(['min' => 5]),
                ]
            ])
            ->add('password', PasswordType::class, [
                // On spécifie des contraintes
                'constraints' => [
                    new Length([
                        'min' => 8
                    ]),
                    new Regex('/[a-z]+/'),
                    new Regex('/[A-Z]+/'),
                    new Regex('/[0-9]+/'),
                    new Regex('/(\*|\+|\$|%|\?|!|-|@|#|&)+/'),
                ]
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Account::class,
            'csrf_protection' => false,
        ]);
    }

    public function getBlockPrefix(): string
    {
        return '';
    }
}
