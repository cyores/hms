@extends('layouts.movies_layout')
@section('title', ' | Movies & TV')

@section('content')

<h1>Movies</h1>

<div class="flex one four-1200">
    @foreach($movies as $key => $movie)
        @include('movies.partials.card', $movie)
    @endforeach    
</div>


<script type="text/javascript">

</script>

@endsection
