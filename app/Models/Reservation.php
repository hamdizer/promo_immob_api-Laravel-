<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
    use HasFactory;
    protected $fillable=[
        'date',
        'state',
        'announcement_id',
        'client_id',
    ];
    const STATE =[
      'accepted'=>1,
       'waiting'=>2,
       'rejected'=>3

    ];
    public function Announcement(){
        $this->belongsTo('announcements','announcement_id','id');
    }
    public function Client(){
        $this->belongsTo('clients','client_id','id');
    }
}
