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

        if (Permission::where('name', '=', 'Delete Users')->first() === null) {
            Permission::create(['name' => 'Delete Users', 'slug' => 'delete.users', 'description' => 'Can Delete Users', 'model' => 'User',]);
        }
        /* permission for User module end */


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

        if (Permission::where('name', '=', 'Delete Roles')->first() === null) {
            Permission::create(['name' => 'Delete Roles', 'slug' => 'delete.roles', 'description' => 'Can Delete Roles', 'model' => 'Role',]);
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

        if (Permission::where('name', '=', 'Delete Category')->first() === null) {
            Permission::create([
                'name' => 'Delete Category',
                'slug' => 'delete.category',
                'description' => 'Can Delete Category',
                'model' => 'Category',
            ]);
        }
        /* permission for Category module end */

        /* permission for Customer Group module start */
        if (Permission::where('name', '=', 'Create Customer Group')->first() === null) {
            Permission::create([
                'name' => 'Create Customer Group',
                'slug' => 'create.customerGroup',
                'description' => 'Can Add Customer Group',
                'model' => 'Customer Group',
            ]);
        }

        if (Permission::where('name', '=', 'View Customer Group')->first() === null) {
            Permission::create([
                'name' => 'View Customer Group',
                'slug' => 'view.customerGroup',
                'description' => 'Can view Customer Group',
                'model' => 'Customer Group'
            ]);
        }

        if (Permission::where('name', '=', 'Edit Customer Group')->first() === null) {
            Permission::create([
                'name' => 'Edit Customer Group',
                'slug' => 'edit.customerGroup',
                'description' => 'Can edit Customer Group',
                'model' => 'Customer Group',
            ]);
        }

        if (Permission::where('name', '=', 'Active/Inactive Customer Group')->first() === null) {
            Permission::create([
                'name' => 'Active/Inactive Customer Group',
                'slug' => 'activeinactive.customerGroup',
                'description' => 'Can Activate or deactivate Customer Group',
                'model' => 'Customer Group',
            ]);
        }

        if (Permission::where('name', '=', 'Delete Customer Group')->first() === null) {
            Permission::create([
                'name' => 'Delete Customer Group',
                'slug' => 'delete.customerGroup',
                'description' => 'Can Delete Customer Group',
                'model' => 'Customer Group',
            ]);
        }
        /* permission for Customer Group module end */
    }
}
