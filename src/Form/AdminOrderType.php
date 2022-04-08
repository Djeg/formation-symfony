<?php

namespace App\Form;

use App\Entity\Order;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

/**
 * Ce formulaire permet à un administrateur de
 * gérer le status d'une commande
 */
class AdminOrderType extends AbstractType
{
    /**
     * Configure les champs du formulaire
     */
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('status', ChoiceType::class, [
                'label' => 'Changer de status :',
                'required' => true,
                'choices' => [
                    'En cours de préparation' => Order::$STATUS_TODO,
                    'En cours de livraison' => Order::$STATUS_DELIVERING,
                    'Livrée' => Order::$STATUS_DONE,
                    'Annulée' => Order::$STATUS_CANCEL,
                ]
            ]);
    }

    /**
     * Configure les options de ce formulaire
     */
    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Order::class,
        ]);
    }
}
