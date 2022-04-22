<?php

namespace App\Form;

use App\Entity\Order;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TelType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class OrderType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('city', TextType::class, [
                'label' => 'Ville : ',
            ])
            ->add('zipCode', TextType::class, [
                'label' => 'Code postale : ',
            ])
            ->add('street', TextType::class, [
                'label' => 'N° de voie : ',
            ])
            ->add('supplement', TextareaType::class, [
                'label' => 'Complément : ',
                'required' => false,
            ])
            ->add('phone', TelType::class, [
                'label' => 'Téléphone : ',
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Order::class,
        ]);
    }
}
