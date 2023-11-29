<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RequestAgencyAccount extends Model
{
    use HasFactory;
    protected $fillable=[
        'send_date',
        'state',
        'agency_id',
        'admin_id'
    ];
    const STATE =[
        'accepted'=>1,
        'waiting'=>2,
        'rejected'=>3
    ];
    /**
     * @var mixed
     */

    public function Agency(){
        return $this->belongsTo('agencies','agency_id','id');
    }
    public function Admin(){
        return $this->belongsTo('administrators','admin_id','id');
    }
}
