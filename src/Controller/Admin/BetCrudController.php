<?php

namespace App\Controller\Admin;

use App\Entity\Bet;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;

class BetCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Bet::class;
    }

    public function configureCrud(Crud $crud): Crud {
        return $crud
            ->setPageTitle('index', '%entity_as_string% Paris')
            ->setPageTitle('new', '%entity_as_string% Nouveau pari')
            ->setPageTitle('detail', fn (Bet $bet) => (string) $bet)
            ->setPageTitle('edit', fn (Bet $bet) => sprintf('Modification <b>%s</b>', $bet->getName()))

        ;
    }

    /*
    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id'),
            TextField::new('title'),
            TextEditorField::new('description'),
        ];
    }
    */
}
