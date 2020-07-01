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
       Department::truncate();
       DB::statement('SET FOREIGN_KEY_CHECKS=1;');


      Department::create([

        'name'    => 'covid-19',
        'image'    => 'corona.webp',
      ]);
     Department::create([

        'name'    => 'oncology',
        'image'    => 'oncology.png',

      ]);
      Department::create([

        'name'    => 'gastro & proctology',
        'image'    => 'gastro-proctology.png',
      ]);Department::create([

        'name'    => 'pulmonology & allergy',
        'image'    => 'pulmonology.png',
      ]);Department::create([

        'name'    => 'corthopedic',
        'image'    => 'cortopedic.png',
      ]);
    }
}
