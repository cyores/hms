<style type="text/css">
	
</style>

<div class="full third-1200">
	<article class="card card-primary shadow">
		<header class="no- text-center bgText">Current</header>
		<footer>
			<p class="text-center bgText">{{ $weather['curr']['temp'] }} C</p>
			<p class="text-center mdText">Humidity: {{ $weather['curr']['humidity'] }}%</p>
			<p class="text-center mdText">{{ $weather['curr']['desc'] }}</p>
		</footer>
	</article>
</div>

<div class="full two-third-1200">
	<article class="card card-secondary shadow">
		<header class="no- text-center bgText">Forecast</header>
		<footer>
		<table width="100%">
			<tbody>
				<tr>
				@foreach($weather['fore'] as $key => $value)
					<td class="text-center" style="border: 1px solid black">{{ $value['time'] }}</td>
				@endforeach
				</tr>
				<tr>
				@foreach($weather['fore'] as $key => $value)
					<td class="text-center" style="border: 1px solid black">{{ $value['temp'] }} C</td>
				@endforeach
				</tr>
				<tr>
				@foreach($weather['fore'] as $key => $value)
					<td class="text-center" style="border: 1px solid black">{{ $value['cond'] }}</td>
				@endforeach
				</tr>
			</tbody>
		</table>
		
		</footer>
	</article>
</div>

<script type="text/javascript">
	
</script>