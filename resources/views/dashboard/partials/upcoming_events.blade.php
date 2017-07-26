<div class="">
@if(!empty($events))
	@foreach($events as $key => $event)
		@if($event['public'] == 'Y')
			<div class="event marginB20 bg-yellow">
		@else
			<div class="event marginB20 bg-red" style="color: #F3F3F3;">
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
