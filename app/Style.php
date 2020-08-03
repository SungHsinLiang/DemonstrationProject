<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Style extends Model
{
  protected $guarded = [];

  public function scopeMenStyles($query)
  {
    return $query->where([
      'gender' => 'men',
    ]);
  }
  public function scopeWomenStyles($query)
  {
    return $query->where([
      'gender' => 'women',
    ]);
  }
}
