@extends('layouts.minimal_layout')
@section('title', ' | ' . $seasons[0]["show_name"])

@section('banner')

<img class="img-responsive" src="{{ $seasons[0]['banner'] }}">

@endsection

@section('content')

<h1 style="font-size: 3.25em">{{ $seasons[0]['show_name'] }}</h1>

<div id="tv-list" class="flex one four-1200 pad20">
    @foreach($seasons as $key => $value)
            
                @include('tv.partials.card', $value)
            
    @endforeach
</div>


<div id="result-list" class="flex one four-1200 pad20" style="display: none;"></div>


<script type="text/javascript">



</script>

@endsection

@section('footer')

@endsection
