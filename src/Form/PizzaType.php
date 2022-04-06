<?php

namespace App\Form;

use App\Entity\Pizza;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\MoneyType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\UrlType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

/**
 * Voici le formulaire de création et d'édition d'une pizza.
 */
class PizzaType extends AbstractType
{
    /**
     * Configure les champs du formulaire pour une pizza
     */
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name', TextType::class, [
                'label' => 'Nom :',
                'required' => true,
            ])
            ->add('price', MoneyType::class, [
                'label' => 'Prix :',
                'required' => true,
            ])
            ->add('description', TextareaType::class, [
                'label' => 'Déscription :',
                'required' => false,
            ])
            ->add('image', UrlType::class, [
                'label' => 'Image :',
                'required' => false,
            ]);
    }

    /**
     * Configure le formulaire
     */
    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Pizza::class,
        ]);
    }
}
