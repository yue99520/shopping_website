<?php

namespace Tests\Unit;

use App\Commodity;
use App\Shop;
use Tests\TestCase;

class ShopModuleTest extends TestCase
{
    public function testShopHasCommodities()
    {
        $shop = factory(Shop::class)->create();
        $commodities = factory(Commodity::class, 10)->create();
        $shop->addCommodities($commodities);
        $shop->save();

        $shop = Shop::query()->first();
        $this->assertCount(10, $shop->commodities);

        $commodities = $shop->commodities;
        foreach ($commodities as $commodity) {
            $this->assertEquals($shop->id, $commodity->shop->id);
        }
    }

    public function testShopBelongsToUser()
    {
        $shop = factory(Shop::class)->create();
        $shop->save();

        $shop = Shop::query()->first();
        $user = $shop->user;
        $this->assertNotNull($user->id);
        $this->assertEquals($shop->id, $user->shop->id);
    }
}
