<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class MediaMeta extends Model
{
  use SoftDeletes;

  /**
   * The attributes that are mass assignable.
   *
   * @return array
   */
  protected $fillable = ['media_id', 'key', 'value'];

  /**
   * The attributes that should be mutated to dates.
   *
   * @var array
   */
  protected $dates = ['deleted_at'];

  /**
   * Get media for this meta data.
   */
  public function media() {
    return $this->belongsTo('App\Media', 'media_id');
  }
}
