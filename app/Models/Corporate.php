<?php

namespace App\Models;

//use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Tymon\JWTAuth\Contracts\JWTSubject;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Hash;
class Corporate extends  Authenticatable implements JWTSubject
{
    use HasFactory,HasApiTokens, HasFactory, Notifiable;
   // protected $guard='corporate';
       protected $primaryKey = 'id';

     const Role =[
            'manager'=>1,
            'corporate'=>2

        ];
    public function Agency(){
        return $this->belongsTo(\App\Models\Agency::class);
    }
    public function Announcements(){
        return $this->hasMany(\App\Models\Announcement::class);
    }

    public function getJWTIdentifier()
    {
return $this->getKey();
    }

    public function getJWTCustomClaims()
    {
      return[];
    }

}
