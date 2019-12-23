<?php

use Illuminate\Database\Seeder;
use App\User;

use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class CreateAdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = User::create([
        	'name' => 'rootdev',
        	'email' => 'rootdev@gestockdsi.com',
        	'password' => bcrypt('Gestock@Pw0rd')
        ]);

        $role = Role::create([
          'name' => 'Admin',
          'description' => 'Administrateur Principal du Système',
        ]);

        $permissions = Permission::pluck('id','id')->all();

        $role->syncPermissions($permissions);

        $user->assignRole([$role->id]);
    }

}
