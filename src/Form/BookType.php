<?php

namespace App\Form;

use App\Entity\Author;
use App\Entity\Book;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\MoneyType;
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
            ->add('createdAt', DateTimeType::class, [
                'label' => 'Date de création :',
            ])
            ->add('updatedAt', DateTimeType::class, [
                'label' => 'Date de mise à jour :',
            ])
            ->add('author', EntityType::class, [
                'label' => 'Auteur :',
                'class' => Author::class,
                'choice_label' => 'name',
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Book::class,
        ]);
    }
}
