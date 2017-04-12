<?php

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Role;
use App\Models\Permission;

class UsersTableSeeder extends Seeder
{
  /**
   * Run the database seeds.
   *
   * @return void
   */
  public function run()
  {
    if (User::count()) {
      return;
    }

    $admin = new Role();
    $admin->name = 'admin';
    $admin->display_name = 'role.name.admin';
    $admin->description  = 'Site Administrator';
    $admin->save();
    
    $user = new Role();
    $user->name = 'user';
    $user->display_name = 'role.name.user';
    $user->description  = 'User with access to logged in areas of the site, but not the admin';
    $user->save();
    
    $user = User::create([
      'first_name' => 'Admin',
      'last_name' => 'Account',
      'email' => 'admin@example.com',
      'password' => bcrypt('admin'),
    ]);

    $user->attachRole($admin);
    
    $user = User::create([
      'first_name' => 'User',
      'last_name' => 'Account',
      'email' => 'user@example.com',
      'password' => bcrypt('user'),
    ]);
    $user->attachRole($user);
  }
}
