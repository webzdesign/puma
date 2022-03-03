<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use jeremykenedy\LaravelRoles\Models\Permission;
use jeremykenedy\LaravelRoles\Models\Role;
use App\Models\User;

class ConnectRelationshipsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        /* Find Role User And Permission */
        $adminRole = Role::where('name', '=', 'Super Admin')->first();
        $adminUser = User::find(1);
        $permissions = Permission::whereIn('slug', ['view.users','create.users','edit,users','activeinactive.users','view.roles','create.roles','edit.roles','activeinactive.roles','view.category','create.category','edit.category','activeinactive.category'])->get();

        /* attach Super admin Role */
        $adminUser->attachRole($adminRole);

        /* attach All Permissions */
        foreach ($permissions as $permission) {
            $adminRole->attachPermission($permission);
        }


        /* super admin role sync permission */
        $adminRole = Role::find(1);
        $adminUser = User::find(1);

        $permissionsAdmin = Permission::whereIn('slug', ['view.users', 'edit.users', 'create.users', 'activeinactive.users', 'view.roles', 'create.roles', 'edit.roles', 'activeinactive.roles', 'create.client', 'view.client', 'edit.client', 'activeinactive.client', 'create.store', 'view.store', 'edit.store', 'activeinactive.store', 'manage.store', 'view.category', 'create.category', 'edit.category', 'activeinactive.category'])->get();

        /* attach Super admin Role */
        $adminUser->attachRole($adminRole);
        /* attach All Permissions */
        foreach ($permissionsAdmin as $permission) {
            $adminRole->attachPermission($permission);
        }

    }
}
