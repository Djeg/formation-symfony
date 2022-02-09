<?php

namespace App\Form;

use App\Entity\Dish;
use App\Entity\Ingredient;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\UrlType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\MoneyType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;

class DishType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name', TextType::class, [
                'label' => 'Nom :',
            ])
            ->add('description', TextareaType::class, [
                'label' => 'Description :',
            ])
            ->add('image', UrlType::class, [
                'label' => 'Image :',
            ])
            ->add('price', MoneyType::class, [
                'label' => 'Prix :',
            ])
            ->add('type', TextType::class, [
                'label' => 'Type de plat :',
            ])
            ->add('ingredients', EntityType::class, [
                'label' => 'Ingredients :',
                'class' => Ingredient::class,
                'choice_label' => 'name',
                'multiple' => true,
                'expanded' => true,
            ])
            ->add('submit', SubmitType::class, [
                'label' => 'Envoyer',
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Dish::class, // DTO 
            'method' => 'POST',
        ]);
    }
}
