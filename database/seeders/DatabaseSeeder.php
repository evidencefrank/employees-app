<?php

namespace Database\Seeders;

use App\Models\Employee;
use App\Models\Skill;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
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
        // \App\Models\User::factory(10)->create();

        //create 5 employees
        Employee::factory()->count(5)->create()->each(function ($employee) {
            //create 2 skills for each user
            Skill::factory()->count(2)->create([ 'employee_id'=> $employee->id]);
        });
    }
}
