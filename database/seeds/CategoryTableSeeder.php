<?php

use Illuminate\Database\Seeder;

class CategoryTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::table('categories')->insert([
            [
                'name' => 'hobby'
             ],
            [
                'name' => 'news'
            ],
            [
                'name' => 'cook'
            ],
        ]);
    }
}
