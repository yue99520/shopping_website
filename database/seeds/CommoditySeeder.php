<?php

use App\Commodity;
use App\Shop;
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
        $shops = Shop::query()->get();
        foreach ($shops as $shop) {
            $commodities = factory(Commodity::class, random_int(5, 15))->create();
            $shop->commodities()->saveMany($commodities);
        }
    }
}
