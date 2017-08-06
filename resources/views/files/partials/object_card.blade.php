<style type="text/css">
	.obj_card {
		cursor: pointer;
	}
	.no-brd-bot-rad {
		border-bottom-right-radius: 0px !important;
		border-bottom-left-radius: 0 !important; 
	}
	div:hover > .shadow {
		box-shadow: 0 3px 8px 0 rgba(0,0,0,0.2), 0 0 0 1px rgba(0,0,0,0.08);
	}
</style>

@if($object['type'] == 'folder')
<div class="half fourth-700 sixth-1200 pad10 obj_card">
	<a class="shadow" href="/files/{{ $object['path'] }}">
		<img class="stack shadow bg-dk-grey no-brd-bot-rad pad10" src="/images/file_types/folder.svg">
	</a>
	<a href="/files/{{ $object['path'] }}" class="stack shadow bg-yellow pad10 link smText">{{ $object['name'] }}</a>
</div>

@else
<div class="half fourth-700 sixth-1200 pad10 obj_card">
	<div class="shadow"><img class="stack shadow bg-dk-grey no-brd-bot-rad pad10" src="/images/file_types/{{ $object['type'] }}.svg"></div>
	<div class="stack shadow bg-yellow pad10 link smText">{{ $object['name'] }}</div>
</div>

@endif