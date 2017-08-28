<div class="">
@if(!empty($upcoming_events))
	@foreach($upcoming_events as $key => $event)
		@if($event['public'] == 'Y')
			<div class="event marginB20 bg-yellow shadow">
		@else
			<div class="event marginB20 bg-red shadow">
		@endif		
			<p class="mdText"><b>{{ $event['title'] }}</b></p>
			<p class="smText">{{ $event['desc'] }}</p>
			<p class="smText">{{ $event['date'] }} @ {{ $event['time'] }}</p>
		</div>
	@endforeach

@else
	<div class="event marginB20">
		<p class="mdText">No upcoming events.</p>
	</div>
@endif
</div>
