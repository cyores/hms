
<div id="{{ $movie['movie_id'] }} " class="fourth pad10">
	<a href="/movies/{{ $movie['movie_id'] }}"><img class="stack " src="images/default-movie.png"></a>
	<a href="/movies/{{ $movie['movie_id'] }}" class="button btn-a stack">{{ $movie['title'] }}</a>
	<a href="/movies/{{ $movie['movie_id'] }}" class="button btn-a stack">Rating: {{ $movie['rating'] }} <span class="pull-right">Views: {{ $movie['count'] }}</span></a>
</div>
