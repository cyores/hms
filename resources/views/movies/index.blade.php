@extends('layouts.minimal_layout')
@section('title', ' | Movies & TV')

@section('content')

<style type="text/css">

</style>

<div class="flex one two-1200">
	<div class="four-fifth"><h1>Movies</h1></div>
	<div class="fifth pad10 padT20"><button class="pull-right" onclick="scan()">Scan for Movies</button></div>
</div>

<div class="flex one">
    <input class="full" id="search" type="search" placeholder="Search" onkeyup="showResults()">
    <div class="full pad0"><div id="results" class="pad10" style="position: fixed; border-radius: 4px"></div></div>
</div> 

@foreach($movies as $key => $letter)
        <div class="flex bot-bor"><h2>{{ $key }}</h2></div>
        <div id="movie-list" class="flex one four-1200 pad20">
            @foreach($letter as $k => $movie)
                @include('movies.partials.card', $movie)
            @endforeach
        </div>
@endforeach


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

    function showResults() {
        console.log('Searching');
        var formData = new FormData();
        formData.append('query', $('#search').val());

        $('#results').html('').removeClass('bg-white');

        $('#results').show();

        if($('#search').val() == '') {
            $('#results').html('').removeClass('bg-white');
            return;
        }

        $.ajax({
            url: '/movies/search',
            type: 'POST',
            dataType: "json",
            xhr: function() {
                var mxXhr = $.ajaxSettings.xhr();
                return mxXhr;
            },
            success: function(data) {
                console.log('Searched', data);
                $('#movie-list').html('');
                for (var i = 0; i < data.length; i++) {
                    $('#results').append('<p><a class="link" href="/movies/'+data[i]['id']+'">'+data[i]['title']+'</a></p>');
                }
                $('#results').addClass('bg-white');
                if(data.length == 0) $('#results').append('<p class="padR30">No results . . .</p>');
            },
            error: function(data) {
                console.log('There was an error');
            },
            // Actual data
            data: formData,
            // Options to tell jQuery not to process data or worry about content-type.
            cache: false, contentType: false, processData: false
        });
    }

    function hideResults() {
        $('#results').hide();
    }

</script>

@endsection
