<?php

namespace App\Controller\Admin;

use App\Entity\Vote;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\{IdField, DateField, AssociationField};
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;

class VoteCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Vote::class;
    }

    public function configureCrud(Crud $crud): Crud {
        return $crud->setPageTitle('index', '%entity_as_string% Votes');
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')->hideOnForm(),
            AssociationField::new('user')->setRequired(true),
            DateField::new('date')->setRequired(true)
        ];
    }
}
