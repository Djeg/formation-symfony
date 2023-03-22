<?php

namespace App\Form;

use App\Entity\Book;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\MoneyType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

/**
 * Représente le « cerveau » de notre formulaire. C'est celui qui contient
 * la configuration du formulaire.
 */
class BookType extends AbstractType
{
    /**
     * Cette méthode permet de configurer les champs de notre formulaire. Par exemple
     * si nous avons une champ pour le titre c'est ici qu'il faut le rajouter.
     * 
     * Pour configurer un champs, symfony utilise un objet c'est la FormBuilderInterface.
     * Dans cette objet nous pouvons utiliser la méthode `add` afin d'ajouter des champs.
     * 
     * IMPORTANT : Pour ajouter un champ, il faut que notre `data_class` (notre livre) posséde
     * la donnée.
     * 
     * La méthode `add` accépte 3 paramètres :
     * 1. C'est le nom du champs (doit corespondre à la nom d'une propriété de notre entité)
     * 2. C'est le type du champs (Il en existe un bon paquet : https://symfony.com/doc/current/reference/forms/types.html)
     * 3. Ce sont les options du champs de formulaire
     */
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('title', TextType::class, [
                'label' => 'Titre du livre :',
            ])
            ->add('price', MoneyType::class, [
                'label' => 'Prix du livre :',
            ])
            ->add('description', TextareaType::class, [
                'label' => 'Description du livre :',
            ])
            ->add('genre', ChoiceType::class, [
                'label' => 'Genre du livre :',
                'choices' => [
                    'Fantaisie' => 'fantaisie',
                    'Science Fiction' => 'science-fiction',
                    'Policier' => 'policier',
                    'Autobiographie' => 'autobiograpie',
                    'Roman' => 'roman',
                ]
            ])
            ->add('submit', SubmitType::class, [
                'label' => 'Envoyer'
            ]);
    }

    /**
     * Cette méthode permet de configurer les options de la balise « form »
     * de notre formulaire. 
     * 
     * Par exemple nous pouvons choisir la méthode de notre formulaire.
     * 
     * Cette méthode accépte un paramètre, c'est l'OptionsResolver, cet objet
     * nous permet de choisir les options de notre balise form.
     * 
     * Vous retrouverez toute les options possible juste ici :
     * https://symfony.com/doc/current/reference/forms/types/form.html#field-options
     */
    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Book::class,
            'method' => 'POST',
        ]);
    }
}
