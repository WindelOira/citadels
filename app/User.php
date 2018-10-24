<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

use Illuminate\Database\Eloquent\SoftDeletes;

class User extends Authenticatable
{
    use Notifiable;
    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['deleted_at'];

    /**
     * Get role for this user.
     */
    public function role() {
      return $this->belongsTo('App\Role');
    }

    /**
     * Get meta data for this user.
     */
    public function metas() {
      return $this->hasMany('App\UserMeta');
    }

    /**
     * Get user meta.
     * 
     * @param $key  string 
     * @return mixed
     */
    public function getMeta($key) { 
      if( count($this->metas) == 0 ) return NULL;

      foreach( $this->metas as $meta ) :
        if( $meta->key == $key ) 
          return $meta->value;
      endforeach;
    }

    /**
     * Returns the action column html for datatables.
     *
     * @param \App\User
     * @return string
     */
    public static function laratablesCustomAction($user) { 
      return view('admin.users.actions', compact('user'))->render();
    }

    /**
     * Returns truncated name for the datatables.
     *
     * @return string
     */
    public function laratablesName() {
      return $this->getMeta('first_name') .' '. $this->getMeta('last_name');
    }
}
