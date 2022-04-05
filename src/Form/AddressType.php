<?php

namespace App\Form;

use App\Entity\Address;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

/**
 * Permet d'éditer, créer une adresse.
 */
class AddressType extends AbstractType
{
    /**
     * Voici une liste non exhaustive de pays
     */
    public static array $countries = [
        'France',
        'Angleterre',
        'Espagne',
        'Italie',
        'Maroc',
        'Algèrie',
        'Pays-Bas',
        'Allemagne',
        'Suisse',
        'Autriche',
        'Serbie',
        'Croatie',
        'Grece',
    ];

    /**
     * Cette méthode construit les champs du formulaire.
     * 
     * Note : Le bouton de soumission de ce formulaire se trouve
     * actuellement dans les templates twig afin de faciliter
     * le design de l'application.
     */
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('country', ChoiceType::class, [
                'label' => 'Pays :',
                'required' => true,
                'choices' => array_reduce(self::$countries, function ($acc, $country) {
                    return array_merge($acc, [$country => $country]);
                }, []),
            ])
            ->add('city', TextType::class, [
                'label' => 'Ville :',
                'required' => true,
            ])
            ->add('zipCode', TextType::class, [
                'label' => 'Code Postale :',
                'required' => true,
            ])
            ->add('street', TextType::class, [
                'label' => 'Nom et n° de voie :',
                'required' => true,
            ])
            ->add('supplement', TextareaType::class, [
                'label' => 'Complément :',
                'required' => false,
            ]);
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
