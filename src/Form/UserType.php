<?php

namespace App\Form;

use App\Entity\User;
use App\Entity\Address;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;

class UserType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('email', EmailType::class, ['label' => 'Email'])
            // ->add('roles',Entity ['multiple' => false, 'expanded' => false])

            ->add('password', PasswordType::class, ['label' => 'Mot de passe'])
            ->add(
                'billingAddress',
                EntityType::class,
                [
                    'label' => 'Adresse de Facturation :',
                    'multiple' => false,
                    'expanded' => false,
                    'class' => Address::class,
                    'required' => false
                ]
            )
            ->add(
                'deliveryAddress',
                EntityType::class,
                [
                    'label' => 'Adresse de livraison :',
                    'multiple' => false,
                    'expanded' => false,
                    'class' => Address::class,
                    'required' => false
                ]
            )
            ->add('name', TextType::class, ['label' => 'Nom'])
            ->add('submit', SubmitType::class, ['label' => 'Envoyer']);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
            'method' => 'POST'
        ]);
    }
}