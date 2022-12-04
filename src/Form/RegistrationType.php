<?php

namespace App\Form;

use App\Entity\Account;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Email;
use Symfony\Component\Validator\Constraints\NotBlank;

/**
 * Formulaire d'inscription permettant la création d'un compte sur notre application.
 *
 * Ce « FormType » contient la configuration compléte d'un formulaire d'inscription,
 * il a été généré en utilisant la console symfony :
 *
 * symfony console make:form registration
 *
 * Durant la génération du formulaire, une question vous sera posé. Vous devrez
 * spécifier la « data_class » de votre formulaire (l'objet que le formulaire est
 * responsable de remplir).
 *
 * Vous retrouverez dans ce form type 2 méthodes obligatoire et une méthode facultative :
 * - La méthode buildForm : Son rôle est de congfigurer
 *   tout les champs de notre formulaire
 * - Le méthode configureOptions : Son rôle est de définir les options 
 *   de notre formulaire lui-même (non de ses champs)
 * - La méthode getPrefix (optionel) : Retourne le préfix du formulaire
 */
class RegistrationType extends AbstractType
{
    /**
     * Cette méthode est responsable de la configuration des champs de notre formulaire.
     * Nous utilisont le FormBuilderInterface afin d'ajouter des champs à notre
     * formulaire.
     *
     * Il est aussi possible de recevoir des options définie dans la méthode suivante :
     * configureOptions.
     */
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        // Nous utilisons le builder afin d'ajouter un champ
        $builder
            // Ici nous ajoutons le champ « email ».
            //
            // Le Premier paramètre doit correspondre au nom de la propriété de notre data_class.
            // En effet, si une faute de frappe se glisse dans le nom du champs
            // Symfony est en uncapicité de vous remplire l'objet data_class !
            //
            // Le second paramètre correspond au type de champs. Il en éxiste tout
            // plein : https://symfony.com/doc/current/reference/forms/types.html
            //
            // Le dernier paramètre est un tableau d'options nous permettant de personnaliser
            // le champ
            ->add('email', EmailType::class, [
                'label' => 'Votre email :',
                // Il est possible de rajouter des contraintes de validation
                // diréctement dans un champ de formulaire :
                'constraints' => [
                    new NotBlank(),
                    new Email(),
                ]
            ])
            // Ici nous ajoutons le champ « password ».
            ->add('password', RepeatedType::class, [
                'type' => PasswordType::class,
                'first_options' => [
                    'label' => 'Votre mot de passe :',
                ],
                'second_options' => [
                    'label' => 'Répéter votre mot de passe :',
                ]
            ])
            // Ici nous ajoutons un bouton de soumission « submit ».
            ->add('submit', SubmitType::class, [
                'label' => 'Créer son compte',
            ]);
    }

    /**
     * Cette méthode configure les options générale de notre formulaire.
     *
     * Il recoit un « OptionsResolver », c'est un objet sumfony très pratique
     * pour gérer des tableaux d'options complexe !
     *
     * Vous pouver consulter la documentation de cette « OptionsResolver » :
     * https://symfony.com/doc/current/components/options_resolver.html
     */
    public function configureOptions(OptionsResolver $resolver): void
    {
        // Nous ajoutons des options par défaut :
        $resolver->setDefaults([
            // Ici nous attachons l'objet php que le formulaire doit remplir.
            // Le rôle principale d'un formulaire est de faire le lien entre
            // un formulaire HTML et une class PHP !
            //
            // Ici, ce formulaire remplira la class App\Entity\Account
            'data_class' => Account::class,
            // Nous pouvons aussi définir la méthode HTTP utilisé pour l'envoie :
            'method' => 'POST',
            // Vous pouvez aussi ajouter vos propres options !
            // Vous retrouverez la liste des options disponible ici :
            // https://symfony.com/doc/current/reference/forms/types/form.html
        ]);
    }
}
