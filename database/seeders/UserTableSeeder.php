<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
         /* Create Super Admin user */
         User::updateOrCreate(['name' => 'Super Admin'],[
            'role_id'           => 1,
            'name'              => 'Super Admin',
            'email'             => 'admin@gmail.com',
            'password'          => bcrypt('12345678'),
            'status'         => 1,
        ]);
    }
}
