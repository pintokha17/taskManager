<?php

use Illuminate\Database\Seeder;

class TaskSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('tasks')->insert([
            [
                'name' => 'Create new module Article',
                'description' => 'Module Article: crud, upload image, category(other table)',
                'status' => 'pause',
                'user_id' => '1',
            ],
            [
                'name' => 'New template',
                'description' => 'Template bootstrap 4, layouts, header, footer',
                'status' => 'pause',
                'user_id' => '1',
            ],
            [
                'name' => 'Crud for user',
                'description' => 'edit first name, last name, birthday, sex....',
                'status' => 'pause',
                'user_id' => '1',
            ],
            [
                'name' => 'Role and permission',
                'description' => 'rbac for this project.',
                'status' => 'pause',
                'user_id' => '1',
            ],
            [
                'name' => 'Create pages',
                'description' => 'home, contact(contact form), about',
                'status' => 'pause',
                'user_id' => '1',
            ]
        ]);
    }
}
