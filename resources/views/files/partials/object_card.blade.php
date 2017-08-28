<style type="text/css">
	.obj_card { cursor: pointer; }
</style>

<div id="{{ $object['path'] }}" class="half fourth-700 sixth-1200">

	@if($object['type'] == 'folder')<a href="/files/{{ $object['path'] }}" class="obj_card">@endif

			<div class="stack bg-blue pad10 link smText">{{ $object['name'] }}</div>

			<img class="stack bg-blue pad10" src="/images/file_types/{{ $object['type'] }}.svg">

			<div class="stack bg-blue pad5">
				<img src="/images/icons/download.svg" class="marginT5">
				<label for="modal"><img src="/images/icons/delete.svg" class="marginT5 pull-right" onclick='delModal("{{ $object['path'] }}")'></label>
			</div>

	@if($object['type'] == 'folder')</a>@endif

</div>

<script type="text/javascript">
function delModal(path) {
	console.log(path);
	var body =   '<p class="marginB20">Are you sure you want to delete this?</p>';
				// +'<label for="model" class="button default marginT10" onclick="delObj(\''+path+'\')">Confirm</label>';

	$('#model_title').html('Confirm Delete');
    $('#model_body').html(body);
    $('#model_footer').html('<label for="modal" class="button default" onclick="delObj(\''+path+'\')">Confirm</label>');
}

function delObj(path) {
	console.log('Deleting object');
	var formData = new FormData();

	formData.append('path', path);

	$.ajax({
            url: '/files/delete',
            type: 'POST',
            xhr: function() {
                var mxXhr = $.ajaxSettings.xhr();
                return mxXhr;
            },
            success: function() {
                console.log('Successfully deleted object');
                $("[id='"+path+"']").remove();
                // $(".modal").hide();
            },
            error: function() {
                console.log('There was an error deleting that object');
            },
            // Actual data
            data: formData,
            // Options to tell jQuery not to process data or worry about content-type.
            cache: false, contentType: false, processData: false
        });
}
</script>