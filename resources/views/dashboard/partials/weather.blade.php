<div class="full third-1200">
	<article class="card card-green shadow">
		<header class="no- text-center bgText">Current</header>
		<footer>
			<p class="text-center bgText">{{ $weather['curr']['temp'] }} C</p>
			<p class="text-center mdText">Humidity: {{ $weather['curr']['humidity'] }}%</p>
			<p class="text-center mdText">{{ $weather['curr']['desc'] }}</p>
		</footer>
	</article>
</div>

<div class="full two-third-1200">
	<article class="card card-purple shadow">
		<header class="no- text-center bgText">Forecast</header>
		<footer>
		<table>
			<tbody>
				<tr>
				@foreach($weather['fore'] as $key => $value)
					<td>{{ $value['time'] }}</td>
				@endforeach
				</tr>
				<tr>
				@foreach($weather['fore'] as $key => $value)
					<td>{{ $value['temp'] }} C</td>
				@endforeach
				</tr>
				<tr>
				@foreach($weather['fore'] as $key => $value)
					<td>{{ $value['cond'] }}</td>
				@endforeach
				</tr>
			</tbody>
		</table>
		
		</footer>
	</article>
</div>

<script type="text/javascript">
	
</script>