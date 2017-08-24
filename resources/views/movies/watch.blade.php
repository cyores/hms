@extends('layouts.minimal_layout')
@section('title', ' | Watch')

@section('content')

<style type="text/css">
	main {
		background-color: #333;
		color: #fff;
	}
	button {
		background-color: rgba(0,0,0,0) !important;
	}
</style>

<h1>{{ $movie['title'] }}</h1>

<div class="flex one">
	<div class="full">
		<video id="vid" style="width: 100%; height: 100%;" controls>
		  <source src="{{ $movie['path'] }}" type="video/mp4">
		</video>
	</div>
</div>

<div class="flex one two-1200">
	<div class="half"><p>Rating: {{ $movie['rating'] }}</p></div>
	<div class="half"><p class="pull-right">Views: {{ $movie['count'] }}</p></div>
</div>

<script type="text/javascript">
	var movie = {!! json_encode($movie) !!};
	console.log('movie', movie);
	$('#vid').mediaelementplayer({
		startVloume: 1
	});
</script>

@endsection
