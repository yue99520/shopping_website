<?php

use Illuminate\Database\Seeder;

class FeatureTestSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call(ShopSeeder::class);
        $this->call(CommoditySeeder::class);
    }
}
