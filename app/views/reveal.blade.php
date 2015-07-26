<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<title>Informasjonsskjerm</title>
		<meta name="description" content="">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="stylesheet" type="text/css" href="/assets/css/styles.css">
	</head>
	<body>
		<div class="reveal">

			<div class="slides">
				<section data-background="#FFFFFF"><img src="/assets/images/sponsors/obos.png" class="stretch" /></section>
				<section data-background="#FFFFFF"><img src="/assets/images/sponsors/newwave.png" class="stretch" /></section>
				<section data-background="#FFFFFF"><img src="/assets/images/sponsors/xlbygg.png" class="stretch" /></section>
				<section data-background="#FFFFFF"><img src="/assets/images/sponsors/fb.png" class="stretch" /></section>
				<section data-background="#FFFFFF"><img src="/assets/images/sponsors/samarbeidspartnere.png" class="stretch" /></section>
				<section data-background="#FFFFFF"><img src="/assets/images/sponsors/partnere.png" class="stretch" /></section>
				<section data-background="#FFFFFF"><img src="/assets/images/sponsors/stottespillere.png" class="stretch" /></section>
				<section class="stage" data-background="/assets/images/stagebg.jpg" data-autoslide="4000"><h1><span>Program</span></section>
				<?php $earth = 0; ?>	
				@foreach($locations as $name => $events)
				<?php if(count($events) < 1) continue; ?>
				<section class="stage" data-background="/assets/images/stagebg.jpg">
					<!--<section data-autoslide="4000"><h1><span>Program</span> {{ $name }}</h1></section>-->
					<section class="program" data-transition="zoom">
						<h1><span>Program</span> {{ $name }}</h1>
						<ul class="playlist">
							<li class="header">{{ $today }}</li>
							@foreach($events as $event)
							<?php
							   $datetime = new DateTime($event->start->dateTime);
							   $endtime = new DateTime($event->end->dateTime);
							   if($datetime->format('Y-m-d') != date("Y-m-d")) continue;
							   if($datetime->getTimestamp()-1800 < time() && $endtime->getTimestamp() > time()) $class = " current";
							   else $class = "";
							?>
							<li class="{{ $class }}">
								<span>kl. {{ isset($datetime) ? $datetime->format('H:i') : "" }}</span>
								{{ $event->summary }}
							</li>
							@endforeach
						</ul>
						<ul class="playlist">
							<li class="header">{{ $tomorrow }}</li>
							@foreach($events as $event)
							<?php
							   $datetime = new DateTime($event->start->dateTime);
							   $endtime = new DateTime($event->end->dateTime);
							   if($datetime->format('Y-m-d') != date("Y-m-d", strtotime('+1 day'))) continue;
							   if($datetime->getTimestamp()-1800 < time() && $endtime->getTimestamp() > time()) $class = " current";
							   else $class = "";
							?>
							<li class="{{ $class }}">
								<span>kl. {{ isset($datetime) ? $datetime->format('H:i') : "" }}</span>
								{{ $event->summary }}
							</li>
							@endforeach
						</ul>
					</section>
				</section>	
				<?php if($earth < 10): for ($i=0; $i < 3; $i++): $earth++; if($earth >= 10) continue; ?>
					<section data-background="#19578e"><img src="/assets/images/earth/earth-{{ str_pad($earth, 2, '0', STR_PAD_LEFT) }}.jpg" class="stretch" /></section>
				<?php endfor; endif; ?>
				@endforeach
			</div>
		</div>

		<script type="text/javascript">
			var $MD5SUM = "{{ $md5sum }}";
		</script>

		<script type="text/javascript" src="//code.jquery.com/jquery-2.1.4.min.js"></script>
		<script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/reveal.js/3.1.0/js/reveal.min.js"></script>
		<script type="text/javascript" src="js/main.js"></script>
		<script type="text/javascript" src="js/Remote.js"></script>
	</body>
</html>