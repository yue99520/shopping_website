<?php

use App\Commodity;
use Illuminate\Database\Seeder;

class CommoditySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $commodities = factory(Commodity::class, 10)->create();
        $shop = \App\Shop::query()->first();
        $shop->commodities()->saveMany($commodities);
    }
}
