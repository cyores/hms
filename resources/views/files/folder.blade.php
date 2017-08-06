@extends('layouts.minimal_layout')
@section('title', ' | My Files')

@section('content')

<style type="text/css">
	
</style>

{{-- Breadcrumb nav --}}
<div class="flex one">
	<ol class="breadcrumb marginT20">
		<li class=""><a href="/files">{{ $user_name }}</a></li>
	</ol>
</div>


<div class="flex one four-700 six-1200">
	@if(!empty($objects))
		@foreach($objects as $key => $object)
			@include('files.partials.object_card')
		@endforeach
	@else
		<p class="mdText">Nothing here.</p>
	@endif
</div>

<script type="text/javascript">
	

	var path = "{!! $path !!}";
	var pathparts = path.split("/");

	// index 0 will be user id
	console.log(pathparts);
	for (var i = 1; i < pathparts.length; i++) {
		if(i == (pathparts.length - 1)) $('.breadcrumb').append('<li class="active">'+pathparts[i]+'</li>');
		else $('.breadcrumb').append('<li class=""><a href="/files/-'+pathparts[i]+'">'+pathparts[i]+'</a></li>');
	}


</script>

@endsection