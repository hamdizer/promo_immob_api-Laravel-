<?php

namespace App\Models;
use Hash;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Tymon\JWTAuth\Contracts\JWTSubject;
use Illuminate\Foundation\Auth\User as Authenticatable;


class Administrator extends  Authenticatable implements JWTSubject
{
    use HasFactory,HasApiTokens, HasFactory, Notifiable;
 //protected $guard='api';
protected $primaryKey='id';

    const Role =[
        'Admin'=>1,
        'Super-Admin'=>2,

    ];
    public function RequestClients(){
        return $this->hasMany('request_account_clients','req_client_id','id');
    }
    public function RequestAgency(){
        return $this->hasMany('request_account_agency','req_agency_id','id');
    }
    public function getJWTIdentifier()
{
    return $this->getKey();
}
    public function getJWTCustomClaims()
{
    return ['cin'];
}

}
