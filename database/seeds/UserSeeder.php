<?php

use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(\App\User::class)->create([
            'name' => 'test',
            'email' => 'lianghsintw@gmail.com',
            'password' => '$2y$10$ahCLTs5WHJH3/T35aBH10ugWy7vHNdtdkHbqdwiEFMzHAuJEoBe8O', // password = 123
        ]);
        
        factory(\App\User::class)->create([
            'name' => 'admin',
            'email' => 'sunghsinliang@gmail.com',
            'password' => '$2y$10$ahCLTs5WHJH3/T35aBH10ugWy7vHNdtdkHbqdwiEFMzHAuJEoBe8O', // password = 123
        ]);
    }
}
