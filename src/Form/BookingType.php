<?php

namespace App\Form;

use App\Entity\User;
use App\Entity\Booking;
use App\Entity\Classroom;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\MoneyType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType; // Utilisez ChoiceType pour le choix
use Symfony\Bridge\Doctrine\Form\Type\EntityType; 

class BookingType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('user', EntityType::class, [
                'class' => User::class,
                'choice_label' => 'name', 
                'label' => 'Nom de l\'utilisateur',
                'disabled' => true, 
            ])
            ->add('customers', ChoiceType::class, [
                'label' => 'Nombre de clients',
                'choices' => $this->getNumberChoices(0, 30), 
            ])
            ->add('start_date', DateType::class, [
                'label' => 'Date de début',
                'widget' => 'single_text',
                'attr' => ['min' => date('Y-m-d')],
            ])
            ->add('end_date', DateType::class, [
                'label' => 'Date de fin',
                'widget' => 'single_text',
                'attr' => ['min' => date('Y-m-d')],
            ])
            ->add('number', TextType::class, [
                'label' => 'Numéro de téléphone',
            ])
            ->add('amount', MoneyType::class, [
                'label' => 'Montant de la réservation ',
                'currency' => 'EUR',
                'scale' => 2,
                'disabled' => true, 
            ])
            ->add('classroom', EntityType::class, [ 
                'class' => Classroom::class,
                'choice_label' => 'name', 
                'label' => 'Salle de classe',
                'disabled' => true, 
            ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Booking::class,
        ]);
    }
    
    private function getNumberChoices($min, $max) {
        $choices = [];
        for ($i = $min; $i <= $max; $i++) {
            $choices[$i] = $i;
        }
        return $choices;
    }
}
