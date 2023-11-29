<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Agency extends Model
{
    use HasFactory;
    protected $fillable=[
        'name',
        'localization',
    ];
    /**
     * @var mixed
     */

    public function Corporates(){
        return $this->hasMany(\App\Models\Corporate::class);
    }
    public function Manager(){
        return $this->hasOne('corporates','manager_id','id');
    }
    public function Contracts(){
        return $this->hasMany('contracts','contract_id','id');

    }
    public function Clients(){
        return $this->hasMany(\App\Models\Client::class);
    }
    public function invoices(){
        return $this->hasMany(\App\Models\Invoice::class);
    }
}
