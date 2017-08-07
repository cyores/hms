
<div id="{{ $movie['movie_id'] }} " class="full half-700 fourth-1200 pad10">
	<a href="/movies/{{ $movie['movie_id'] }}"><img class="stack shadow" src="images/default-movie.png"></a>
	<a href="/movies/{{ $movie['movie_id'] }}" class="button btn-a stack shadow">{{ $movie['title'] }}</a>
	<a href="/movies/{{ $movie['movie_id'] }}" class="button btn-a stack shadow">Rating: {{ $movie['rating'] }} <span class="pull-right">Views: {{ $movie['count'] }}</span></a>
</div>
