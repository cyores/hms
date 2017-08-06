
<label for="modal">
	<div class="action-btn bg-yellow pull-right" onclick="uploadModal()">
		<img class="img-responsive" src="/images/icons/upload.svg">
	</div>
</label>

<script type="text/javascript">
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
</script>