<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use Cviebrock\EloquentSluggable\Sluggable;

class Category extends Model
{
  use Sluggable;

  /**
   * The attributes that are mass assignable.
   *
   * @var array
   */
  protected $fillable = ['parent', 'title', 'slug', 'type'];

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
   * Get all the products that are assigned to this category.
   */
  public function products() {
    return $this->morphedByMany('App\Product', 'categorizable');
  }

  /**
   * Get parent category.
   *
   * @param int   $id     Parent ID.
   *
   * @return collection
   */
  public static function getParent($id) { 
    return self::whereId($id)->first();
  }

  /**
   * Returns truncated parent for the datatables.
   *
   * @return string
   */
  public function laratablesParent()
  {
    $parent = $this->getParent($this->parent);

    return $parent ? $parent->title : 'N/A';
  }

  /**
   * Returns the action column html for datatables.
   *
   * @param \App\Category
   * @return string
   */
  public static function laratablesCustomProductCategoriesAction($category)
  {
      return view('admin.products.categories.action', compact('category'))->render();
  }
}
