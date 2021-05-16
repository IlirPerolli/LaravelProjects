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
        DB::table('users')->insert([
            'name'=>str_random(10),
            'role_id'=>2,
            'is_active'=>1,
            'email'=>str_random(10).'@codingfaculty.com',
            'password'=>bcrypt('secret')
        ]);
//       Metoda jeme
        // DB::insert('insert into users (name, role_id, is_active, email, password) values (?, ?, ?, ?, ?)', [str_random(10), 2,1,str_random(10).'@codingfaculty.com',bcrypt('secret')]);
    }
}
