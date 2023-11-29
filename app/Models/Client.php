<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Tymon\JWTAuth\Contracts\JWTSubject;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Hash;
class Client extends  Authenticatable implements JWTSubject
{
    use HasFactory,HasApiTokens, HasFactory, Notifiable;
protected $primaryKey='id';
    protected $fillable=[
        'cin',
        'last_name',
        'first_name',
        'phone_number',
        'address',
        'email',
        'password',

    ];

    public function Announcements(){
        return $this->belongsToMany('\App\Models\Announcement','reservations')->withTimestamps();
    }
    public function invoices(){
        return $this->hasMany(\App\Models\Invoice::class);
    }
    public function contracts(){
        return $this->hasMany('contracts','contract_id','id');
    }
    public function Agency(){
        $this->belongsTo(\App\Models\Agency::class);
    }


    public function getJWTIdentifier()
    {
        $this->getKey();
    }

    public function getJWTCustomClaims()
    {
        // TODO: Implement getJWTCustomClaims() method.
        return[''];
    }

}
