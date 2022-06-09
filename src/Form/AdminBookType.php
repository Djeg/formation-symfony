<?php

namespace App\Form;

use App\Entity\Author;
use App\Entity\Book;
use App\Entity\Category;
use App\Entity\PublishingHouse;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\MoneyType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\UrlType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class AdminBookType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('title', TextType::class, [
                'label' => 'Titre du livre :',
                'required' => true,
            ])
            ->add('price', MoneyType::class, [
                'label' => 'Prix du livre :',
                'required' => true,
            ])
            ->add('description', TextareaType::class, [
                'label' => 'Description du livre :',
                'required' => false,
            ])
            ->add('imageUrl', UrlType::class, [
                'label' => "URL de l'image du livre :",
                'required' => false,
            ])
            ->add('author', EntityType::class, [
                'label' => "Choix de l'auteur :",
                // Spécifie l'entité que l'on veut pouvoir séléctioner
                'class' => Author::class,
                // Spécifie la propriété de la class Author que l'on veut afficher
                // ici: author.name
                'choice_label' => 'name',
                'required' => false,
            ])
            ->add('categories', EntityType::class, [
                'label' => "Choix des catégories :",
                'class' => Category::class,
                'choice_label' => 'name',
                'multiple' => true,
                // false === select box
                // true === checkbox
                'expanded' => true,
            ])
            ->add('publishingHouse', EntityType::class, [
                'label' => "Choix de la maison d'édition :",
                'class' => PublishingHouse::class,
                'required' => false,
                'choice_label' => 'name',
                'multiple' => false,
                // false === select box
                // true === checkbox
                'expanded' => false,
            ])
            ->add('send', SubmitType::class, [
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
