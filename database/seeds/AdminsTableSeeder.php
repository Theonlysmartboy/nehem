<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;
class AdminsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      DB::table('users')->insert([
          'name' => 'Super Admin',
          'email' => 'admin@admin.com',
          'role'=>'0',
          'password' => Hash::make('password'),
          'created_at' => Carbon::now()->toDateTimeString(),
          'updated_at' => Carbon::now()->toDateTimeString(),
      ]);
    }
}
