<?php

namespace Tests\Feature;

use App\Shop;
use App\User;
use Tests\TestCase;

class ShopTest extends TestCase
{
    public function testCanCreateShop()
    {
        $user = factory(User::class)->create();
        $user->save();
        $this->actingAs($user);
        $this->assertDatabaseHas('users', $user->toArray());

        $title = 'My test shop name 123';
        $description = 'some description thing';
        $response = $this->post(route('shop.store'), [
            'title' => $title,
            'description' => $description,
        ]);

        $shop = Shop::query()->where('title', $title)->first();
        $response
            ->assertStatus(200)
            ->assertJson($shop->toArray());
    }

    public function testErrorResourceAlreadyExistWhileCreating()
    {
        $shop = factory(Shop::class)->create();
        $shop->save();
        $shop->refresh();
        $user = $shop->user;
        $this->actingAs($user);

        $title = 'abcd1234';
        $description = 'some description thing';
        $response = $this->post(route('shop.store'), [
            'title' => $title,
            'description' => $description,
        ]);
        $response->assertStatus(400);
        $this->assertEquals('Resource already exists.', $response->getContent());
    }

    public function testCanUpdateShop()
    {
        $shop = factory(Shop::class)->create();
        $shop->save();
        $shop->refresh();
        $user = $shop->user;
        $this->actingAs($user);

        $old_title = $shop->title;
        $response = $this->patch(route('shop.update', [
            'shop' => $shop->id
        ]), [
            'title' => $old_title . 'withTest123'
        ]);

        $shop = Shop::query()->find($shop->id);

        $response
            ->assertStatus(200)
            ->assertJson($shop->toArray());
        $this->assertEquals($old_title . 'withTest123', $shop->title);
    }

    public function testErrorResourceNotFoundWhileUpdating()
    {
        $user = factory(User::class)->create();
        $this->actingAs($user);

        $response = $this->patch(route('shop.update', [
            'shop' => 100000
        ]), [
            'title' => 'abcd1234'
        ]);

        $response->assertStatus(400);
        $this->assertEquals('Resource not found', $response->getContent());
    }

    public function testCanDestroyShop()
    {
        $shop = factory(Shop::class)->create();
        $shop->save();
        $shop->refresh();
        $user = $shop->user;
        $this->actingAs($user);

        $shop_id = $shop->id;

        $this->assertNotNull(Shop::query()->find($shop_id));
        $response = $this->delete(route('shop.destroy', [
            'shop' => $shop->id
        ]));
        $this->assertNull(Shop::query()->find($shop_id));

        $response
            ->assertStatus(200)
            ->assertJson([
            'msg' => 'ok'
        ]);
    }

    public function testErrorResourceNotFoundWhileDestroying()
    {
        $user = factory(User::class)->create();
        $this->actingAs($user);

        $response = $this->delete(route('shop.destroy', [
            'shop' => 10000
        ]));
        $response->assertStatus(400);
        $this->assertEquals('Resource not found', $response->getContent());
    }

    public function testErrorResourceNotFoundWhileShowing()
    {
        $user = factory(User::class)->create();
        $this->actingAs($user);

        $response = $this->get(route('shop.show', [
            'shop' => 100000,
        ]));
        $response->assertStatus(400);
        $this->assertEquals('Resource not found', $response->getContent());
    }

    public function testCannotUpdateWhileIsAGuest()
    {
        $shop = factory(Shop::class)->create();
        $shop->save();

        $response = $this->patch(route('shop.update', [
            'shop' => $shop->id
        ]), [
            'title' => 'updated'
        ], [
            'Accept' => 'application/json'
        ]);
        $response->assertStatus(401);
    }

    public function testCannotDestroyWhileIsAGuest()
    {
        $shop = factory(Shop::class)->create();
        $shop->save();

        $response = $this->patch(route('shop.destroy', [
            'shop' => $shop->id
        ]), [], [
            'Accept' => 'application/json'
        ]);

        $response->assertStatus(401);
    }

    public function testCannotStoreWhileIsAGuest()
    {
        $response = $this->post(route('shop.store'), [
            'title' => 'test'
        ], [
            'Accept' => 'application/json'
        ]);

        $response->assertStatus(401);
    }
}
