<?php

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Role;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
       $role_user = Role::where('name', 'user')->first();
       $role_manager  = Role::where('name', 'admin')->first();
       $role_saler = Role::where('name', 'saler')->first();

       $user = new User();
       $user->name = 'User Name';
       $user->email = 'user@example.com';
       $user->password = bcrypt('123456');
       $user->save();
       $user->roles()->attach($role_user);

       $saler = new User();
       $saler->name = 'Saler Name';
       $saler->email = 'saler@example.com';
       $saler->password = bcrypt('123456');
       $saler->save();
       $saler->roles()->attach($role_saler);

       $manager = new User();
       $manager->name = 'Admin Name';
       $manager->email = 'admin@example.com';
       $manager->password = bcrypt('123456');
       $manager->save();
       $manager->roles()->attach($role_manager);
    }
}
