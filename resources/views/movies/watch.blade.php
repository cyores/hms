@extends('layouts.movies_layout')
@section('title', ' | Watch')

@section('content')

<style type="text/css">
	main {
		background-color: #333;
		color: #fff;
	}
</style>

<h1>{{ $movie['title'] }}</h1>

<video width="100%" controls>
  <source src="http://media.hms.dev/{{ $movie['path'] }}" type="video/mp4">
</video>

<div class="flex one two-1200">
	<div class="half"><p>Rating: {{ $movie['rating'] }}</p></div>
	<div class="half"><p class="pull-right">Views: {{ $movie['count'] }}</p></div>
</div>

<script type="text/javascript">

</script>

@endsection
