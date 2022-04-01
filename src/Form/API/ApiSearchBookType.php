<?php

namespace App\Form\API;

use App\DTO\BookSearch;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ApiSearchBookType extends AbstractType
{
    /**
     * On déclare une propriété public qui contient
     * une instance du DTO du formulaire.
     * 
     * Cette instance est utilisé afin de récupérer les données
     * par défaut que le formulaire doit posséder.
     * 
     * Example:
     *  Si aucun limit n'est donné au formulaires, et bien
     *  la limite de ce DTO sera utilisé (10)
     */
    public BookSearch $emptyData;

    /**
     * On déclare un constructeur. Dans se constructeur
     * nous assignons à notre propriété public $emptyData
     * une instance du DTO du formulaire.
     */
    public function __construct()
    {
        $this->emptyData = new BookSearch();
    }

    /**
     * On créé les champs du formulaire. Pour le cas d'un formulaire
     * d'api, c'est ici qu'on spécifie tout les filtres (query string)
     * disponible.
     */
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('limit', IntegerType::class, [
                // Pas besoin de label car il n'y a pas de HTML
                // donc pas de visuel.
                'required' => false,
                /**
                 * Ici on spécifie la valeur utilisé si jamais
                 * il n'y a aucune limit dans les filtres (query string).
                 * 
                 * Ici on s'assure que même si je n'ai aucune limit
                 * de préciser, la valeur sera 10.
                 */
                'empty_data' => $this->emptyData->limit,
            ])
            ->add('page', IntegerType::class, [
                'required' => false,
                'empty_data' => $this->emptyData->page,
            ])
            ->add('sortBy', ChoiceType::class, [
                'required' => false,
                'choices' => [
                    'id' => 'id',
                    'title' => 'title',
                    'price' => 'price',
                ],
                'empty_data' => $this->emptyData->sortBy,
            ])
            ->add('direction', ChoiceType::class, [
                'required' => false,
                'choices' => [
                    'ASC' => 'ASC',
                    'DESC' => 'DESC',
                ],
                'empty_data' => $this->emptyData->direction,
            ])
            ->add('title', TextType::class, [
                'required' => false,
            ])
            ->add('authorName', TextType::class, [
                'required' => false,
            ])
            ->add('categoryName', TextType::class, [
                'required' => false,
            ])
            ->add('authorId', TextType::class, [
                'required' => false,
            ])
            ->add('maxPrice', NumberType::class, [
                'required' => false,
            ])
            ->add('minPrice', NumberType::class, [
                'required' => false,
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            /**
             * Ici on spécifie le DTO (Data Transfert Object) ou l'entité
             * que le formulaire doit remplir.
             */
            'data_class' => BookSearch::class,
            /**
             * On spécifie la méthode HTTP que le formulaire supporte.
             * Dans le cas d'un formulaire de recherche la méthode GET est utilisé
             * afin de passer les champs du formulaire dans les query string
             * (les filtres de l'url).
             */
            'method' => 'GET',
            /**
             * Ici on désactive le token de protection CSRF (utilisé
             * pour éviter la duplication malveillante d'un formulaire).
             * 
             * Dans le cas d'un api, les formulaires n'ont pas de HTML, donc
             * il est impossible de le dupliquer, donc pas besoin de token.
             */
            'csrf_protection' => false,
            /**
             * Ici on spécifie les données que le formulaire doit contenir
             * par défaut. Lors de le création du formulaire, que nous ayons
             * spécifié des filtres ou pas, nous aurons toujours ce DTO
             * dans le $form->getData().
             */
            'data' => $this->emptyData,
        ]);
    }

    /**
     * Désactive le préfix dans le cas d'un formulaire d'api.
     * 
     * Cela permet de mettre direction dans l'url le nom du champs
     * sans avoir à spécifier de préfix :).
     * 
     * Example si le préfix n'est pas desactivé :
     *  http://mon-app.com/books?api_search_book[limit]=3
     * 
     * Exemple si le prefix est désactive :
     *  http://mon-app.com/books?limit=3
     */
    public function getBlockPrefix(): string
    {
        return '';
    }
}
