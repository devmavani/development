@extends('events.layout')
   
@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Edit Event</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-primary" href="{{ route('events.index') }}"> Back</a>
            </div>
        </div>
    </div>
   
    @if ($errors->any())
        <div class="alert alert-danger">
            <strong>Whoops!</strong> There were some problems with your input.<br><br>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
  
    

    <form action="{{ route('events.update',$event[0]->id) }}" method="POST" id="event_form">
    @csrf
    @method('PUT')
  
     <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-6">
            <div class="form-group">
                <strong>Event Title:</strong>
                <input type="text" name="event_title" id="event_title" value="{{$event[0]->event_title}}" class="form-control" placeholder="Event Title">
            </div>
        </div>
     </div>

      <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-6">
            <div class="form-group">
                <strong>Start Date:</strong>
                <input type="text" name="start_date" id="start_date" value="{{$event[0]->start_date}}" autocomplete="off" class="form-control date" placeholder="Start Date">
            </div>
        </div>

        <div class="col-xs-12 col-sm-12 col-md-6">
            <div class="form-group">
                <strong>End Date:</strong>
                <input type="text" name="end_date" id="end_date" autocomplete="off" value="{{$event[0]->end_date}}" class="form-control date" placeholder="End Date">
            </div>
        </div>
       </div> 
       <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Recurrence:</strong>
                <input type="radio" id="recurrence_id" name="recurrence_id" value="1" {{ $event[0]->recurrence_id == '1' ? 'checked=checkded' : '' }}>
                <label>Repeat</label>
                <select id="event_type" name="event_type">
                        <option value="">--select--</option>
                        <option value="every" {{ $event[0]->recurrence_id== "1" && $event[0]['event_timing']->event_type == 'every' ? 'selected=selected' : '' }}>Every</option>
                        <option value="everyother" {{ $event[0]->recurrence_id== "1" && $event[0]['event_timing']->event_type == 'everyother' ? 'selected=selected' : '' }}>Every Other</option>
                        <option value="everythird" {{ $event[0]->recurrence_id== "1" && $event[0]['event_timing']->event_type == 'everythird' ? 'selected=selected' : '' }}>Every Third</option>
                        <option value="everyfourth" {{ $event[0]->recurrence_id== "1" && $event[0]['event_timing']->event_type == 'everyfourth' ? 'selected=selected' : '' }}>Every Fourth</option>
                </select>  

                <select id="event_day" name="event_day">
                        <option value="">--select--</option>
                        <option value="day" {{ $event[0]->recurrence_id== "1" && $event[0]['event_timing']->event_day == 'day' ? 'selected=selected' : '' }}>Day</option>
                        <option value="week" {{ $event[0]->recurrence_id== "1" && $event[0]['event_timing']->event_day == 'week' ? 'selected=selected' : '' }}>Week</option>
                        <option value="month" {{ $event[0]->recurrence_id== "1" && $event[0]['event_timing']->event_day == 'month' ? 'selected=selected' : '' }}>Month</option>
                        <option value="year" {{ $event[0]->recurrence_id== "1" && $event[0]['event_timing']->event_day == 'year' ? 'selected=selected' : '' }}>Year</option>
                </select>  
            </div>
         </div>
        </div>

         <div class="row">
             <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Recurrence:</strong>
                    <input type="radio" id="recurrence_id" name="recurrence_id" value="2" {{ $event[0]->recurrence_id == '2' ? 'checked=checkded' : '' }}>
                    <label>Repeat on the</label>
                    <select id="event_type_2" name="event_type_2">

                            <option value="">--select--</option>
                            <option value="first" {{ $event[0]->recurrence_id== "2" && $event[0]['event_timing']->event_type == 'first' ? 'selected=selected' : '' }}>First</option>
                            <option value="second" {{ $event[0]->recurrence_id== "2" && $event[0]['event_timing']->event_type == 'second' ? 'selected=selected' : '' }}>Second</option>
                            <option value="third" {{ $event[0]->recurrence_id== "2" && $event[0]['event_timing']->event_type == 'third' ? 'selected=selected' : '' }}>Third</option>
                            <option value="fourth" {{ $event[0]->recurrence_id== "2" && $event[0]['event_timing']->event_type == 'fourth' ? 'selected=selected' : '' }}>Fourth</option>
                    </select>  

                    <select id="event_day_2" name="event_day_2">
                            <option value="">--select--</option>
                            <option value="sunday" {{ $event[0]->recurrence_id== "2" && $event[0]['event_timing']->event_day == 'sunday' ? 'selected=selected' : '' }}>Sunday</option>
                            <option value="monday" {{ $event[0]->recurrence_id== "2" && $event[0]['event_timing']->event_day == 'monday' ? 'selected=selected' : '' }}>Monday</option>
                            <option value="tuesday" {{ $event[0]->recurrence_id== "2" && $event[0]['event_timing']->event_day == 'tuesday' ? 'selected=selected' : '' }}>Tuesday</option>
                            <option value="wednesday" {{ $event[0]->recurrence_id== "2" && $event[0]['event_timing']->event_day == 'wednesday' ? 'selected=selected' : '' }}>Wednesday</option>
                            <option value="thursday" {{ $event[0]->recurrence_id== "2" && $event[0]['event_timing']->event_day == 'thursday' ? 'selected=selected' : '' }}>Thursday</option>
                            <option value="friday" {{ $event[0]->recurrence_id== "2" && $event[0]['event_timing']->event_day == 'friday' ? 'selected=selected' : '' }}>Friday</option>
                            <option value="saturday" {{ $event[0]->recurrence_id== "2" && $event[0]['event_timing']->event_day == 'saturday' ? 'selected=selected' : '' }}>Saturday</option>
                    </select> 

                    <select id="event_month_2" name="event_month_2">
                            <option value="">--select--</option>
                            <option value="3months" {{ $event[0]->recurrence_id== "2" && $event[0]['event_timing']->event_month == '3months' ? 'selected=selected' : '' }}>3 Months</option>
                            <option value="4months" {{ $event[0]->recurrence_id== "2" && $event[0]['event_timing']->event_month == '4months' ? 'selected=selected' : '' }}>4 Months</option>
                            <option value="6months" {{ $event[0]->recurrence_id== "2" && $event[0]['event_timing']->event_month == '6months' ? 'selected=selected' : '' }}>6 Months</option>
                            <option value="year" {{ $event[0]->recurrence_id== "2" && $event[0]['event_timing']->event_month == 'year' ? 'selected=selected' : '' }}>Year</option>
                    </select> 
                </div>
             </div>
         </div>    
        <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                <input type="hidden" id="edit_event_id" name="edit_event_id" value="{{$event[0]->id}}">
                <button type="submit" class="btn btn-primary">Submit</button>
        </div>
   
   
</form>

<script type="text/javascript">

    $('.date').datepicker({  

       format: 'yyyy-mm-dd'

     });  

    $(document).ready(function(){

        $("#event_form").validate({
 
            rules: {
                event_title: {
                    required: true,
                    maxlength: 50
                },
 
                
            },
            messages: {
 
                event_title: {
                    required: "Please enter event name",
                },
                
            },
        })
    }); 

</script>  

@endsection