<?php

namespace App\Http\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;

class Channel extends Model
{
    protected $fillable = [
        'name',
        'slug',
        'description',
        'image_filename',
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function video(){
        return $this->hasMany(Video::class);
    }
    public function getRouteKeyName()
    {
        return 'slug';
    }
}
