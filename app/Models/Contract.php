<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contract extends Model
{
    use HasFactory;
    protected $fillable=[
        'name',
        'send_date',
        'period',
        'bill_amount',
        'client_id',
        'agency_id'
    ];
    public function Client(){
        return $this->belongsTo('clients','client_id','id');
    }
    public function Agency(){
        return $this->belongsTo('agencies','agency_id','id');
    }
}
