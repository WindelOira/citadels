<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Storage;

use Cviebrock\EloquentSluggable\Sluggable;

use Form;

class Post extends Model
{
  use SoftDeletes;
  use Sluggable;

  /**
   * The attributes that are mass assignable.
   *
   * @return array
   */
  protected $fillable = ['title', 'slug', 'content', 'status'];

  /**
   * The attributes that should be mutated to dates.
   *
   * @var array
   */
  protected $dates = ['deleted_at'];

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

  /**
   * Get all medias for this product.
   */
  public function medias() {
    return $this->morphToMany('App\Media', 'mediaable');
  }

  /**
   * Get the content.
   *
   * @param  string  $value
   * @return string
   */
  public function getContentAttribute($value)
  {
    return base64_decode($value);
  }

  /**
   * Get featured image.
   */
  public function getFeaturedImageAttribute($value) {
    return count($this->medias) ? $this->medias : FALSE;
  }

  /**
   * Returns truncated title for the datatables.
   *
   * @return string
   */
  public function laratablesTitle()
  {
    $title = $this->featured_image ? "<img src=\"". Storage::url($this->featured_image[0]->thumbnail) ."\" class=\"img rounded mr-2\" width=\"50\" height=\"50\"/>" : "";
    $title .= link_to_route('admin.posts.edit', $this->title, $this);
    $title .= Form::open([
      'route'   => [
        'admin.posts.destroy', $this
      ],
      'method'  => 'DELETE'
    ]);
      $title .= "<ul class=\"list-unstyled m-0 mt-2 d-flex\">";
        $title .= "<li>". link_to_route('admin.posts.edit', "Edit", $this, ['class' => 'btn btn-link px-0 py-0 pr-2']) ."</li>";
        $title .= "<li>". Form::bsButton('delete', $this->id, 'submit', ['title' => 'Delete', 'class' => 'btn-link text-danger px-0 py-0 pr-2']) ."</li>";
      $title .= "</ul>";
    $title .= Form::close();

    return $title;
  }
}
