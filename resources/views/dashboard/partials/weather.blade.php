<style type="text/css">
	
</style>

<div class="full third-1200">
	<article class="card card-primary shadow">
		<header class="no- text-center bgText">Current</header>
		<footer>
			<p class="text-center bgText">{{ $weather['curr']['temp'] }}&deg;</p>
			<p class="text-center mdText">Humidity: {{ $weather['curr']['humidity'] }}%</p>
			<p class="text-center mdText">{{ $weather['curr']['desc'] }}</p>
		</footer>
	</article>
</div>

<div class="full two-third-1200">
	<article class="card card-secondary shadow">
		<header class="no- text-center bgText" style=" border-color: #333333;">Forecast</header>
		<footer>
			<div class="padL5">
				<div class="flex five text-center">
					@foreach($weather['fore'] as $key => $value)
						<div class="fifth"><span>{{ $value['time']  }}:00</span></div>
					@endforeach
				</div>		
				<div class="flex five text-center" style="background-color: rgba(0,0,0,0.0);">
					@foreach($weather['fore'] as $key => $value)
						<div class="fifth"><span>{{ $value['temp']  }}&deg;</span></div>
					@endforeach
				</div>
				<div class="flex five text-center">
					@foreach($weather['fore'] as $key => $value)
						<div class="ffith"><span>{{ $value['cond']  }}</span></div>
					@endforeach
				</div>
			</div>
		</footer>
	</article>
</div>

<script type="text/javascript">
	
</script>