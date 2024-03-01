<?php

namespace App\Form;

use App\Entity\User;
use App\Entity\Booking;
use App\Entity\Classroom;
use Symfony\Component\Form\AbstractType;
use App\Entity\Customer; // Importez Customer
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType; 
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\MoneyType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType; // Utilisez ChoiceType pour le choix

class BookingType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('start_date', DateType::class, [
                'label' => 'Date de début de la réservation',
                'widget' => 'single_text',
                'attr' => ['min' => date('d-m-Y')],
            ])
            ->add('end_date', DateType::class, [
                'label' => 'Date de fin de la réservation',
                'widget' => 'single_text',
                'attr' => ['min' => date('d-m-Y')],
            ])
            ->add('customers', IntegerType::class, [
                'label' => 'Nombre de clients',
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
