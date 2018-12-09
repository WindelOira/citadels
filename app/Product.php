<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

use Cviebrock\EloquentSluggable\Sluggable;

use Form;

class Product extends Model
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
   * Returns truncated title for the datatables.
   *
   * @return string
   */
  public function laratablesTitle()
  {
    $title = '';
    $title .= $this->title;
    $title .= Form::open([
      'route'   => [
        'admin.products.destroy', $this
      ],
      'method'  => 'DELETE'
    ]);
      $title .= "<ul class=\"list-unstyled m-0 mt-2 d-flex\">";
        $title .= "<li>". link_to_route('admin.products.edit', "Edit", $this, ['class' => 'btn btn-link px-0 py-0 pr-2']) ."</li>";
        $title .= "<li>". Form::bsButton('delete', $this->id, 'submit', ['title' => 'Delete', 'class' => 'btn-link text-danger px-0 py-0 pr-2']) ."</li>";
      $title .= "</ul>";
    $title .= Form::close();

    return $title;
  }

  /**
   * Returns truncated content for the datatables.
   *
   * @return string
   */
  public function laratablesContent()
  {
    return str_limit(base64_decode($this->content), 50);
  }
}
