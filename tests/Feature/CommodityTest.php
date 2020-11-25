<?php

namespace Tests\Feature;

use App\Commodity;
use App\Shop;
use Tests\TestCase;

class CommodityTest extends TestCase
{
    public function testCanCreateCommodity()
    {
        $shop = factory(Shop::class)->create();
        $shop->save();
        $shop->refresh();

        $user = $shop->user;
        $this->actingAs($user);

        $title = 'test title';

        $response = $this->post(route('commodity.store'), [
            'title' => $title,
        ], [
            'Accept' => 'application/json'
        ]);

        $commodity = Commodity::query()->first();

        $response
            ->assertStatus(200)
            ->assertJson($commodity->toArray());
    }

    public function testCanUpdateCommodity()
    {
        $shop = factory(Shop::class)->create();
        $shop->save();
        $shop->refresh();

        $commodity = factory(Commodity::class)->create();
        $commodity->shop_id = $shop->id;
        $commodity->save();
        $commodity->refresh();

        $this->actingAs($shop->user);

        $response = $this->patch(route('commodity.update', [
            'commodity' => $commodity->id,
        ]), [
            'title' => 'updated',
        ], [
            'Accept' => 'application/json'
        ]);

        $commodity->title = 'updated';

        $response
            ->assertStatus(200)
            ->assertJson($commodity->toArray());
    }

    public function testCanDeleteCommodity()
    {
        $shop = factory(Shop::class)->create();
        $shop->save();
        $shop->refresh();

        $commodity = factory(Commodity::class)->create();
        $commodity->shop_id = $shop->id;
        $commodity->save();
        $commodity->refresh();

        $this->actingAs($shop->user);

        $response = $this->delete(route('commodity.destroy', [
            'commodity' => $commodity->id,
        ]), [], [
            'Accept' => 'application/json'
        ]);

        $response->assertStatus(200);
        $this->assertDeleted('commodities', [
            'title' => $commodity->title,
        ]);
    }

    public function testCannotCreateWhileIsAGuest()
    {
        $response = $this->post(route('commodity.store'), [
            'title' => 'test',
        ], [
            'Accept' => 'application/json'
        ]);

        $response->assertStatus(401);
    }

    public function testCannotUpdateWhileIsAGuest()
    {
        $shop = factory(Shop::class)->create();
        $shop->save();
        $shop->refresh();

        $commodity = factory(Commodity::class)->create();
        $commodity->shop_id = $shop->id;
        $commodity->save();
        $commodity->refresh();

        $response = $this->patch(route('commodity.update', [
            'commodity' => $commodity->id
        ]), [
            'title' => 'test',
        ], [
            'Accept' => 'application/json'
        ]);

        $response->assertStatus(401);
    }

    public function testCannotDestroyWhileIsGuest()
    {
        $shop = factory(Shop::class)->create();
        $shop->save();
        $shop->refresh();

        $commodity = factory(Commodity::class)->create();
        $commodity->shop_id = $shop->id;
        $commodity->save();
        $commodity->refresh();

        $response = $this->delete(route('commodity.destroy', [
            'commodity' => $commodity->id,
        ]), [], [
            'Accept' => 'application/json'
        ]);

        $response->assertStatus(401);
    }
}
