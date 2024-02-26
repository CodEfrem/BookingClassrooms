<?php

namespace App\Controller\Admin;

use App\Entity\Classroom;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Config\Action;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;
use EasyCorp\Bundle\EasyAdminBundle\Field\FormField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\MoneyField;
use EasyCorp\Bundle\EasyAdminBundle\Field\BooleanField;
use EasyCorp\Bundle\EasyAdminBundle\Field\CountryField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IntegerField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class ClassroomCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Classroom::class;
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
                ->setHelp('All information about the classroom'),
            IdField::new('id')->hideOnForm(),
            TextField::new('name'),
            TextEditorField::new('description'),
            TextField::new('address'),
            TextField::new('city'),
            TextField::new('zip'),
            CountryField::new('country'),
            IntegerField::new('gauge'),
            TextField::new('floor'),
            BooleanField::new('parking'),
            MoneyField::new('price')
            ->setCurrency('EUR'),
            BooleanField::new('status'),
            AssociationField::new('equipments'),
            ImageField::new('image')
            ->setBasePath('uploads/')
            ->setUploadDir('public/uploads/'),
        ];
    }
    
}
