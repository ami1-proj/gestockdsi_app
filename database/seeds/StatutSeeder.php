<?php

use Illuminate\Database\Seeder;
use App\Statut;

class StatutSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->createNew('Actif', 1);
        $this->createNew('Inactif', 0);
    }

    private function createNew($libelle, $is_default) {
        Statut::create(['libelle' => $libelle, 'is_default' => $is_default]);
    }
}
