@extends('layouts.minimal_layout')
@section('title', ' | Movies & TV')

@section('content')

<div class="flex one two-1200">
	<div class="four-fifth"><h1>Movies</h1></div>
	<div class="fifth pad10 padT20"><button class="default pull-right" onclick="scan()">Scan for Movies</button></div>
</div>

<div class="flex one four-1200">
    @foreach($movies as $key => $movie)
        @include('movies.partials.card', $movie)
    @endforeach    
</div>


<script type="text/javascript">

	function scan() {
		console.log('Scanning for movies');
        $.ajax({
            url: '/movies/scan',
            type: 'POST',
            xhr: function() {
                var mxXhr = $.ajaxSettings.xhr();
                return mxXhr;
            },
            success: function() {
                console.log('Scan complete');
                location.reload();
            },
            error: function() {
                console.log('There was an error');
            },
            // Options to tell jQuery not to process data or worry about content-type.
            cache: false, contentType: false, processData: false
        });
	}

</script>

@endsection
