<?php

use Illuminate\Database\Seeder;
use App\User;
class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
          'name'=>'admin',
          'email'=>'admin@admin.com',
          'password'=>bcrypt('admin'),
          'role_id'=>1,
          'active'=>true,
          'remember_token'=> str_random(10)
        ]);
    }
}
