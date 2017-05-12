<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;


class UserProfile extends Model
{
    public $table = 'user_profile';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id',
        'user_id',
        'first_name',
        'last_name',
        'middle_name',
        'bdate',
        'github_url',
        'phone',
        'photo',
        'about',
        'created_at',
        'updated_at',
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
        return $this->belongsTo('App\Models\User' , 'user_id');
    }


    public function getBdateAttribute($value)
    {
        return Carbon::createFromFormat('Y-m-d' , $value)->format('d.m.Y');
    }


    public function setBdateAttribute($value)
    {
        $this->attributes['bdate'] = Carbon::createFromFormat('d.m.Y'  , $value)->format('Y-m-d');
    }



}
