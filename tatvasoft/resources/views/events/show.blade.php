@extends('events.layout')
@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2> Event Description</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-primary" href="{{ route('events.index') }}"> Back</a>
            </div>
        </div>
    </div>
   <?php
        
    $type = $event[0]['event_timing']['event_type'];
    $event_day = $event[0]['event_timing']['event_day'];
    $event_month = $event[0]['event_timing']['event_month'];
    $date = date('Y-m-d');
    $table_show = '';
    $not_found = '';
    $flag = 0;

   
    if($type == 'every' && $event_day == 'day' && $event_month == '0')
    {
        $table_show = 'style="display:block"';
        $not_found = 'style="display:none"';
        
    }else{
        $table_show = 'style="display:none"';
        $not_found = 'style="display:block"';
    }
  //echo "@@@@@@".$not_found;
   ?>
    <table border="1">
        <thead>
            <tr <?php echo $table_show;?>>
                <td>{{ date('Y-m-d')}}</td>
                <td>{{ date('l', strtotime($date))}}</td>
            </tr>
            <tr <?php echo $not_found;?>>
                <td colspan="2">No Events Found</td>
            </tr>
        </thead>
     </table>  

      
@endsection