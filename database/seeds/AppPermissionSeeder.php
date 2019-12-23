<?php

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class AppPermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      $permissions = [

        'permission-select-all',

        'parametre-list',

        'role-list',
        'role-create',
        'role-edit',
        'role-delete',

        'user-list',
        'user-create',
        'user-edit',
        'user-delete',

        'affectation-list',
        'affectation-create',
        'affectation-edit',
        'affectation-delete',
        
        'article-list',
        'article-create',
        'article-edit',
        'article-delete',
        'article-affecter',
        //type
        'type_article-list',
        'type_article-create',
        'type_article-edit',
        'type_article-delete',
        //stock
        'stock-list',
        'stock-create',
        'stock-edit',
        'stock-delete',

        //employe
        'employe-list',
        'employe-edit',
        'employe-create',
        'employe-delete',

        //type departement
        'type_departement-list',
        'type_departement-edit',
        'type_departement-create',
        'type_departement-delete',

        //departement
        'departement-list',
        'departement-edit',
        'departement-create',
        'departement-delete',

        //fournisseur
        'fournisseur-list',
        'fournisseur-edit',
        'fournisseur-create',
        'fournisseur-delete',

        //statut
        'statut-list',
        'statut-edit',
        'statut-create',
        'statut-delete',

        //etat_article
        'etat_article-list',
        'etat_article-edit',
        'etat_article-create',
        'etat_article-delete',

        //marque
        'marque-list',
        'marque-edit',
        'marque-create',
        'marque-delete',

        //type_mouvement
        'type_mouvement-list',
        'type_mouvement-edit',
        'type_mouvement-create',
        'type_mouvement-delete',

         //etat_commande
        'etat_commande-list',
        'etat_commande-edit',
        'etat_commande-create',
        'etat_commande-delete',

          //lieu_stock
        'lieu_stock-list',
        'lieu_stock-edit',
        'lieu_stock-create',
        'lieu_stock-delete',

        //commande
        'commande-list',
        'commande-edit',
        'commande-create',
        'commande-delete',
        'commande-traiter',

        ];

        foreach ($permissions as $permission) {
          Permission::create(['name' => $permission]);
        }
    }
}
