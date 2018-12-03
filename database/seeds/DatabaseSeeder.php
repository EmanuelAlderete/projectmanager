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
        $this->call(PermissionsTableSeeder::class);
        $this->call(RolesTableSeeder::class);
        $this->call(UsersTableSeeder::class);
        $this->call(DegreesTableSeeder::class);
        $this->call(CoursesTableSeeder::class);
        $this->call(InstitutionsTableSeeder::class);
        $this->call(TagsTableSeeder::class);
        $this->call(TypeProjectsTableSeeder::class);
    }
}
