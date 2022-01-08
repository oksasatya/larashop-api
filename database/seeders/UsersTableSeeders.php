<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Faker\Factory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UsersTableSeeders extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = [];
        $faker = Factory::create('id_ID');
        for ($i = 0; $i < 5; $i++) {
            $avatar_path = 'public/storage/images/users';
            $avatar_fullpath = $faker->image($avatar_path, 200, 250, 'people', true, true, 'people');
            $avatar = str_replace($avatar_path . '/', '', $avatar_fullpath);

            $users[$i] = [
                'name' => $faker->name,
                'email' => $faker->unique()->safeEmail,
                'password' => bcrypt('12345678'),
                'roles' => json_encode(['CUSTOMER']),
                'avatar' => $avatar,
                'status' => 'ACTIVE',
                'created_at' => Carbon::now()
            ];
        }
        DB::table('users')->insert($users);
    }
}
