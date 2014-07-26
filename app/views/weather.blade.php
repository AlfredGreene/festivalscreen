@extends('layouts.master')
@section('content')
<? $i=0; ?>
<div class="large-text">
	Drikk vann!<br />
</div>
<div class="info">
	Det er <span class="temp">{{ $forecast->getTemperature() }}</span> grader,
	da bør du få i deg minst {{ ceil($forecast->getTemperature()/10) }}
	liter vann i dag!<br />
	<small>Det er flere vannstasjoner rundt på festivalen!</small></small>
</div>
@stop