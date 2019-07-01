<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->truncate();
        DB::table('users')->insert([
            [
                'name'          => '中原 優成',
                'user_id'       => '123456789',
                'email'          => 'yusei1225y@gmail.com',
                'avatar'        => null,
                'created_at'    => Carbon::create(2019, 6, 18),
            ]
        ]);
    }
}
