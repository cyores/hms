@extends('layouts.minimal_layout')
@section('title', ' | My Files')

@section('content')

<style type="text/css">
	
</style>

{{-- Breadcrumb nav --}}
<div class="flex one">
	<ol class="breadcrumb marginT20">
		<li class=""><a href="/files">{{ $user_name }}</a></li>
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

<div class="action-btn-group">
	<label for="modal">
		<div class="action-btn bg-yellow" onclick="folderModal()">
			<img class="img-responsive" src="/images/icons/new-folder.svg">
		</div>
	</label>

	<label for="modal">
		<div class="action-btn bg-yellow" onclick="uploadModal()">
			<img class="img-responsive" src="/images/icons/upload.svg">
		</div>
	</label>
</div>

<script type="text/javascript">
	

	var path = "{!! $path !!}";
	var pathparts = path.split("/");

	// index 0 will be user id
	for (var i = 1; i < pathparts.length; i++) {
		if(i == (pathparts.length - 1)) $('.breadcrumb').append('<li class="active">'+pathparts[i]+'</li>');
		else $('.breadcrumb').append('<li class=""><a href="/files/'+pathparts[i]+'">'+pathparts[i]+'</a></li>');
	}

	function uploadModal() {
		console.log('File path', path);
		var body =   '<p class="marginB20">Upload files to '+pathparts[pathparts.length - 1]+'</p>'
					+'<form class="marginB10" id="formFiles" onsubmit="uploadFiles()">'
						+'<input class="marginB10" id="files" type="file" multiple required>'
						+'<button type="submit">Submit</button>'
					+'</form>'

		$('#model_title').html('Upload Files');
        $('#model_body').html(body);
	}

	function uploadFiles() {
		console.log('Uploading files');

		var formData = new FormData();
		formData.append('path', path);
		
		if($('#files').length == 0) {
			formData.append('files_exist', 'false');
		}
		else {
			formData.append('files_exist', 'true');
			var numFiles = $('#files')[0].files.length;
			for (var i = 0; i < numFiles; i++) {
				formData.append('file_' + i, $('#files')[0].files[i]);
			}
		}

		$.ajax({
            url: '/files/upload',
            type: 'POST',
            xhr: function() {
                var mxXhr = $.ajaxSettings.xhr();
                return mxXhr;
            },
            success: function() {
                console.log('Successfully uploaded files');
            },
            error: function() {
                console.log('There was an error uploading files');
            },
            // Actual data
            data: formData,
            // Options to tell jQuery not to process data or worry about content-type.
            cache: false, contentType: false, processData: false
        });
	}

	function folderModal() {
		console.log('File path', path);
		var body =   '<p class="marginB20">Create new folder in '+pathparts[pathparts.length - 1]+'</p>'
					+'<form class="marginB10" id="formFiles" onsubmit="uploadFiles()">'
						+'<input class="marginB10" id="folder-name" type="text" placeholder="Folder Name" required>'
						+'<button type="submit" class="default">Submit</button>'
					+'</form>'

		$('#model_title').html('New Folder');
        $('#model_body').html(body);
	}

	function createFolder() {
		console.log('Creating folder');
		var formData = new FormData();
		formData.append('name', $('#folder-name').val());
		formData.append('path', path);

		$.ajax({
            url: '/files/newfolder',
            type: 'POST',
            xhr: function() {
                var mxXhr = $.ajaxSettings.xhr();
                return mxXhr;
            },
            success: function() {
                console.log('Successfully created folder');
                // $(".modal").hide();
            },
            error: function() {
                console.log('There was an error creating that folder');
            },
            // Actual data
            data: formData,
            // Options to tell jQuery not to process data or worry about content-type.
            cache: false, contentType: false, processData: false
        });
	}

</script>

@endsection