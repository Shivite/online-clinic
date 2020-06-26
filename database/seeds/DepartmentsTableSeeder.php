<?php

use Illuminate\Database\Seeder;
use App\Department;
use App\Disease;
class DepartmentsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      DB::statement('SET FOREIGN_KEY_CHECKS=0;');
      Disease::truncate();
      Department::truncate();
      DB::statement('SET FOREIGN_KEY_CHECKS=1;');

      Department::create([ 'name' => 'covid-19' ]);
      Department::create([ 'name' => 'oncology' ]);
      Department::create([ 'name' => 'gastro & proctology' ]);
      Department::create([ 'name' => 'pulmonology & allergy' ]);
      Department::create([ 'name' => 'orthopedic' ]);
    }
}
