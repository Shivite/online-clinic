<?php

use Illuminate\Database\Seeder;
use App\Department;
Use App\Disease;
class DiseasesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

      Disease::truncate();
      DB::statement('SET FOREIGN_KEY_CHECKS=1;');

      $dep1 = Department::where('name', 'covid-19')->first();
      $dep2 = Department::where('name', 'oncology')->first();
      $dep3 = Department::where('name', 'gastro & proctology')->first();
      $dep4 = Department::where('name', 'patpulmonology & allergyient')->first();
      $dep5 = Department::where('name', 'orthopedic')->first();

      Disease::create([
        'department_id'    => '1',
        'name'    => 'covid-19',
      ]);
     Disease::create([
        'department_id'    => '2',
        'name'    => 'cancer',
      ]);
      Disease::create([
        'department_id'    => '2',
        'name'    => 'cyst',
      ]);Disease::create([
        'department_id'    => '2',
        'name'    => 'tumor',
      ]);Disease::create([
        'department_id'    => '2',
        'name'    => 'abnormal growth',
      ]);Disease::create([
        'department_id'    => '3',
        'name'    => 'pancreatitis',
      ]);Disease::create([
        'department_id'    => '3',
        'name'    => 'constipation',
      ]);Disease::create([
        'department_id'    => '3',
        'name'    => 'ibs (irritable bowel syndrome))',
      ]);Disease::create([
        'department_id'    => '3',
        'name'    => 'piles',
      ]);Disease::create([
        'department_id'    => '3',
        'name'    => 'fistula',
      ]);Disease::create([
        'department_id'    => '4',
        'name'    => 'asthma',
      ]);Disease::create([
        'department_id'    => '4',
        'name'    => 'allergy',
      ]);Disease::create([
        'department_id'    => '5',
        'name'    => 'arthritis',
      ]);Disease::create([
        'department_id'    => '5',
        'name'    => 'osteoarthritis',
      ]);
    }
}
