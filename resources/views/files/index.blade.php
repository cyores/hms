@extends('layouts.minimal_layout')
@section('title', ' | My Files')

@section('content')

<style type="text/css">
	
</style>

{{-- Breadcrumb nav --}}
<div class="flex one">
	<ol class="breadcrumb marginT20">
		<li class="active">{{ $user_name }}</li>
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

@include('files.partials.upload')

<script type="text/javascript">
	var path = "{!! $path !!}";
	var pathparts = path.split("/");
</script>

@endsection