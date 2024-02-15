<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TelType;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class ClientType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name', TextType::class, [
                'label' => 'Name',
            ])
            ->add('corporate_name', TextType::class, [
                'label' => 'Corporate name',
            ])
            ->add('siret', TextType::class, [
                'label' => 'siret',
                ])
            ->add('phone', TelType::class, [
                'label' => 'Corporate phone',
                ])
            ->add('address', TextType::class, [
                'label' => 'Corporate address',
                ])
            ->add('city', TextType::class, [
                'label' => 'city',
                ])
            ->add('zip', TextType::class, [
                'label' => 'Complete corporate zip ',
                ])
            ->add('country', TextType::class, [
                'label' => 'Country ',
                ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}