@extends('layouts.minimal_layout')
@section('title', ' | TV')

@section('content')

<style type="text/css">

</style>

<div class="flex one two-1200">
	<div class="four-fifth"><h1>TV Shows</h1></div>
	<div class="fifth pad10 padT20"><button class="default pull-right" onclick="scan()">Scan for Shows</button></div>
</div>

<div id="tv-list" class="flex one four-1200 pad20">
    @foreach($shows as $key => $value)
            
                @include('tv.partials.card', $value)
            
    @endforeach
</div>


<div id="result-list" class="flex one four-1200 pad20" style="display: none;"></div>


<script type="text/javascript">

	function scan() {
		console.log('Scanning for tv');
        $.ajax({
            url: '/tv/scan',
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
