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
   * Get all of the owning mediaable media.
   */
  public function mediaable()
  {
    return $this->morphTo();
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
   * Get all posts for this media.
   */
  public function posts() {
    return $this->morphedByMany('App\Post', 'mediaable');
  }

  /**
   * Get all products for this media.
   */
  public function products() {
    return $this->morphedByMany('App\Product', 'mediaable');
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
   * Update meta data.
   *
   * @param mixed   $key
   * @param mixed   $value
   *
   * @return bool
   */
  public function updateMeta($key, $value = FALSE) {
    if( is_array($key) ) :
      $metas = [];

      foreach( $key as $k => $v ) :
        $metas[] = [
          'key'     => $k,
          'value'   => $v
        ];
      endforeach;

      return $this->metas()->updateOrCreate(array_values($metas));
    else :
      return $this->metas()->where('key', $key)->update([
        'value'  => $value
      ]);
    endif;
  }

  /**
   * Get media file.
   *
   * @return string
   */
  public function getMediaFileAttribute() {
    $media_file = $this->whereId($this->id)->first();

    return "{$media_file->slug}.{$media_file->ext}";
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
    return "<div class=\"custom-control custom-checkbox w-100 h-100\">
              <input type=\"checkbox\" class=\"custom-control-input\" id=\"media-". str_slug($this->id) ."__checkbox\" value=\"". $this->id ."\">
              <label class=\"custom-control-label w-100 h-100\" for=\"media-". str_slug($this->id) ."__checkbox\"></label>
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
   * Returns truncated title for the datatables.
   *
   * @return string
   */
  public static function laratablesCustomItem($media) {
    $item = "<div class=\"file-manager__item card card-small h-100\">";
      $item .= Form::open([
        'route'   => [
          'admin.medias.destroy', $media
        ],
        'method'  => 'DELETE'
      ]);
        $item .= "<ul class=\"list-unstyled p-1 m-0 d-flex\">";
          $item .= "<li><a href=\"". route('admin.medias.edit', $media) ."\" class=\"btn btn-link px-0 py-0 pr-1\"><span class=\"fa fa-pencil\"></span></a></li>";
          $item .= "<li><button type=\"submit\" class=\"btn btn-link text-danger px-0 py-0 pl-1\" value=\"". $media->id ."\"><span class=\"fa fa-trash\"></span></button></li>";
        $item .= "</ul>";
      $item .= Form::close();
      $item .= "<div class=\"file-manager__item-preview card-body px-0 pb-0 pt-4\">";
        $item .= "<img src=\"". Storage::url($media->thumbnail) ."\" class=\"img-thumbnail table-thumbnail\" alt=\"". $media->whereId($media->id)->first()->title ."\"/>";
      $item .= "</div>";
      $item .= "<div class=\"card-footer border-top\">";
        $item .= "<span class=\"file-manager__item-icon\">";
          $item .= "<i class=\"material-icons\">&#xE24D;</i>";
        $item .= "</span>";
        $item .= "<h6 class=\"file-manager__item-title\">". $media->whereId($media->id)->first()->title ."</h6>";
        $item .= "<span class=\"file-manager__item-size ml-auto\">". HumanReadableFile::bytesToHuman($media->getMeta('size')) ."</span>";
      $item .= "</div>";
    $item .= "</div>";

    return $item;
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
