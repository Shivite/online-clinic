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
        'fee'     =>   600
      ]);
     Department::create([

        'name'    => 'oncology',
        'image'    => 'oncology.png',
        'fee'     =>   2000
      ]);
      Department::create([

        'name'    => 'oncology-alopathy',
        'image'    => 'oncology.png',
        'fee'     =>   2000
      ]);
      
      Department::create([

        'name'    => 'gastro & proctology',
        'image'    => 'gastro-proctology.png',
        'fee'     =>   1000
      ]);Department::create([

        'name'    => 'pulmonology & allergy',
        'image'    => 'pulmonology.png',
        'fee'     =>   1000
      ]);Department::create([

        'name'    => 'orthopedic',
        'image'    => 'cortopedic.png',
        'fee'     =>   1500
      ]);
    }
}