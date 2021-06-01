<?php
namespace App\Http\Controllers;
  
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Session;
use App\Event;
use App\EventTiming;


class EventController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $events = Event::with('event_timing')->orderBy('updated_at','desc')->paginate(2); 

        return view('events.index',compact('events'))
            ->with('i', (request()->input('page', 1) - 1) * 5);
    }
   
    function more_data(Request $request){
        if($request->ajax()){
            $skip=$request->skip;
            $take=6;
            $products=Event::with('event_timing')->skip($skip)->take($take)->get();
            return response()->json($products);
        }else{
            return response()->json('Direct Access Not Allowed!!');
        }
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('events.create');
    }
  
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
        $input=$request->all();
        $request->validate([
            'event_title' => 'required',
        ]);

        // echo '<pre>';
        // print_r($input);
        // die;
  
        $Event = new Event;
        $Event->event_title=$input['event_title'];
        $Event->start_date=$input['start_date'];
        $Event->end_date=$input['end_date'];
        $Event->recurrence_id=$input['recurrence_id'];
        $Event->save();
        $EventId= $Event->id;

        
        $EventTiming = new EventTiming;
        $EventTiming->event_id =$EventId;

        if($input['recurrence_id'] == '1')
        {
            $EventTiming->event_type= $input['event_type'];
            $EventTiming->event_day= $input['event_day'];
            $EventTiming->event_month= $input['event_month'] ?? 0;
        }else{
            $EventTiming->event_type= $input['event_type_2'];
            $EventTiming->event_day= $input['event_day_2'];
            $EventTiming->event_month= $input['event_month_2'];
   
        }
        $EventTiming->save();
        
        return redirect()->route('events.index')
                        ->with('success','Event created successfully.');
    }
   
    /**
     * Display the specified resource.
     *
     * @param  \App\Event  $event
     * @return \Illuminate\Http\Response
     */
    public function show(Event $event)
    {
        $event_id = $event->id;
        $event = Event::with('event_timing')->where('id','=',$event_id)->get();
        // echo '<pre>';
        // print_r($event->toArray());
        // die;
        return view('events.show',compact('event'));
    }
   
    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Event  $event
     * @return \Illuminate\Http\Response
     */
    public function getEvent($id)
    {
        $event = Event::with('event_timing')->where('id','=',$id)->get();
        return view('events.edit',compact('event'));
    }
  
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Event  $event
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Event $event)
    {
        $input=$request->all();

        $request->validate([
            'event_title' => 'required',
        ]);
        
        
        EventTiming::where('event_id','=',$request->edit_event_id)->delete();
        Event::where('id','=',$request->edit_event_id)->delete();
        
        $Event = new Event;
        $Event->event_title=$input['event_title'];
        $Event->start_date=$input['start_date'];
        $Event->end_date=$input['end_date'];
        $Event->recurrence_id=$input['recurrence_id'];
        $Event->save();
        $EventId= $Event->id;

        
        $EventTiming = new EventTiming;
        $EventTiming->event_id =$EventId;

        if($input['recurrence_id'] == '1')
        {
            $EventTiming->event_type= $input['event_type'];
            $EventTiming->event_day= $input['event_day'];
            $EventTiming->event_month= $input['event_month'] ?? 0;
        }else{
            $EventTiming->event_type= $input['event_type_2'];
            $EventTiming->event_day= $input['event_day_2'];
            $EventTiming->event_month= $input['event_month_2'];
   
        }
        $EventTiming->save();
  
        return redirect()->route('events.index')
                        ->with('success','Event updated successfully');
    }
  
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Event  $event
     * @return \Illuminate\Http\Response
     */
    public function destroy(Event $event)
    {

        EventTiming::where('event_id','=',$event->id)->delete();
        $event->delete();
  
        return redirect()->route('events.index')
                        ->with('success','Event deleted successfully');
    }
}