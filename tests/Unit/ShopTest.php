<?php

namespace Tests\Unit;

use App\Commodity;
use App\Shop;
use Tests\TestCase;

class ShopTest extends TestCase
{
    public function testShopHasCommodities()
    {
        $shop = factory(Shop::class)->create();
        $commodities = factory(Commodity::class, 10)->create();
        $shop->addCommodities($commodities);
        $shop->save();

        $shop = Shop::query()->first();
//        dd($shop->commodities);
        $this->assertCount(10, $shop->commodities);
    }

    public function testShopBelongsToUser()
    {
        $shop = factory(Shop::class)->create();
        $shop->save();

        $shop = Shop::query()->first();
        $this->assertNotNull($shop->user->id);
    }
}
