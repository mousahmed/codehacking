<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('users')->insert([
            'name' => str_random(10),
            'role_id'=> mt_rand(1, 3),
            'is_active' =>  mt_rand(0, 1),
            'email'=>str_random(10).'@gmail.com',
            'password'=>bcrypt('123456'),

        ]);
    }
}
