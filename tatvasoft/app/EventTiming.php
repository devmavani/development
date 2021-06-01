<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EventTiming extends Model
{
	protected $table = 'event_timing';
	public $primaryKey = 'id';
	public $timestamps = true;

	protected $fillable = [
        'id','event_id', 'event_type','event_day','event_month','created_at','updated_at'
    ];
   
   // public function events()
   // {
   //      return $this->belongsTo(Event::class);
   // }
   
}
