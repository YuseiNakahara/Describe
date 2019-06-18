<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;

class DescribesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('describes')->truncate();
        DB::table('describes')->insert([
            [
                'id'                => 1,
                'user_id'           => 1,
                'time_category_id'  => 1,
                'title'             => 'アウトプット',
                'content'           => 'ポートフォリオ作成',
                'created_at'  => Carbon::create('2019','6','18'),
            ],
            [
                'id'                => 2,
                'user_id'           => 2,
                'time_category_id'  => 2,
                'title'             => 'アウトプット',
                'content'           => 'ポートフォリオ作成',
                'created_at'  => Carbon::create('2019','6','18'),
            ]
        ]);
    }
}