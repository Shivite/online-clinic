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
       DB::statement('SET FOREIGN_KEY_CHECKS=0;');
       Disease::truncate();
       DB::table('department_disease')->truncate();
       DB::statement('SET FOREIGN_KEY_CHECKS=1;');


       $dept1 = Department::where('name', 'covid-19')->first();
       $dept2 = Department::where('name', 'oncology')->first();
       $dept3 = Department::where('name', 'gastro & proctology')->first();
       $dept4 = Department::where('name', 'pulmonology & allergy')->first();
       $dept5 = Department::where('name', 'orthopedic')->first();


       $dept1rec1 = Disease::create([
         'name'    => 'covid-19',
       ]);
       $dept2rec1 = Disease::create([
         'name'    => 'cyst',
       ]);
       $dept2rec2 = Disease::create([
         'name'    => 'tumor',
       ]);
       $dept2rec3 = Disease::create([
         'name'    => 'abnormal growth',
       ]);
       $dept2rec4 = Disease::create([
         'name'    => 'cancer',
       ]);
       $dept3rec1 = Disease::create([
         'name'    => 'pancreatitis',
       ]);
       $dept3rec2 = Disease::create([
         'name'    => 'constipation',
       ]);
       $dept3rec3 = Disease::create([
         'name'    => 'ibs',
       ]);
       $dept3rec4 = Disease::create([
         'name'    => 'piles',
       ]);
       $dept3rec5 = Disease::create([
         'name'    => 'fistula',
       ]);
       $dept4rec1 = Disease::create([
         'name'    => 'asthma',
       ]);
       $dept4rec2 = Disease::create([
         'name'    => 'allergy',
       ]);
       $dept5rec1= Disease::create([
         'name'    => 'arthritis',
       ]);
       $dept5rec2 = Disease::create([
         'name'    => 'osteoarthritis',
       ]);

       $dept1->diseases()->attach($dept1rec1);

       $dept2->diseases()->attach($dept2rec1);
       $dept2->diseases()->attach($dept2rec2);
       $dept2->diseases()->attach($dept2rec3);
       $dept2->diseases()->attach($dept2rec4);


       $dept3->diseases()->attach($dept3rec1);
       $dept3->diseases()->attach($dept3rec2);
       $dept3->diseases()->attach($dept3rec3);
       $dept3->diseases()->attach($dept3rec4);
       $dept3->diseases()->attach($dept3rec5);


       $dept4->diseases()->attach($dept4rec1);
       $dept4->diseases()->attach($dept4rec2);

       $dept5->diseases()->attach($dept5rec1);
       $dept5->diseases()->attach($dept5rec2);


       // DB::statement('SET FOREIGN_KEY_CHECKS=0;');
       // Disease::truncate();
       // Department::truncate();
       // DB::statement('SET FOREIGN_KEY_CHECKS=1;');
       //
       // Department::create([ 'name' => 'covid-19' ]);
       // Department::create([ 'name' => 'oncology' ]);
       // Department::create([ 'name' => 'gastro & proctology' ]);
       // Department::create([ 'name' => 'pulmonology & allergy' ]);
       // Department::create([ 'name' => 'orthopedic' ]);
     }

}