<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\TelType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

/**
 * Permet de créer et mettre à jour un utilisateur.
 */
class UserType extends AbstractType
{
    /**
     * Construit les champs du formulaire.
     * 
     * Note : Ce formulaire utilise une option "admin" permettant
     * d'éditer ou non le role de l'utilisateur.
     * 
     * Note : Il n'y a pas de bouton submit dans ce formulaire,
     * ce dernier est ajouté diréctement dans les templates
     * twig.
     */
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('lastname', TextType::class, [
                'label' => 'Votre nom :',
                'required' => true,
            ])
            ->add('firstname', TextType::class, [
                'label' => 'Votre prénom :',
                'required' => true,
            ])
            ->add('email', EmailType::class, [
                'label' => 'Email :',
                'required' => true,
            ]);

        if ($options['admin']) {
            $builder->add('role', ChoiceType::class, [
                'label' => 'Role :',
                'required' => true,
                'choices' => [
                    'Utilisateur' => 'ROLE_USER',
                    'Administrateur' => 'ROLE_ADMIN',
                ],
            ]);
        }

        $builder
            ->add('password', RepeatedType::class, [
                'type' => PasswordType::class,
                'required' => $options['mode'] === 'create',
                'first_options' => [
                    'label' => 'Mot de passe :',
                ],
                'second_options' => [
                    'label' => 'Répétez le mot de passe :',
                ],
                'mapped' => $options['mode'] === 'create',
            ])
            ->add('phone', TelType::class, [
                'label' => 'Téléphone :',
                'required' => true,
            ])
            ->add('address', AddressType::class);
    }

    /**
     * Configure les options de se formulaire.
     * 
     * Note : Ici on ajoute une option "admin" permettant
     * d'éditer ou non le role de l'utilisateur.
     */
    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
            'admin' => false,
            'mode' => 'create',
        ]);

        $resolver->setAllowedTypes('admin', 'boolean');
        $resolver->setAllowedValues('mode', ['create', 'update']);
    }
}
