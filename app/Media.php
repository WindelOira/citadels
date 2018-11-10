<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Storage;

use Cviebrock\EloquentSluggable\Sluggable;

use Carbon\Carbon;

use HumanReadableFile;
use Form;

class Media extends Model
{
  use SoftDeletes;
  use Sluggable;

  /**
   * The attributes that are mass assignable.
   *
   * @return array
   */
  protected $fillable = ['title', 'slug', 'ext'];

  /**
   * The attributes that should be mutated to dates.
   *
   * @var array
   */
  protected $dates = ['deleted_at'];

  /**
   * The "booting" method of the model.
   *
   * @return void
   */
  protected static function boot() {
      parent::boot();

      self::deleting(function($model) { 
        $model->metas()->delete();
      });
  }

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
   * Get meta data for this media.
   */
  public function metas() {
    return $this->hasMany('App\MediaMeta', 'media_id');
  }

  /**
   * Get all categories for this media.
   */
  public function categories() {
    return $this->morphedByMany('App\Category', 'mediaable');
  }

  /**
   * Add meta.
   *
   * @param mixed     $key 
   * @param mixed     $value
   *
   * @return bool
   */
  public function addMeta($key, $value = FALSE) {
    if( is_array($key) ) :
      $metas = [];

      foreach( $key as $k => $v ) :
        $metas[] = [
          'key'     => $k,
          'value'   => $v
        ];
      endforeach;

      return $this->metas()->createMany(array_values($metas));
    else :
      return $this->metas()->create([
        'key'       => $key,
        'value'     => $value
      ]);
    endif;
  }

  /**
   * Get meta data.
   *
   * @param string      $key
   *
   * @return string
   */
  public function getMeta($key) { 
    return $this->metas()->where('key', $key)->first()->value;
  }

  /**
   * Get media file.
   *
   * @return string
   */
  public function getMediaFileAttribute() {
    $media_file = $this->whereId($this->id)->first();

    return "{$media_file->title}.{$media_file->ext}";
  }

  /**
   * Get category thumbnail.
   *
   * @return object
   */
  public function getThumbnailAttribute() {
    $dt = Carbon::parse(
                  $this->whereId($this->id)
                      ->first()
                      ->created_at
                      ->format('Y-m-d H:i:s'));

    return "public/uploads/{$dt->year}/{$dt->month}/{$this->media_file}";
  }

  /**
   * Generate upload location.
   *
   * @return string
   */
  public function generateUploadLocation() {
    $dt = Carbon::now();

    return "public/uploads/{$dt->year}/{$dt->month}";
  }

  /**
   * Returns truncated id for the datatables.
   *
   * @return string
   */
  public function laratablesId()
  {
    return "<div class=\"custom-control custom-checkbox w-auto\">
              <input type=\"checkbox\" class=\"custom-control-input\" id=\"". str_slug($this->title) ."__checkbox\" value=\"". $this->id ."\">
              <label class=\"custom-control-label\" for=\"". str_slug($this->title) ."__checkbox\"></label>
            </div>";
  }

  /**
   * Returns truncated title for the datatables.
   *
   * @return string
   */
  public function laratablesTitle()
  {
    $title = "<img src=\"". Storage::url($this->thumbnail) ."\" class=\"mr-2 rounded img-thumbnail table-thumbnail\"/> ";
    $title .= $this->title;
    $title .= Form::open([
      'route'   => [
        'admin.medias.destroy', $this
      ],
      'method'  => 'DELETE'
    ]);
      $title .= "<ul class=\"list-unstyled m-0 mt-2 d-flex\">";
        $title .= "<li>". link_to_route('admin.medias.edit', "Edit", $this, ['class' => 'btn btn-link px-0 py-0 pr-2']) ."</li>";
        $title .= "<li>". Form::bsButton('delete', $this->id, 'submit', ['title' => 'Delete', 'class' => 'btn-link text-danger px-0 py-0 pr-2']) ."</li>";
      $title .= "</ul>";
    $title .= Form::close();
    
    return $title;
  }

  /**
   * Returns the size column html for datatables.
   *
   * @param \App\Media
   * @return string
   */
  public static function laratablesCustomSize($media)
  {
    return HumanReadableFile::bytesToHuman($media->getMeta('size'));
  }

  /**
   * Returns the type column html for datatables.
   *
   * @param \App\Media
   * @return string
   */
  public static function laratablesCustomType($media)
  {
    return $media->getMeta('mime_type');
  }
}
