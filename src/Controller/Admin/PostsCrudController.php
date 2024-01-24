<?php

namespace App\Controller\Admin;

use App\Entity\Posts;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Form\Type\TextEditorType;

class PostsCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Posts::class;
    }

    
    public function configureFields(string $pageName): iterable
    {
        return [
            TextField::new('titre'),
            TextEditorField::new('description')
                ->setNumOfRows(30),
                //->hideOnIndex(),
            AssociationField::new('fk_user')
                ->setFormTypeOption('choice_label', 'fullname')
                ->setLabel('rédigé par')
                ->setRequired($pageName === Crud::PAGE_NEW),
            AssociationField::new('fk_tags')
                ->setFormTypeOption('choice_label', 'name')
                ->setLabel('tag'),
            DateField::new('date_create')
                ->setLabel('Date de rédaction')
                ->setRequired($pageName === Crud::PAGE_NEW),
        ];
    }
    
}
