<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\User;
use App\Role;
class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        User::truncate();

        DB::table('role_user')->truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');



        $adminRole = Role::where('name', 'admin')->first();
        $doctorRole = Role::where('name', 'doctor')->first();
        $patientRole = Role::where('name', 'patient')->first();
        $staffRole = Role::where('name', 'staff')->first();

        $admin = User::create([
          'name'    => 'Admin User',
          'email'   => 'admin@prmedication.com',
          'password'=> Hash::make('password')
        ]);

        $staff1 = User::create([
          'name'    => 'Staff 1',
          'email'   => 'staf1@prmedication.com',
          'password'=> Hash::make('password')
        ]);
        $staff2 = User::create([
          'name'    => 'Staff 2',
          'email'   => 'staf2@prmedication.com',
          'password'=> Hash::make('password')
        ]);
        

        $admin->roles()->attach($adminRole);
        $staff1->roles()->attach($staffRole);
        $staff2->roles()->attach($staffRole);
        
        // $doctor->roles()->attach($doctorRole);
        // $patient->roles()->attach($patientRole);

    }
}