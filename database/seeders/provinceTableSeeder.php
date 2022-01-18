<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class provinceTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $url_province = "https://api.rajaongkir.com/starter/province?key=d8534a79e5aaaf2b50cf311aea7a7c36";
        $json_str  = file_get_contents($url_province);
        $json_obj = json_decode($json_str);
        $provinces = [];

        foreach ($json_obj->rajaongkir->results as $province) {
            $provinces[] = [
                'id' => $province->province_id,
                'provinces' => $province->province
            ];
        }

        DB::table('provinces')->insert($provinces);
    }
}
