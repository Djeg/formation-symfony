<?php

namespace App\Form;

use App\Entity\Book;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

/**
 * Contient la configuration du formulaire d'un livre
 */
class BookType extends AbstractType
{
    /**
     * Cofnigure les champs du formulaire d'un livre
     */
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        // On ajoute les champs du formulaire
        $builder
            ->add('title', TextType::class, [
                'label' => 'Titre du livre :',
            ])
            ->add('description', TextareaType::class, [
                'label' => 'Description du livre :'
            ])
            ->add('genre', ChoiceType::class, [
                'label' => 'Genre littéraire :',
                'choices' => [
                    'Science Fiction' => 'science-fiction',
                    'Policier' => 'policier',
                    'Fantastique' => 'fantastique',
                    'Romantique' => 'romantique',
                ]
            ]);

        // Si je suis en mode « Création »
        if ($options['mode'] === 'create') {
            // J'ajoute le bouton d'envoie, mais avec un label différent
            $builder->add('submit', SubmitType::class, [
                'label' => 'Créer le livre',
            ]);
        } else {
            // J'ajoute le bouton d'envoie, avec le label de la mise à jour
            $builder->add('submit', SubmitType::class, [
                'label' => 'Mettre à jour le livre',
            ]);
        }
    }

    /**
     * Configure les options du formulaire de création d'un livre
     */
    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Book::class,
            // On ajout l'option « mode » qui permet de déterminer si je suis
            // sur une création ou une édition
            'mode' => 'create',
        ]);
    }
}
