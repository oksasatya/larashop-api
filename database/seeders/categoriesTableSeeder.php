<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Faker\Factory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class categoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categories = [];
        $faker = Factory::create('id_ID');
        $image_categories = [
            'abstract',
            'animals',
            'bussiness',
            'cats',
            'city',
            'food',
            'nature',
            'technics',
            'transport'
        ];

        for ($i = 0; $i < 8; $i++) {
            $name = $faker->unique()->word();
            $name = str_replace('.', '', $name);
            $slug = str_replace(' ', '=', strtolower($name));
            $category = $image_categories[mt_rand(0, 8)];
            // save file to directory
            $image_path = 'public/images/categories';
            $image_fullpath = $faker->image($image_path, 500, 300, $category, true, true, $category);
            $image = str_replace($image_path, '', $image_fullpath);

            $categories[$i] = [
                'name' => $name,
                'slug' => $slug,
                'image' => $image,
                'status' => 'PUBLISH',
                'created_at' => Carbon::now(),
            ];
        }

        DB::table('categories')->insert($categories);
    }
}
