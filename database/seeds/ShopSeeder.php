<?php

use App\Shop;
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
        $shops = factory(Shop::class, 3)->create();
        foreach ($shops as $shop) {
            $shop->save();
        }
        $shop = factory(Shop::class)->create();
        $shop->user_id = 1;
        $shop->save();
    }
}
