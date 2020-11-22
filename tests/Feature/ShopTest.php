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

        $title = 'My test shop name';
        $response = $this->post(route('shop.store'), [
            'title' => $title,
        ]);

        $shop = Shop::query()->where('title', $title)->first();
        $response
            ->assertStatus(200)
            ->assertJson($shop->toArray());

        $response = $this->post(route('shop.store'), [
            'title' => $title . ' - 2',
        ]);
        $response
            ->assertStatus(200)
            ->assertJson([
                'msg' => 'Your shop has been created before.',
            ]);
    }
}
