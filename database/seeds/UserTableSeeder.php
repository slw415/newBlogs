<?php

use Illuminate\Database\Seeder;


class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\User::insert([
            'name' => 'slw415',
            'email' =>'17858024722@163.com',
            'password' => bcrypt('slw415'),
        ]);

    }
}
