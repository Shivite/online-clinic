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

        $admin = User::create([
          'name'    => 'Admin User',
          'email'   => 'admin@prmedication.com',
          'password'=> Hash::make('password')
        ]);
        // $doctor = User::create([
        //   'name'    => 'Test Doctor1',
        //   'email'   => 'doctor1@prmedication.com',
        //   'password'=> Hash::make('password')
        // ]);
        // $patient = User::create([
        //   'name'    => 'Test Paitent1',
        //   'email'   => 'patient1@prmedication.com',
        //   'password'=> Hash::make('password')
        // ]);

        $admin->roles()->attach($adminRole);
        // $doctor->roles()->attach($doctorRole);
        // $patient->roles()->attach($patientRole);

    }
}
