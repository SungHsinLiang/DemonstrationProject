<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
  protected $guarded = [];

  public function scopeMenCategories($query)
  {
    return $query->where([
      'gender' => 'men',
    ]);
  }
  public function scopeWomenCategories($query)
  {
    return $query->where([
      'gender' => 'women',
    ]);
  }
}
