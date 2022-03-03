<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Role;
class RoleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        if (Role::where('name', '=', 'Super Admin')->exists() === false) {
            Role::create([
                'id'          => '1',
                'name'        => 'Super Admin',
                'status'   => '1',
                'slug'        => 'super-admin',
                'description' => 'Super Admin Role',
            ]);
        }
        if (Role::where('name', '=', 'Customer')->exists() === false) {
            Role::create([
                'id'          => '2',
                'name'        => 'Customer',
                'status'   => '1',
                'slug'        => 'customer',
                'description' => 'Customer Role',
            ]);
        }

    }
}
