<div id="{{ $value['id'] }} " class="full half-700 fourth-1200 margin0 pad20">

	@if($value['type'] == 'episode')
		<a href="{{ $value['link'] }}" class="button btn-a stack">Episode {{ $value['epis_num'] }}</a>
	@endif

	<a href="{{ $value['link'] }}"><img class="stack" src="{{ $value['poster'] }}"></a>

	@if($value['type'] != 'show')
		<a href="{{ $value['link'] }}" class="button btn-a stack">{{ $value['title'] }}</a>
	@endif
	
</div>
