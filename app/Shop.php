<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Shop extends Model
{
    public function addCommodities($commodities)
    {
        foreach ($commodities as $commodity) {
            $this->addCommodity($commodity);
        }
    }

    public function addCommodity(Commodity $commodity)
    {
        $this->commodities()->save($commodity);
    }

    public function commodities()
    {
        return $this->hasMany(Commodity::class, 'shop_id', 'id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
