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
        factory(\Caderneta\Models\User::class, 10)->create();
        factory(\Caderneta\Models\Movimentacoe::class, 10)->create();

        factory(Caderneta\Models\User::class)->create([
            'name' => "Glaicon",
            'email' => "gjpeixer@hotmail.com",
            'password' => bcrypt(123),
            'remember_token' => str_random(10),
            'facebook_id' => 'teste'
        ]);
    }
}
