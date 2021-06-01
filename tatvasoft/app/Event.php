<?php
  
namespace App;
  
use Illuminate\Database\Eloquent\Model;
   
class Event extends Model
{
    protected $fillable = [
        'event_tilte', 'start_date','end_date','recurrence_id'
    ];

	public function event_timing()
	{
		return $this->belongsTo('App\EventTiming', 'id');
	}
}