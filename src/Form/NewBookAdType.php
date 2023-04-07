<?php

namespace App\Form;

use App\Entity\BookAd;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\MoneyType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\UrlType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class NewBookAdType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('title', TextType::class, [
                'label' => 'Titre du livre :',
            ])
            ->add('description', TextareaType::class, [
                'label' => 'Description :',
                'required' => false,
            ])
            ->add('imagesUrl', CollectionType::class, [
                'label' => 'Url des images du livre :',
                'entry_type' => UrlType::class,
                'allow_add' => true,
                'allow_delete' => true,
                'entry_options' => [
                    'label' => 'URL :',
                    'attr' => [
                        'class' => 'entry',
                    ],
                ],
                'attr' => [
                    'class' => 'collection',
                ],
            ])
            ->add('state', ChoiceType::class, [
                'label' => 'État du livre :',
                'choices' => [
                    'Très bon état' => BookAd::STATE_VERY_GOOD,
                    'Bon état' => BookAd::STATE_GOOD,
                    'Usé' => BookAd::STATE_USED,
                    'Très usé' => BookAd::STATE_VERY_USED,
                ],
            ])
            ->add('author', TextType::class, [
                'label' => 'Auteur :',
                'required' => false,
            ])
            ->add('publishingHouse', TextType::class, [
                'label' => 'Maison d\'édition :',
                'required' => false,
            ])
            ->add('price', MoneyType::class, [
                'label' => 'Prix de vente :',
            ])
            ->add('submit', SubmitType::class, [
                'label' => 'Créer l\'annonce',
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => BookAd::class,
        ]);
    }
}
