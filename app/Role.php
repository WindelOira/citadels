<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use Cviebrock\EloquentSluggable\Sluggable;

class Role extends Model
{
  use Sluggable;

  /**
   * The attributes that are mass assignable.
   *
   * @var array
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
   * Get users for this role.
   */
  public function users() {
    return $this->hasMany('App\User');
  }

  /**
   * Returns the action column html for datatables.
   *
   * @param \App\Role
   * @return string
   */
  public static function laratablesCustomAction($role) { 
    return view('admin.roles.actions', compact('role'))->render();
  }
}
