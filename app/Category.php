<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

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
  public function sluggable() {
    return [
      'slug' => [
        'source' => 'title'
      ]
    ];
  }

  /**
   * Get media for this category.
   */
  public function medias() {
    return $this->morphToMany('App\Media', 'mediaable');
  }

  /**
   * Get all the products that are assigned to this category.
   */
  public function products() {
    return $this->morphedByMany('App\Product', 'categorizable');
  }

  /**
   * Check if category is a parent.
   *
   * @param int   $id     Parent/Category ID.
   *
   * @return bool
   */
  public function isParent($id = FALSE) {
    $id = $id === FALSE ? $this->id : $id;

    return $this->findOrFail($id)->whereParent(0)->orWhereNull('parent') ? TRUE : FALSE;
  }

  /**
   * Get parent category.
   *
   * @param int   $id     Parent/Category ID.
   *
   * @return object
   */
  public function getParent($id = FALSE) { 
    $id = $id === FALSE ? $this->id : $id;

    return $this->whereId($id)->first();
  }

  /**
   * Check if category has children.
   */
  public function hasChildren($id = FALSE) {
    $id = $id === FALSE ? $this->id : $id;

    return count($this->getChildren()) > 0 ? TRUE : FALSE;
  }

  /**
   * Get children.
   *
   * @param int   $id     Parent/Category ID.
   */
  public function getChildren($id = FALSE) {
    $id = $id === FALSE ? $this->id : $id;

    return $this->whereParent($id)->get();
  }

  /**
   * Get category thumbnail.
   *
   * @return object
   */
  public function getThumbnailAttribute() {
    return $this->medias->first() ? Storage::url($this->medias->first()->thumbnail) : "https://via.placeholder.com/50/949494/FFFFFF?text=Thumbnail";
  }

  /**
   * Returns truncated parent for the datatables.
   *
   * @return string
   */
  public function laratablesParent() {
    $parent = $this->getParent($this->parent);

    return $parent ? $parent->title : 'N/A';
  }

  /**
   * Returns truncated thumbnail for the datatables.
   *
   * @return string
   */
  public function laratablesTitle() {
    return "<img src=\"{$this->thumbnail}\" class=\"mr-2 rounded img-thumbnail table-thumbnail\"/> {$this->title}";
  }

  /**
   * Returns the action column html for datatables.
   *
   * @param \App\Category
   * @return string
   */
  public static function laratablesCustomProductCategoriesAction($category) {
    return view('admin.products.categories.action', compact('category'))->render();
  }
}
