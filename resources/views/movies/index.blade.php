@extends('layouts.minimal_layout')
@section('title', ' | Movies & TV')

@section('content')

<style type="text/css">

</style>

<div class="flex one two-1200">
	<div class="four-fifth"><h1>Movies</h1></div>
	<div class="fifth pad10 padT20"><button class="default pull-right" onclick="scan()">Scan for Movies</button></div>
</div>

<div class="flex one">
    <input class="full" id="search" type="search" placeholder="Search" onkeyup="showResults()">
    <div class="full pad0"><div id="results" class="pad10" style="position: fixed; border-radius: 4px"></div></div>
</div> 

<div id="movie-list">
@foreach($movies as $key => $letter)
        <div class="flex bot-bor"><h2>{{ $key }}</h2></div>
        <div class="flex one four-1200 pad20">
            @foreach($letter as $k => $movie)
                @include('movies.partials.card', $movie)
            @endforeach
        </div>
@endforeach
</div>

<div id="result-list" class="flex one four-1200 pad20" style="display: none;"></div>


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

        if($('#search').val() == '') {
            $('#result-list').empty().hide();
            $('#movie-list').show();
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
                $('#movie-list').hide();
                $('#result-list').empty();
                $('#result-list').show();

                for (var i = 0; i < data.length; i++) {
                    $('#result-list').append(data[i]);
                }

                if(data.length == 0) $('#result-list').append('<p class="hgText">No results . . . </p>');
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
