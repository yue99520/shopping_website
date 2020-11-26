<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class ShopSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $now = Carbon::now();
        DB::table('shops')->insert([
            'title' => 'Official Shop 1',
            'user_id' => 1,
            'created_at' => $now,
            'updated_at' => $now,
        ]);

        DB::table('shops')->insert([
            'title' => 'Official Shop 2',
            'user_id' => 1,
            'created_at' => $now,
            'updated_at' => $now,
        ]);

        DB::table('shops')->insert([
            'title' => 'Official Shop 3',
            'user_id' => 1,
            'created_at' => $now,
            'updated_at' => $now,
        ]);
    }
}
