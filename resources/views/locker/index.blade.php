@extends('layouts.minimal_layout')
@section('title', ' | Locker')

@section('content')

<style type="text/css">
    tr:nth-child(even) { background-color: rgba(0,0,0,0); }
    td > img { cursor: pointer; }
</style>

<h1>Locker</h1>

<input class="full" id="search" type="search" placeholder="Search" onkeyup="search()" autofocus>

<div class="flex one three-1200 marginT10" id="results" style="min-height: 575px;">
    
</div>

<div class="action-btn-group">
    <label for="modal">
        <div class="action-btn bg-secondary" onclick="newEntryModal()">
            <img class="img-responsive" src="/images/icons/plus.svg">
        </div>
    </label>
</div>

<script type="text/javascript">

function newEntryModal() {
    var body =   '<form class="pad30" onsubmit="newEntry();">'
                    +'<input id="servi" class="marginT10" type="text" placeholder="Service" required>'
                    +'<input id="email" class="marginT10" type="email" placeholder="Email">'
                    +'<input id="usern" class="marginT10" type="text" placeholder="Username">'
                    +'<input id="passw" class="marginT10" type="text" placeholder="Password" required>'
                    +'<button class="default marginT10" type="submit">Submit</button>'
                +'</form>';

    $('#model_title').html('New Entry');
    $('#model_body').html(body);
    $('#model_footer').html('');
}

function newEntry() {
    console.log('Creating new entry');
    var formData = new FormData();

    formData.append('service', $('#servi').val());
    formData.append('email', $('#email').val());
    formData.append('username', $('#usern').val());
    formData.append('password', $('#passw').val());

    $.ajax({
        url: '/locker/newentry',
        type: 'POST',
        xhr: function() {
            var mxXhr = $.ajaxSettings.xhr();
            return mxXhr;
        },
        success: function() {
            console.log('Successfully added new entry');
            // $(".modal").hide();
        },
        error: function() {
            console.log('There was an error adding new entry');
        },
        // Actual data
        data: formData,
        // Options to tell jQuery not to process data or worry about content-type.
        cache: false, contentType: false, processData: false
    });
    
}

function search() {
    console.log('Searching . . .');
    var formData = new FormData();
    formData.append('query', $('#search').val());

    if($('#search').val() == '' || $('#search').val() == ' '){
        $('#results').empty();
        return;
    }

    $.ajax({
        url: '/locker/search',
        type: 'POST',
        dataType: 'json',
        xhr: function() {
            var mxXhr = $.ajaxSettings.xhr();
            return mxXhr;
        },
        success: function(data) {
            $('#results').empty();

            if(data.length == 0) {
                $('#results').append('<p class="hgText">No results . . . </p>');
            }
            else {
                for (var i = 0; i < data.length; i++) {
                    result = data[i];
                    $('#results').append(buildCard(result['service'], result['email'], result['username'], result['password'], result['entry_id']));
                } 
            }
            
        },
        error: function(data) {
            console.log('There was an error');
        },
        // Actual data
        data: formData,
        // Options to tell jQuery not to process data or worry about content-type.
        cache: false, contentType: false, processData: false
    });

}

function buildCard(service, email, username, password, id) {
    var card =  '<div class="third" id="card_'+id+'">'
                    +'<article class="card card-secondary">'
                        +'<header>' 
                            +'<p class="mdText">'+ service 
                            +'<label for="modal"><img class="pull-right" src="/images/icons/delete.svg" onclick="deleteModal('+id+');"></label>'
                            +'<a href="/locker/edit/'+id+'"><img class="pull-right marginR5" src="/images/icons/edit.svg"></a>'
                            +'</p>'
                        +'</header>'
                        +'<footer >'
                            +'<table>'
                                +'<tbody>'
                                    +'<tr>'
                                        +'<td><p><b>Email</b></p></td>'
                                        +'<td><p id="clip-email-'+id+'">'+email+'</p></td>'
                                        +'<td><img class="pull-right" src="/images/icons/copy.svg" onclick="copy(\'clip-email-'+id+'\');"></td>'
                                    +'</tr>'
                                    +'<tr>'
                                       +'<td><p><b>Username</b></p></td>'
                                        +'<td><p id="clip-usr-'+id+'">'+username+'</p></td>'
                                        +'<td><img class="pull-right" src="/images/icons/copy.svg" onclick="copy(\'clip-usr-'+id+'\');"></td>'
                                    +'</tr>'
                                    +'<tr>'
                                        +'<td><p><b>Password</b></p></td>'
                                        +'<td><p id="clip-pswd-'+id+'">'+password+'</p></td>'
                                        +'<td><img class="pull-right" src="/images/icons/copy.svg" onclick="copy(\'clip-pswd-'+id+'\');"></td>'
                                    +'</tr>'
                                +'</tbody>'
                            +'</table>'
                        +'</footer>'
                    +'</article>'
                +'</div>';

    return card;
}

function deleteModal(id) {
    var body =   '<form onsubmit="deleteEntry('+id+'); return false;">'
                    +'<p class="mdText">Are you sure you want to delete this?</p>'
                    +'<button class="default marginT10" type="submit">Delete</button>'
                +'</form>';

    $('#model_title').html('Confirmation');
    $('#model_body').html(body);
    $('#model_footer').html('');
}

function deleteEntry(id) {
    console.log('Deleting entry');
    var formData = new FormData();
    formData.append('entry_id', id);

    $.ajax({
        url: '/locker/delete',
        type: 'POST',
        xhr: function() {
            var mxXhr = $.ajaxSettings.xhr();
            return mxXhr;
        },
        success: function() {
            console.log('Successfully deleted');
            $(".modal").hide();
            $("#card_" + id).remove();            
        },
        error: function() {
            console.log('There was an error');
        },
        // Actual data
        data: formData,
        // Options to tell jQuery not to process data or worry about content-type.
        cache: false, contentType: false, processData: false
    });
}

function copy(id) {
    var contents = $('#' + id).text();

    var aux = document.createElement("input");
    aux.setAttribute("value", contents);
    document.body.appendChild(aux);
    aux.select();
    document.execCommand("copy");
    document.body.removeChild(aux);

    console.log('Copied:', contents, id);
}

</script>

@endsection