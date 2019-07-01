<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;

class CommentsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('comments')->truncate();
        DB::table('comments')->insert([
            [
                'user_id'     => 1,
                'describe_id' => 1,
                'comment'     => 'コメント',
                'created_at'  => Carbon::create('2019','6','18'),
            ],
            [
                'user_id'     => 1,
                'describe_id' => 1,
                'comment'     => 'コメント',
                'created_at'  => Carbon::create('2019','6','18'),
            ]
        ]);
    }
}
