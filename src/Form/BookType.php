<?php

namespace App\Form;

use App\Entity\Author;
use App\Entity\Book;
use App\Entity\Category;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\MoneyType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class BookType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('title', TextType::class, [
                'label' => 'Titre du livre :',
            ])
            ->add('description', TextareaType::class, [
                'label' => 'Description du livre :',
            ])
            ->add('price', MoneyType::class, [
                'label' => 'Prix du livre :',
            ])
            // Ajout d'un champ pour séléctionner l'auteur du livre
            ->add('author', EntityType::class, [
                'label' => 'Auteur du livre :',
                // Specifier la class qui correspond à l'auteur
                'class' => Author::class,
                // Specifier la propriété dans la class auteur
                // qui sera affiché à l'écran
                'choice_label' => 'name',
                // Définie si l'on peut séléctioner plusieurs auteur
                // ou non
                'multiple' => false,
                // Définie le "widget" utilisé pour l'affichage:
                // si false alors une select box sera utilisé
                // si true alors des checkboxes (ou radio box) seront utilisé
                'expanded' => false,
            ])
            ->add('categories', EntityType::class, [
                'label' => 'Catégories du livre :',
                'class' => Category::class,
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
            'data_class' => Book::class,
        ]);
    }
}
