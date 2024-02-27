<?php

namespace App\Controller\Admin;

use App\Entity\Booking;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Config\Action;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateField;
use EasyCorp\Bundle\EasyAdminBundle\Field\FormField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\MoneyField;
use EasyCorp\Bundle\EasyAdminBundle\Field\BooleanField;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class BookingCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Booking::class;
    }

    // Method that configures the actions available for this entry (Show, Edit, Delete)
    public function configureActions(Actions $actions): Actions
    {
        return $actions
            ->add(Crud::PAGE_INDEX, Action::DETAIL);
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            FormField::addTab('Identification')
                ->setIcon('home')->addCssClass('optional')
                ->setHelp('All information about the booking'),
            IdField::new('id')->hideOnForm(),
            TextField::new('number'),
            DateField::new('start_date'),
            DateField::new('end_date'),
            MoneyField::new('amount')
                ->setCurrency('EUR'),
            BooleanField::new('status'),
            DateField::new('created_at'),
            AssociationField::new('client')->hideOnForm(),
            AssociationField::new('classroom'),
        ];
    }
}
