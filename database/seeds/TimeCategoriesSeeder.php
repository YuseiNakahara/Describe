<?php

use Illuminate\Database\Seeder;

class TimeCategoriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('tagcategories')->truncate();
        DB::table('tagcategories')->insert([
            [
                'name' => '総合トップ',
            ],
            [
                'name' => 'テクノロジー',
            ],
            [
                'name' => 'ビジネス',
            ],
            [
                'name' => '政治・経済',
            ],
            [
                'name' => 'スポーツ',
            ]
        ]);
    }
}
