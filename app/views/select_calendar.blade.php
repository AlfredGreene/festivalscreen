<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Select the calendar</title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">

    </head>
    <body>
    	<form method="post">
    		<p>Please select the calendar the info-screens are to parse</p>
    		<select name="calendarId">
    			@foreach($list as $cal)
    			<option value="{{ $cal->id }}">{{ $cal->summary }}</option>
    			@endforeach
    		</select>
    		<input type="submit" value="Save these settings!" />
    </body>
</html>