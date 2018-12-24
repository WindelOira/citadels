<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

use Cviebrock\EloquentSluggable\Sluggable;

use Form;

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
   * Get all the post that are assigned to this category.
   */
  public function posts() {
    return $this->morphedByMany('App\Post', 'categorizable');
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
   * Returns truncated id for the datatables.
   *
   * @return string
   */
  public function laratablesId() {
    return "<div class=\"custom-control custom-checkbox w-100 h-100\">
              <input type=\"checkbox\" class=\"custom-control-input\" id=\"category-". str_slug($this->id) ."__checkbox\" value=\"". $this->id ."\">
              <label class=\"custom-control-label w-100 h-100\" for=\"category-". str_slug($this->id) ."__checkbox\"></label>
            </div>";
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
   * Returns the custom product title column html for datatables.
   *
   * @param \App\Category
   * @return string
   */
  public static function laratablesCustomPostCategoryTitle($category) {
    $title = "<img src=\"". $category->thumbnail ."\" class=\"mr-2 rounded img-thumbnail table-thumbnail\"/> ";
    $title .= $category->title;
    $title .= Form::open([
      'route'   => [
        'admin.posts.categories.destroy', $category
      ],
      'method'  => 'DELETE'
    ]);
      $title .= "<ul class=\"list-unstyled m-0 mt-2 d-flex\">";
        $title .= "<li>". link_to_route('admin.posts.categories.edit', "Edit", $category, ['class' => 'btn btn-link px-0 py-0 pr-2']) ."</li>";
        $title .= "<li>". Form::bsButton('delete', $category->id, 'submit', ['title' => 'Delete', 'class' => 'btn-link text-danger px-0 py-0 pr-2']) ."</li>";
      $title .= "</ul>";
    $title .= Form::close();
    
    return $title;
  }

  /**
   * Returns the custom product title column html for datatables.
   *
   * @param \App\Category
   * @return string
   */
  public static function laratablesCustomProductTitle($category) {
    $title = "<img src=\"". $category->thumbnail ."\" class=\"mr-2 rounded img-thumbnail table-thumbnail\"/> ";
    $title .= $category->title;
    $title .= Form::open([
      'route'   => [
        'admin.products.categories.destroy', $category
      ],
      'method'  => 'DELETE'
    ]);
      $title .= "<ul class=\"list-unstyled m-0 mt-2 d-flex\">";
        $title .= "<li>". link_to_route('admin.products.categories.edit', "Edit", $category, ['class' => 'btn btn-link px-0 py-0 pr-2']) ."</li>";
        $title .= "<li>". Form::bsButton('delete', $category->id, 'submit', ['title' => 'Delete', 'class' => 'btn-link text-danger px-0 py-0 pr-2']) ."</li>";
      $title .= "</ul>";
    $title .= Form::close();
    
    return $title;
  }
}
