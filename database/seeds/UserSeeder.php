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
        DB::table('users')->insert([
            [
                'login' => 'Create new module Article',
                'password' => '1111',
                'status' => 'pause',
                'user_id' => '1',
            ],

        ]);
    }
}
