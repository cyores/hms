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

<h1>{{ $episode['title'] }}</h1>

<video id="vid" style="width: 100%; height: 100%;" controls>
  <source src="http://media.hms.dev/{{ $episode['path'] }}" type="video/mp4">
</video>

<div class="flex one two-1200">
	<div class="nine-tenth"><p>{{ $episode['show_name'] }} - {{ $episode['sezn_title'] }}</p></div>
	<div class="tenth"><p class="pull-right">Views: {{ $episode['count'] }}</p></div>
</div>

<script type="text/javascript">
	var episode = {!! json_encode($episode) !!};
	console.log('episode', episode);
	$('#vid').mediaelementplayer({
		startVloume: 1
	});
</script>

@endsection
