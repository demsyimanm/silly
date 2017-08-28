<?php

use Illuminate\Database\Seeder;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	DB::table('role')->insert([
            'nama' 		=> 'admin',
        ]);

        DB::table('admin')->insert([
            'username' 	=> 'admin',
            'password' 	=> bcrypt('admin'),
            'nama'		=> 'Super Admin',
            'role_id'	=> '1'
        ]);
    }
}
