@extends('events.layout')
@section('content')

<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left">
            <h2>Add New Event</h2>
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

<form action="{{ route('events.store') }}" method="POST" id="event_form">
    @csrf
  
     <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-6">
            <div class="form-group">
                <strong>Event Title:</strong>
                <input type="text" name="event_title" id="event_title" class="form-control" placeholder="Event Title">
            </div>
        </div>
     </div>

      <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-6">
            <div class="form-group">
                <strong>Start Date:</strong>
                <input type="text" name="start_date" id="start_date" autocomplete="off" class="form-control date" placeholder="Start Date">
            </div>
        </div>

        <div class="col-xs-12 col-sm-12 col-md-6">
            <div class="form-group">
                <strong>End Date:</strong>
                <input type="text" name="end_date" id="end_date" autocomplete="off" class="form-control date" placeholder="End Date">
            </div>
        </div>
       </div> 
       <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Recurrence:</strong>
                <input type="radio" id="recurrence_id" name="recurrence_id" value="1">
                <label>Repeat</label>
                <select id="event_type" name="event_type">
                        <option value="">--select--</option>
                        <option value="every">Every</option>
                        <option value="everyother">Every Other</option>
                        <option value="everythird">Every Third</option>
                        <option value="everyfourth">Every Fourth</option>
                </select>  

                <select id="event_day" name="event_day">
                        <option value="">--select--</option>
                        <option value="day">Day</option>
                        <option value="week">Week</option>
                        <option value="month">Month</option>
                        <option value="year">Year</option>
                </select>  
            </div>
         </div>
        </div>

         <div class="row">
             <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Recurrence:</strong>
                    <input type="radio" id="recurrence_id" name="recurrence_id" value="2">
                    <label>Repeat on the</label>
                    <select id="event_type_2" name="event_type_2">
                            <option value="">--select--</option>
                            <option value="first">First</option>
                            <option value="second">Second</option>
                            <option value="third">Third</option>
                            <option value="fourth">Fourth</option>
                    </select>  

                    <select id="event_day_2" name="event_day_2">
                            <option value="">--select--</option>
                            <option value="sunday">Sunday</option>
                            <option value="monday">Monday</option>
                            <option value="tuesday">Tuesday</option>
                            <option value="wednesday">Wednesday</option>
                            <option value="thursday">Thursday</option>
                            <option value="friday">Friday</option>
                            <option value="saturday">Saturday</option>
                    </select> 

                    <select id="event_month_2" name="event_month_2">
                            <option value="">--select--</option>
                            <option value="3months">3 Months</option>
                            <option value="4months">4 Months</option>
                            <option value="6months">6 Months</option>
                            <option value="year">Year</option>
                    </select> 
                </div>
             </div>
         </div>    
        <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                <button type="submit" class="btn btn-primary">Submit</button>
        </div>
   
   
</form>



<script type="text/javascript">

    $('.date').datepicker({  

       format: 'yyyy-mm-dd'

     });  

    // $(document).ready(function(){

    //     $("#event_form").validate({
 
    //         rules: {
    //             event_title: {
    //                 required: true,
    //                 maxlength: 50
    //             },
 
                
    //         },
    //         messages: {
 
    //             event_title: {
    //                 required: "Please enter event name",
    //             },
                
    //         },
    //     })
    // }); 

</script>  



@endsection