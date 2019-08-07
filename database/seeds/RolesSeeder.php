<?php

use Illuminate\Database\Seeder;
use App\Models\Role;

class RolesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
   public function run()
   {
       $role_employee = new Role();
       $role_employee->name = 'user';
       $role_employee->description = 'A Employee User';
       $role_employee->save();

       $role_employee = new Role();
       $role_employee->name = 'saler';
       $role_employee->description = 'A Saler User';
       $role_employee->save();

       $role_manager = new Role();
       $role_manager->name = 'admin';
       $role_manager->description = 'A Admin User';
       $role_manager->save();
   }
}
