@extends('layouts.master')
@section('content')
<? $i=0; ?>
<div class="large-text">
	Månefestivalen i dag
</div>
<div class="container-fluid">
	<div class="row">
		<div class="col-lg-6">
			<div class="location torget">
				<h1>TORGSCENEN</h1>
				@if(isset($locations['Festivaltorget']))
				@foreach($locations['Festivaltorget'] as $event)
				<? $datetime = new DateTime($event->start->dateTime);
				   $endtime = new DateTime($event->end->dateTime);
				   if($datetime->format('Y-m-d') != date("Y-m-d")) continue;
				   if($datetime->getTimestamp() < time() && $endtime->getTimestamp() > time()) $class = " current";
				   else $class = "";
				?>
				<div class="line{{ @$class }}">
				<span>{{ $datetime->format('H:i') }} - {{ $event->summary }}</span>
				</div>
				@endforeach
				@endif
			</div>
		</div>
		<div class="col-lg-6">
			<div class="location kode">
				<h1>KODESCENEN</h1>
				@if(isset($locations['Kode']))
				@foreach($locations['Kode'] as $event)
				<? $datetime = new DateTime($event->start->dateTime);
				   $endtime = new DateTime($event->end->dateTime);
				   if($datetime->format('Y-m-d') != date("Y-m-d")) continue;
				   if($datetime->getTimestamp() < time() && $endtime->getTimestamp() > time()) $class = " current";
				   else $class = "";
				?>
				<div class="line{{ @$class }}">
				<span>{{ $datetime->format('H:i') }} - {{ $event->summary }}</span>
				</div>
				@endforeach
				@endif
			</div>
		</div>
	</div>
</div>
@stop

@section('scripts')
<script type="text/javascript" src="http://cdnjs.cloudflare.com/ajax/libs/FitText.js/1.1/jquery.fittext.min.js"></script>
<script type="text/javascript">
function blink(elem, times, speed) {
    if (times > 0 || times < 0) {
        if ($(elem).hasClass("blink")) $(elem).removeClass("blink");
        else $(elem).addClass("blink");
    }

    clearTimeout(function () {
        blink(elem, times, speed);
    });

    if (times > 0 || times < 0) {
        setTimeout(function () {
            blink(elem, times, speed);
        }, speed);
        times -= .5;
    }
}
$(function() {
	blink(".current", -1, 500);
});
</script>
@stop