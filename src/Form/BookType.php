<?php

namespace App\Form;

use App\Entity\Book;
use App\Entity\Category;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\MoneyType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class BookType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('title', TextType::class, ["label" => "Nom du livre : "])
            ->add('price', MoneyType::class, ["label" => "Nom du livre : "])
            ->add('images', TextType::class, ["label" => "Couvertures du livre : "])
            ->add('description', TextType::class, ["label" => "Description du livre : "])
            ->add('publicationDate', DateType::class, ["label" => "Date de publication du livre : "])
            ->add('ESBN', NumberType::class, ["label" => "N° ESBN : "])
            ->add('pageNumber', NumberType::class, ["label" => "Nombre de pages : "])
            ->add('language', TextType::class, ["label" => "Langue : "])
            ->add('formatType', TextType::class, ["label" => "Format du livre : "])
            // ->add(
            //     'categories',
            //     EntityType::class,
            //     [
            //         'class' => Category::class,
            //         'label' => 'Catégories du livre :',
            //         'multiple' => true,
            //         'expanded' => true
            //     ]
            // )
            //  ->add('authors')
            //  ->add('publishers')
            ->add(
                'submit',
                SubmitType::class,
                ['label' => 'Envoyer']
            );
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Book::class,
            'method' => 'POST'
        ]);
    }
}