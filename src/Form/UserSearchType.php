<?php

namespace App\Form;

use App\DTO\UserSearch;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

/**
 * Contient le formulaire de recherche pour les utilisateurs
 */
class UserSearchType extends AbstractType
{
    /**
     * Contient la données vide de se formulaire
     */
    public UserSearch $emptyData;

    /**
     * Construis ce formulaire avec un utilisateur vide
     * afin de pouvoir récupérer les valeurs par défaut
     */
    public function __construct()
    {
        $this->emptyData = new UserSearch();
    }

    /**
     * Construit les champs de formulaire nescessaire pour
     * rechercher des utilisateurs. Ces champs doivent
     * correspondre aux propriétés du DTO attaché
     * àce formulaire (cf: data_class).
     * 
     * Note: Les boutons ne sont pas présent dans ce formulaire,
     * ils sont rajouté directement dans les templates
     * affichant ces formulaires.
     */
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('limit', IntegerType::class, [
                'label' => 'Limite :',
                'empty_data' => $this->emptyData->limit,
                'required' => false,
            ])
            ->add('page', IntegerType::class, [
                'label' => 'Page :',
                'empty_data' => $this->emptyData->page,
                'required' => false,
            ])
            ->add('sortBy', ChoiceType::class, [
                'label' => 'Trier par :',
                'choices' => [
                    'Identifiant' => 'id',
                    'Email' => 'email',
                    'Date de création' => 'createdAt',
                    'Date de mise jour' => 'updatedAt',
                ],
                'empty_data' => $this->emptyData->sortBy,
                'required' => false,
            ])
            ->add('direction', ChoiceType::class, [
                'label' => 'Sens du trie',
                'choices' => [
                    'Croissant' => 'ASC',
                    'Décroissant' => 'DESC',
                ],
                'empty_data' => $this->emptyData->direction,
                'required' => false,
            ]);
    }

    /**
     * Configure les options du formulaire de rechecher des utilisateurs.
     * Dans ces options nous retrouvons la méthode HTTP GET,
     * le DTO, la désactivation du CSRF et données du formulaires
     * par défaut.
     */
    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => UserSearch::class,
            'method' => 'GET',
            'csrf_protection' => false,
            'data' => $this->emptyData,
        ]);
    }

    /**
     * Désactive le prefix du formulaire afin d'avoir des URL
     * bien plus jolie lors de la recherche
     */
    public function getBlockPrefix(): string
    {
        return '';
    }
}
