@extends('layouts.master')
@section('content')
<?php $i=0; $class=""; ?>
<div class="large-text">
	Månefestivalen i dag
</div>
<div class="container-fluid">
	<div class="row">
		<div class="col-lg-6">
			<div class="location hovedscenen">
				<h1>HOVEDSCENEN</h1>
				@foreach($locations['Hovedscene'] as $event)
				<?php
				   $datetime = new DateTime($event->start->dateTime);
				   $endtime = new DateTime($event->end->dateTime);
				   if($datetime->format('Y-m-d') != date("Y-m-d")) continue;
				   if($datetime->getTimestamp() < time() && $endtime->getTimestamp() > time()) $class = " current";
				   else $class = "";
				?>
				<div class="line{{ isset($class) ? $class : "" }}">
				<span>{{ isset($datetime) ? $datetime->format('H:i') : "" }} - {{ $event->summary }}</span>
				</div>
				@endforeach
			</div>
		</div>
		<div class="col-lg-6">
			<div class="location next">
				<h1>NESTE</h1>
				@foreach($items as $event)
				<?php
					$now = new DateTime();
					$datetime = new DateTime($event->start->dateTime);
					$endtime = new DateTime($event->end->dateTime);
					if($datetime->format('Y-m-d') != date("Y-m-d")) continue;
					if($datetime->getTimestamp() < time()) continue;
					$class = "";
					$interval = $datetime->diff($now);
					switch ($event->location) {
						case "Hovedscene":
							$class = " hovedscene";
						break;
						case "Festivaltorget":
							$class = " torget";
						break;
						case "Kode":
							$class = " kode";
					break;
					}
					#$remaining = $interval->format("%h timer og %i minutter");
					if ($interval->format("%h") == 1){
						$remaining = $interval->format("%h time");
					} elseif($interval->format("%h") > 1){
						$remaining = $interval->format("%h timer");
					}
					if(isset($remaining)) $remaining .= " og ";
					else $remaining = "";
					if ($interval->format("%i") == 1){
						$remaining .= $interval->format("%i minutt");
					} elseif($interval->format("%i") > 1){
						$remaining .= $interval->format("%i minutter");
					}
				?>
				<div class="line{{ @$class }}">
					<div class="box"></div>
					{{ $event->summary }}
					<span class="om">{{ isset($remaining) ? $remaining : "" }}</span>
				</div>
				@endforeach
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