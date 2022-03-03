<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Permission;

class PermissionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        /* permission for Role module start */
        if (Permission::where('name', '=', 'Create Roles')->first() === null) {
            Permission::create(['name' => 'Create Roles', 'slug' => 'create.roles', 'description' => 'Can Add roles', 'model' => 'Role',]);
        }

        if (Permission::where('name', '=', 'View Roles')->first() === null) {
            Permission::create(['name' => 'View Roles', 'slug' => 'view.roles', 'description' => 'Can view roles', 'model' => 'Role',]);
        }

        if (Permission::where('name', '=', 'Edit Roles')->first() === null) {
            Permission::create(['name' => 'Edit Roles', 'slug' => 'edit.roles', 'description' => 'Can edit roles', 'model' => 'Role',]);
        }

        if (Permission::where('name', '=', 'Active/Inactive Roles')->first() === null) {
            Permission::create(['name' => 'Active/Inactive Roles', 'slug' => 'activeinactive.roles', 'description' => 'Can Activate or deactivate roles', 'model' => 'Role',]);
        }
        /* permission for Role module end */

        /* permission for User module start */
        if (Permission::where('name', '=', 'Create Users')->first() === null) {
            Permission::create(['name' => 'Create Users', 'slug' => 'create.users', 'description' => 'Can Add Users', 'model' => 'User',]);
        }

        if (Permission::where('name', '=', 'View Users')->first() === null) {
            Permission::create(['name' => 'View Users', 'slug' => 'view.users', 'description' => 'Can view Users', 'model' => 'User',]);
        }

        if (Permission::where('name', '=', 'Edit Users')->first() === null) {
            Permission::create(['name' => 'Edit Users', 'slug' => 'edit.users', 'description' => 'Can edit Users', 'model' => 'User',]);
        }

        if (Permission::where('name', '=', 'Active/Inactive Users')->first() === null) {
            Permission::create(['name' => 'Active/Inactive Users', 'slug' => 'activeinactive.users', 'description' => 'Can Activate or deactivate Users', 'model' => 'User',]);
        }
        /* permission for Role module end */

        /* permission for Category module start */
        if (Permission::where('name', '=', 'Create Category')->first() === null) {
            Permission::create([
                'name' => 'Create Category',
                'slug' => 'create.category',
                'description' => 'Can Add Category',
                'model' => 'Category',
            ]);
        }

        if (Permission::where('name', '=', 'View Category')->first() === null) {
            Permission::create([
                'name' => 'View Category',
                'slug' => 'view.category',
                'description' => 'Can view Category',
                'model' => 'Category'
            ]);
        }

        if (Permission::where('name', '=', 'Edit Category')->first() === null) {
            Permission::create([
                'name' => 'Edit Category',
                'slug' => 'edit.category',
                'description' => 'Can edit Category',
                'model' => 'Category',
            ]);
        }

        if (Permission::where('name', '=', 'Active/Inactive Category')->first() === null) {
            Permission::create([
                'name' => 'Active/Inactive Category',
                'slug' => 'activeinactive.category',
                'description' => 'Can Activate or deactivate Category',
                'model' => 'Category',
            ]);
        }
        /* permission for Category module end */
    }
}
