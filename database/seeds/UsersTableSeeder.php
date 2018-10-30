<?php

use Illuminate\Database\Seeder;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

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
    $admin->guard_name = 'web';
    $admin->save();
    
    $user = new Role();
    $user->name = 'user';
    $user->guard_name = 'web';
    $user->save();
    
    $user = User::create([
      'first_name' => 'Admin',
      'last_name' => 'Account',
      'email' => 'admin@example.com',
      'password' => bcrypt('admin'),
    ]);

    $user->assignRole('admin');
    
    $user = User::create([
      'first_name' => 'User',
      'last_name' => 'Account',
      'email' => 'user@example.com',
      'password' => bcrypt('user'),
    ]);
    $user->assignRole('user');
  }
}
