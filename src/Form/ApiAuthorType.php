<?php

namespace App\Form;

use App\Entity\Author;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;

/**
 * Formulaire d'api pour un auteur
 */
class ApiAuthorType extends AbstractType
{
    /**
     * Les formulaires fonctionne de la même manière que les formulaires classique,
     * cependant, il n'y a pas besoin de spécifier des labels ou un bouton
     * de soumissions (car il n'y pas de HTML, de visuel).
     */
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('title', TextType::class)
            ->add('description', TextareaType::class)
            ->add('nationality', ChoiceType::class, [
                'choices' => [
                    'fr' => 'fr',
                    'en' => 'en',
                    'de' => 'de',
                    'es' => 'es',
                ],
                // Voici les contraintes de validation, il en existe
                // un bon paquet permettant de valider notre données
                // Ici par exemple, nous utilisons `NotBlank`
                // Vous les retrouverez sur le documentation de symfony :
                // https://symfony.com/doc/current/reference/constraints.html
                "constraints" => [
                    new NotBlank(),
                ]
            ]);
    }

    /**
     * Au niveau des options, il suffit tout simplement de désactiver la protection
     * CSRF pour en faire un formulaire d'api
     */
    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Author::class,
            'csrf_protection' => false,
        ]);
    }

    /**
     * Il est fortement conseillé de supprimer le prefix
     */
    public function getBlockPrefix()
    {
        return '';
    }
}
