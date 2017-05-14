<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;


class LikeProfile extends Model
{
    public $table = 'like_profile';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id',
        'user_id',
        'profile_id',

    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [

    ];


    public function user()
    {
        return $this->belongsToMany('App\Models\User' , 'like_profile' , 'profile_id' , 'user_id' );
    }

    public function userOne()
    {
        return $this->belongsTo('App\Models\User' , 'user_id'  );
    }




}
