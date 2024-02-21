<?php

namespace App\Controller\Admin;

use App\Entity\User;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\FormField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\EmailField;
use EasyCorp\Bundle\EasyAdminBundle\Field\BooleanField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IntegerField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\TelephoneField;

class UserCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return User::class;
    }

    
    public function configureFields(string $pageName): iterable
    {
        return [
            FormField::addTab('Identification')
                ->setIcon('user')->addCssClass('optional')
                ->setHelp('All information about the user'),
            IdField::new('id')->hideOnIndex(),
            TextField::new('name'),
            TextField::new('corporate_name'),
            EmailField::new('email'),
            TextField::new('siret'),
            TelephoneField::new('phone')->hideOnIndex(),
            TextField::new('address')->hideOnIndex(),
            TextField::new('city')->hideOnIndex(),
            TextField::new('zip')->hideOnIndex(),
            TextField::new('country')->hideOnIndex(),
            BooleanField::new('consent')->hideOnIndex(),
        ];
    }
    
}
