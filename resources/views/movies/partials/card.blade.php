
<div id="{{ $movie['movie_id'] }} " class="full half-700 fourth-1200 margin0 pad20">
	<img class="stack" src="images/default-movie.png" onclick="navTo('/movies/{{ $movie['movie_id'] }}')" style="cursor: pointer;">
	<a href="/movies/{{ $movie['movie_id'] }}" class="button btn-a stack">{{ $movie['title'] }}</a>
	<a href="/movies/{{ $movie['movie_id'] }}" class="button btn-a stack">Rating: {{ $movie['rating'] }} <span class="pull-right">Views: {{ $movie['count'] }}</span></a>
</div>

<script type="text/javascript">
	function navTo(link) {
		window.location = link;
	}
</script>