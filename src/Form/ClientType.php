<?php

namespace App\Form;

use App\Entity\Client;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\TelType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\Options;
use Symfony\Component\OptionsResolver\OptionsResolver;

/**
 * Formulaire de création d'un client. Ce formulaire vient avec 3 mode
 * différents : api, front ou admin
 */
class ClientType extends AbstractType
{
    /**
     * Configure les champs du formulaire
     */
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('email', EmailType::class)
            ->add('password', RepeatedType::class, [
                'type' => PasswordType::class,
            ])
            ->add('phone', TelType::class)
            ->add('firstname', TextType::class)
            ->add('lastname', TextType::class)
            ->add('sexe', ChoiceType::class, [
                'choices' => Client::SEXES,
            ])
            ->add('address', AddressType::class);

        // Ajout du champs "roles" pour le mode admin
        if ('admin' === $options['mode']) {
            $builder->add('roles', ChoiceType::class, [
                'choices' => [
                    'admin' => 'ROLE_ADMIN',
                    'client' => 'ROLE_CLIENT',
                    'api' => 'ROLE_API',
                ],
                'expanded' => true,
                'multiple' => true,
            ]);
        }
    }

    /**
     * Configure les options du formulaire
     */
    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Client::class,
            // Ajout d'un mode : admin, front ou api
            'mode' => 'front',
            // On désactive la protection csrf pour le mode "admin"
            'csrf_protection' => function (Options $options) {
                return $options['mode'] !== 'api';
            },
        ]);
    }

    /**
     * Désactivation du block prefix
     */
    public function getBlockPrefix(): string
    {
        return '';
    }
}
