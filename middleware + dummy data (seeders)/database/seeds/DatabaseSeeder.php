<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {

        //funksioni factory i merr 2 parametra, t parin e merr ku eshte file qe deshirojme te ekzekutojme dhe i dyti se sa here deshirojme te ekzekutojme
        factory(App\User::class, 10)->create();
        //$this->call(UsersTableSeeder::class);
    }
}
