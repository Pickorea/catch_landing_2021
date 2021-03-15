<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Spatie\Permission\PermissionRegistrar;
use App\User;

class PermissionsSeeder extends Seeder
{
    /**
     * Create the initial roles and permissions.
     *
     * @return void
     */
    public function run()
    {
        // Reset cached roles and permissions
        app()[PermissionRegistrar::class]->forgetCachedPermissions();

        // create permissions
        Permission::create(['name' => 'landing.create']);
        Permission::create(['name' => 'landing.edit']);
        Permission::create(['name' => 'landing.show']);
        Permission::create(['name' => 'landing.delete']);

        // create roles and assign existing permissions
        $role1 = Role::create(['name' => 'writer']);
        $role1->givePermissionTo('landing.edit');
        $role1->givePermissionTo('landing.delete');

        $role2 = Role::create(['name' => 'admin']);
        $role2->givePermissionTo('landing.create');
        $role2->givePermissionTo('landing.edit');
        $role2->givePermissionTo('landing.delete');

        $role3 = Role::create(['name' => 'super-admin']);
       

        // create demo users
        $user = \App\Models\User::factory()->create([
            'name' => 'Tarabeia',
            'email' => 'tarabeiat@fisheries.gov.ki',
            'password' => bcrypt('tarabeia@2o21')
        ]);
        $user->assignRole($role1);

        $user = \App\Models\User::factory()->create([
            'name' => 'Administrator',
            'email' => 'kairaoii@fisheries.gov.ki',
            'password' => bcrypt('administrator@2o21')
        ]);
        $user->assignRole($role2);

    }
}