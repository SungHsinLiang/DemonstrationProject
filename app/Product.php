<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
  protected $guarded = [];

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
   *  query men product which is available, quentity is greater than 0 and is regardless of style
   */
  public function scopeWomenProducts($query)
  {
    return $query->where([
      ['gender', 'women'],
      ['quantity', '>', '0'],
      ['is_sold', '1'],
    ])->inRandomOrder();
  }
}
