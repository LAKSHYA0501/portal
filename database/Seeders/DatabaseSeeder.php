<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call(RolesTableSeeder::class);
        $this->call(PermissionsTableSeeder::class);
        $this->call(RoleHasPermissionsTableSeeder::class);
        $this->call(CountriesTableSeeder::class);
        $this->call(BookCategoriesTableSeeder::class);
        $this->call(UsersTableSeeder::class);
        $this->call(HrApplicantsTableSeeder::class);
        $this->call(HrApplicationsSeeder::class);
        $this->call(HrApplicationRoundTableSeeder::class);
        $this->call(HrJobsTableSeeder::class);
    }
}
