@extends('user::layouts.doctor.default')

@section('title', 'Calendar')

@section('content')

<div class="row">
    <div class="col-lg-12">
        <h2 class="page-header"> Calendar </h2>
    </div>
</div>

<div class="row">
    <div class="col-xs-12">
        @include('user::admin.messages')
        
        <div class="alert alert-info">
            <strong>Note:</strong> Time slots will be added for each day <strong>from today ({{ $beginDate->format('M d, Y') }}) to next one month ({{ $endDate->format('M d, Y') }})</strong>. After adding, you can delete unwanted time slots. 
        </div>

        <form class="form-inline" method="post" action=''>
            <!-- <div class="input-group bootstrap-timepicker timepicker">
                <input id="timepicker1" type="text" class="form-control input-small">
                <span class="input-group-addon"><i class="glyphicon glyphicon-time"></i></span>
            </div> -->
            <div class="form-group">
                <label for="start_time">Start time:</label>
                <input type="text" class="form-control timepicker" id="start_time" name='start_time' required>
            </div>
            <div class="form-group">
                <label for="end_time">End time:</label>
                <input type="text" class="form-control timepicker" id="end_time" name='end_time' required>
            </div>

            {{ csrf_field() }}
            <button type="submit" class="btn btn-primary">Submit</button>            
            <button type="button" class="btn btn-danger pull-right" id='delete' disabled title='Click to delete selcted time slots'>Delete selected (<span id='count'>0</span>)</button>
            <!-- <button type="button" class="btn btn-default pull-right">Select none</button> -->
        </form>

        <div class="flexslider mt-20" id='days-slider'>
            <ul class="list-inline slides">
                @foreach($dates as $key => $val)
                    <li class="{{ $loop->iteration==1 ? 'active' : ''}}" data-timings="{{ $val['month'].'-'.$val['date'] }}">{{ $val['day'].', '.$val['date'].' '.$val['month'] }}</li>
                @endforeach
            </ul>
        </div>
        <div class='tab-content'>
           @foreach($dates as $key => $val)
              <div class="timings tab-pane {{ $loop->iteration==1 ? 'active' : ''}}" id="{{ $val['month'].'-'.$val['date'] }}" data-date="{{ $key }}">
                 @if( isset($val['schedules']) )
                    <ul class="list-inline">
                       @foreach( $val['schedules'] as $schedule_id => $value )
                            <li data-id="{{ $schedule_id }}" class="{{ $value[1] }}">{{ $value[0] }}</li>
                       @endforeach
                    </ul>
                 @else
                    <p class="text-center mt-20"><strong>No times found.</strong></p>
                 @endif
              </div>
           @endforeach
        </div>
    </div>
</div>

@include('user::admin.plugins.flex-slider')
@include('user::admin.plugins.bootstrap-timepicker')

<script type='text/javascript'>
jQuery(function($){
    var url = "{{ route('doctor.calendar.delete') }}";
    var _token = "{{ csrf_token() }}";

    $('.flexslider').flexslider({
        animation: "slide",
        slideshow: false,
        animationLoop: false,
        itemWidth: 20,
        itemMargin: 0,
        minItems: 3,
        maxItems: 5,
        controlNav: false,
        keyboard: false
    });

    $('.timepicker').timepicker({
        defaultTime: false, // 'current',
        showMeridian: false,
        minuteStep: 30
    });

    $('.timepicker').on('changeTime.timepicker', function(e) {
        // console.log(e.time.value);
    });

    // Switch calendar days 
    $('ul.slides li').click(function(){
        var timings = $(this).data('timings');
        $('ul.slides li').removeClass('active');
        $(this).addClass('active');
        $('.timings').removeClass('active').hide();
        $('#'+timings).addClass('active').show();
        $('.timings li').removeClass('active');
        $('#count').html(0);
    });

    $(document).on('click', '.timings li.not-used', function(e){
        if( !$(this).hasClass('active') ) 
        {
            $(this).addClass('active');
            $('#count').html( parseInt($('#count').html()) + 1);
            $('#delete').attr('disabled', false);
        } 
        else 
        {
            $(this).removeClass('active');
            $('#count').html( parseInt($('#count').html()) - 1);
            if( $('#count').html() == 0 ) {
                $('#delete').attr('disabled', true);
            }
        }
    });

    // Delete selected time slots
    $(document).on('click', '#delete', function(e){
        if( confirm('Are you sure you want to delete selected time slots? This can not be undone.') )
        {
            var times = [];
            var $this = $(this);
            var html = $this.html();
            $('.timings.active li.active').each(function(){
                times.push( $(this).data('id') );
            });

            $this.html('Please wait...').attr('disabled', true);
            $.post(url, {data: JSON.stringify(times), _token: _token}, function(response){
                if( response == 'true' ) 
                {
                    $this.html("Delete selected (<span id='count'>0</span>)");
                    $('.timings.active li.active').remove();
                }
                else
                {
                    $this.html(html);
                    alert(response);
                }

                $this.attr('disabled', false);
            });    
        }
    });
});
</script>
@stop