<?php

namespace App\Form;

use App\Entity\Address;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class AddressType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('postCode', NumberType::class, [
                'label' => 'Code Postal :',
            ])
            ->add('city', TextType::class, [
                'label' => 'Ville :',
            ])
            ->add('street', TextType::class, [
                'label' => 'Rue :',
            ])
            ->add('number', NumberType::class, [
                'label' => 'Numéro de rue :',
            ])
            ->add('supplement', TextType::class, [
                'label' => 'Complément d\'adresse :',
            ])
            ->add('submit', SubmitType::class, [
                'label' => 'Envoyer',
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Address::class,
            'method' => 'POST',
        ]);
    }
}
