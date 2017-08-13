<div id="{{ $movie['movie_id'] }} " class="full half-700 fourth-1200 margin0 pad20">
	<a href="/movies/{{ $movie['movie_id'] }}"><img class="stack" src="images/default-movie.png"></a>
	<a href="/movies/{{ $movie['movie_id'] }}" class="button btn-a stack">{{ $movie['title'] }}</a>
	<a href="/movies/{{ $movie['movie_id'] }}" class="button btn-a stack">Rating: {{ $movie['rating'] }} <span class="pull-right">Views: {{ $movie['count'] }}</span></a>
</div>
