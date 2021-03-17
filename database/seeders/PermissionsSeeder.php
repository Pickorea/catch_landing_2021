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
        Permission::create(['name' => 'landing.view']);
        Permission::create(['name' => 'landing.delete']);

        Role::create([  'name' => 'landing.user']);
        Role::create([  'name' => 'landing.viewer']);

        $role_viewer = Role::query()->where('name', '=', 'landing.viewer')->first();
        if (isset($role_viewer)) {
            $role_viewer->givePermissionTo('landing.view');
        }

        $role_user = Role::query()->where('name', '=', 'landing.user')->first();
        if (isset($role_user)) {
            $role_user->givePermissionTo('landing.view');
            $role_user->givePermissionTo('landing.create');
            $role_user->givePermissionTo('landing.edit');
            $role_user->givePermissionTo('landing.delete');
        }

         // create demo users
        $user = \App\Models\User::factory()->create([
            'name' => 'Tarabeia',
            'email' => 'tarabeiat@fisheries.gov.ki',
            'password' => bcrypt('tarabeia@2o21')
        ]);
        $user->assignRole($role_viewer);

        $user = \App\Models\User::factory()->create([
            'name' => 'Administrator',
            'email' => 'kairaoii@fisheries.gov.ki',
            'password' => bcrypt('administrator@2o21')
        ]);
        $user->assignRole($role_user);

    }
}