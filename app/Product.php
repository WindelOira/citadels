<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

use Cviebrock\EloquentSluggable\Sluggable;

class Product extends Model
{
  use SoftDeletes;
  use Sluggable;

  /**
   * The attributes that are mass assignable.
   *
   * @return array
   */
  protected $fillable = ['title', 'slug'];

  /**
   * Return the sluggable configuration array for this model.
   *
   * @return array
   */
  public function sluggable()
  {
    return [
      'slug' => [
        'source' => 'title'
      ]
    ];
  }

  /**
   * Get all categories for this product.
   */
  public function categories() {
    return $this->morphMany('App\Category', 'categorizable');
  }
}
