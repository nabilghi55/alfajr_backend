<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MarketingNumberSeeder extends Seeder
{
    public function run()
    {
        $data = [];

        for ($i = 1; $i <= 16; $i++) {
            $data[] = [
                'name' => "Marketing Number $i",
                'phone_number' => "0812345678" . str_pad($i, 2, '0', STR_PAD_LEFT),
                'duration_hours' => 45,
                'rotation_order' => $i,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }

        DB::table('marketing_numbers')->insert($data);
    }
}
