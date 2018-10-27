<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

use Cviebrock\EloquentSluggable\Sluggable;

use Carbon\Carbon;

class Media extends Model
{
  use SoftDeletes;
  use Sluggable;

  /**
   * The attributes that are mass assignable.
   *
   * @return array
   */
  protected $fillable = ['title', 'slug', 'ext', 'mime_type'];

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
   * Get all categories for this media.
   */
  public function categories() {
    return $this->morphedByMany('App\Category', 'mediaable');
  }

  /**
   * Get media file.
   *
   * @return string
   */
  public function getMediaFileAttribute() {
    return "{$this->slug}.{$this->ext}";
  }

  /**
   * Generate upload location.
   *
   * @return string
   */
  public function generateUploadLocation() {
    $dt = Carbon::parse($this->created_at);

    return "public/uploads/{$dt->year}/{$dt->month}";
  }
}
