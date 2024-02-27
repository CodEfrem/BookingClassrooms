<?php

namespace App\Form;

use App\Entity\User;
use App\Entity\Booking;
use App\Entity\Classroom;
use App\Entity\Customer; // Importez Customer
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType; 
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\MoneyType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType; // Utilisez ChoiceType pour le choix

class BookingType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('user', EntityType::class, [
                'class' => User::class,
                'choice_label' => 'name', 
                'label' => 'Nom de l\'utilisateur ',
                'disabled' => true, 
            ])
            ->add('customers', EntityType::class, [ // Changez ChoiceType à EntityType
                'class' => Customer::class, // Spécifiez la classe Customer
                'choice_label' => 'id', // Changez cela selon vos besoins
                'label' => 'Clients', // Changez cela selon vos besoins
                'multiple' => true, // Permettre la sélection multiple si nécessaire
            ])
            ->add('start_date', DateType::class, [
                'label' => 'Date de début de la réservation ',
                'widget' => 'single_text',
                'attr' => ['min' => date('Y-m-d')],
            ])
            ->add('end_date', DateType::class, [
                'label' => 'Date de fin de la réservation ',
                'widget' => 'single_text',
                'attr' => ['min' => date('Y-m-d')],
            ])
            ->add('number', TextType::class, [
                'label' => 'Numéro de téléphone  ',
            ])
            ->add('amount', MoneyType::class, [
                'label' => 'Montant de la réservation ',
                'currency' => 'EUR',
                'disabled' => true,  
            ])
            ->add('classroom', EntityType::class, [ 
                'class' => Classroom::class,
                'choice_label' => 'name ', 
                'label' => 'Salle n° ',
                'disabled' => true, 
            ])
            ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Booking::class,
        ]);
    }
}
