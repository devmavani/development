@extends('layout')
 
@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Event Management</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-success" href="{{ route('events.create') }}"> Create New Event</a>
            </div>
        </div>
    </div>
    <br/>
   
    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif
   
    <table class="table table-bordered" id="event_table">
        <thead>
        <tr>
            <th>No</th>
            <th>Title</th>
            <th>Dates</th>
            <th>Occurence</th>
            <th width="280px">Action</th>
        </tr>
    </thead>
        <div id="events" class="event-list">
        <tbody>    
        @foreach ($events as $event)
        <div class="col-sm-4 mb-3 event-box">
            
                <tr>
                    <td>{{ ++$i }}</td>
                    <td>{{ $event->event_title }}</td>
                    <td>{{ $event->start_date.' to '.$event->end_date }}</td>
                    <td>
                      @if($event['recurrence_id'] == '1')  
                        {{ $event['event_timing']['event_type'].' '.$event['event_timing']['event_day']  }}
                      @else
                          {{ $event['event_timing']['event_type'].' '.$event['event_timing']['event_day'].' '.$event['event_timing']['event_month'] ?? ''  }}
                      @endif  
                    </td>

                    <td>
                        <form action="{{ route('events.destroy',$event->id) }}" method="POST">
           
                            <a class="btn btn-info" href="{{ route('events.show',$event->id) }}">View</a>
            
                            <a class="btn btn-primary" href="{{ route('getEvent',$event->id) }}">Edit</a>
           
                            @csrf
                            @method('DELETE')
              
                            
                            <button type="submit" class="btn btn-danger" title="Delete" onclick="return confirm('Are you sure you want to delete this data?');">Delete</button>
                        </form>
                    </td>
                </tr>
               
        </div>
        @endforeach
        </tbody> 
    </div>
    </table>

     @if(count($events)>0)
    <p class="text-center mt-4 mb-5"><button class="load-more btn btn-dark" data-totalResult="{{ App\Event::count() }}">Load More</button></p>
    @endif
  
    <script type="text/javascript">
        var main_site="{{ url('/') }}";

        $(document).ready(function(){
          $(".load-more").on('click',function(){
            var _totalCurrentResult=$(".event-box").length;
            // Ajax Reuqest
            $.ajax({
                url:main_site+'/load-more-data',
                type:'get',
                dataType:'json',
                data:{
                    skip:_totalCurrentResult
                },
                beforeSend:function(){
                    $(".load-more").html('Loading...');
                },
                success:function(response){
                    console.log(response);
                    var _html='';
                    var image="{{ asset('imgs') }}/";
                    $.each(response,function(index,value){
                        console.log('value',value.event_timing.event_type);
                        //+' 'value.event_timing.event_day+' '+value.event_timing.event_month+'
                            _html+='<tr>';
                            _html+='<td>3</td>';
                                _html+='<td>'+value.event_title+'</td>';
                                _html+='<td>'+value.start_date+' to '+value.end_date+'</td>';
                                _html+='<td>'+value.event_timing.event_type+' '+value.event_timing.event_day+' '+value.event_timing.event_month+'</td>';
                                _html+='<td><form action="" method="POST"><a class="btn btn-info" href="{{ route('events.show',$event->id) }}">View</a>  <a class="btn btn-primary" href="{{ route('getEvent',$event->id) }}">Edit</a>  <button type="submit" class="btn btn-danger" title="Delete">Delete</button></form></td>';
                                _html+='<td></td>';
                        _html+='</tr>';
                    });
                    $("#event_table").find('tbody').append(_html);
                    //$(".event-list").append(_html);
                    // Change Load More When No Further result
                    var _totalCurrentResult=$(".event-box").length;
                    var _totalResult=parseInt($(".load-more").attr('data-totalResult'));
                    console.log(_totalCurrentResult);
                    console.log(_totalResult);
                    if(_totalCurrentResult==_totalResult){
                        $(".load-more").remove();
                    }else{
                        $(".load-more").html('Load More');
                    }
                }
            });
        });
        });
    </script>    
      
@endsection