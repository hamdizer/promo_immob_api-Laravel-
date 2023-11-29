<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RequestClientAccount extends Model
{
    use HasFactory;
    protected $fillable=[
        'send_date',
        'state',
        'client_id',
        'agency_id'
    ];
    const STATE =[
        'accepted'=>1,
        'waiting'=>2,
        'rejected'=>3

    ];
    public function Client(){
        return $this->belongsTo('clients','client_id','id');
    }
    public function Admin(){
        return $this->belongsTo('administrators','admin_id','id');
    }
}
