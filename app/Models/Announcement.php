<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Announcement extends Model
{protected $fillable=[
    'title',
    'image',
    'body',
    'reserved',
    'corporate_id'
];
    use HasFactory;
    public function Clients(){
        return $this->belongsToMany('\App\Models\Client','reservations')->withTimestamps();
    }

    public function Corporates(){
        return $this->belongsTo(\App\Models\Corporate::class,'corporate_id','id');
    }

}
