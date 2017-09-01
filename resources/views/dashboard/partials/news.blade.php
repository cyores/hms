
@foreach($news as $key => $value)
<a class="link" href="{{ $value['link'] }}" target="new">
	<div class="full">
		<article class="card card-blue shadow">
			<header class="mdText">{{ $value['title'] }}</header>
			<footer>
				<div class="flex two">
					<div class="fifth">
						<img class="img-responsive" src="{{ $value['image'] }}">
					</div>
					<div class="four-fifth">
						<p class="smText">{{ $value['desc'] }}</p>
						<p class="tyText">{{ $value['source'] }} - {{ $value['author'] }}</p>
						<p class="tyText">{{ $value['published'] }}</p>
					</div>
				</div>
			</footer>
		</article>
	</div>
</a>
@endforeach

<script type="text/javascript">
	
</script>