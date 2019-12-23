<?php

use Illuminate\Database\Seeder;
use App\Statut;
use App\TypeAffectation;

class TypeAffectationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
     public function run()
     {
           $this->createNew('Stock', 1, 'Stock');
           $this->createNew('Employe', 0, 'Employe');
           $this->createNew('Departement', 0, 'Departement');
           $this->createNew('Suprime', 0, 'Suprime');
     }

     private function createNew($libelle, $is_default, $tags) {
        TypeAffectation::create(['libelle' => $libelle, 'is_default' => $is_default, 'tags' => $tags,'statut_id' => Statut::default()->first()->id]);
     }
}
