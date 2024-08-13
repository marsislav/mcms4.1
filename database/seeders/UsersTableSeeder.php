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
        $user = App\User::create([
            'name' => 'admin',
            'email' => 'example@example.com',
            'password' => bcrypt('password'),
            'admin' => 1
        ]);

        App\Profile::create([
            'user_id' => $user->id,
            'avatar' => 'uploads/avatars/1.png',
            'about' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Accusantium, est veniam non corporis sunt quas voluptates eveniet perferendis repudiandae, voluptate natus optio eius reiciendis, placeat velit nemo molestiae fugiat fuga.',
            'facebook' => 'https://facebook.com',
            'youtube' => 'https://youtube.com'
        ]);

    }
}
