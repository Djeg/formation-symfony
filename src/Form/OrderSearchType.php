<?php

namespace App\Form;

use App\DTO\OrderSearch;
use App\Entity\Order;
use App\Entity\User;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

/**
 * Permet de rechercher des commandes sur le site
 */
class OrderSearchType extends AbstractType
{
    /**
     * Contient une instance du DTO de se formulaire
     * vide
     */
    public OrderSearch $emptyData;

    public function __construct()
    {
        $this->emptyData = new OrderSearch();
    }

    /**
     * Contient tout les champs de rechercher pour les commandes
     */
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('limit', NumberType::class, [
                'label' => 'Limite :',
                'required' => false,
                'empty_data' => $this->emptyData->limit,
            ])
            ->add('page', NumberType::class, [
                'label' => 'Page :',
                'required' => false,
                'empty_data' => $this->emptyData->page,
            ])
            ->add('sortBy', ChoiceType::class, [
                'label' => 'Trier par :',
                'required' => false,
                'empty_data' => $this->emptyData->sortBy,
                'choices' => [
                    'Date de création' => 'createdAt',
                    'Date de mise à jour' => 'updatedAt',
                    'Identifiant' => 'Id',
                ],
            ])
            ->add('direction', ChoiceType::class, [
                'label' => 'Sens du trie :',
                'required' => false,
                'empty_data' => $this->emptyData->direction,
                'choices' => [
                    'Croissant' => 'ASC',
                    'Décroissant' => 'DESC',
                ],
            ])
            ->add('statuses', ChoiceType::class, [
                'label' => 'Status :',
                'required' => false,
                'multiple' => true,
                'expanded' => true,
                'choices' => [
                    'En cours de préparation' => Order::$STATUS_TODO,
                    'En cours de livraison' => Order::$STATUS_DELIVERING,
                    'Livrée' => Order::$STATUS_DONE,
                    'Annulée' => Order::$STATUS_CANCEL,
                ],
            ])
            ->add('user', EntityType::class, [
                'class' => User::class,
                'choice_label' => 'email',
                'required' => false,
                'multiple' => false,
            ]);
    }

    /**
     * Contient les options du formulaire de recherche. Étant
     * donnée que ce formulaire est un formulaire de recherche
     * nous retrouvons ici la method GET ainsi que la désactivation
     * to token CSRF.
     */
    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => OrderSearch::class,
            'method' => 'GET',
            'csrf_protection' => false,
            'data' => $this->emptyData,
        ]);
    }

    /**
     * Désactive le préfix du formulaire afin d'avoir des
     * url bien plus jolie
     */
    public function getBlockPrefix(): string
    {
        return '';
    }
}
