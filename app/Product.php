<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $guarded = [];
    
    // public function getGenderAttribute($attribute)
    // {
    //     return [
    //         'men' => 'supermen',
    //     ][$attribute];
    // }
    
    /**
     *  query men product which is available, quentity is greater than 0 and is regardless of style
     */
    public function scopeMenProducts($query)
    {
        return $query->where([
            ['gender', 'men'],
            ['quantity', '>', '0'],
            ['is_sold', '1'],
        ])->inRandomOrder();
    }

    /**
     *  query men product which is available, quantity is greater than 0 and is oxford style.
     */
    public function scopeMenOxfords($query)
    {
        return $query->where([
            ['gender', 'men'],
            ['quantity', '>', '0'],
            ['style', '牛津襯衫'],
            ['is_sold', '1'],
        ]);
    }
}
