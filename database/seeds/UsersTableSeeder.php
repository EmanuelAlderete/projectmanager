<?php

use Illuminate\Database\Seeder;
use App\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $userRoot = User::create([
            'name' => 'root',
            'email' => 'root@root.com',
            'password' => bcrypt('root123'),
            'gender' => '0',
            'teacher' => '1',
            'registry' => '007'
        ]);

        $userRoot->roles()->sync(['1']);
    }
}
