<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    use HasFactory;
    protected $fillable=[
        'name',
        'send_date',
        'limit_date',
        'payed',
        'bill_amount',
        'client_id',
        'agency_id'
    ];
    public function Client(){
        return $this->belongsTo(\App\Models\Client::class,'client_id','id');
    }
    public function Agency(){
        return $this->belongsTo(\App\Models\Agency::class,'agency_id','id');
    }
}
