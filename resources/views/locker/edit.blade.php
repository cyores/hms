@extends('layouts.minimal_layout')
@section('title', ' | Locker')

@section('content')

<style type="text/css">
    tr:nth-child(even) { background-color: rgba(0,0,0,0); }
</style>

<h1>Edit {{ $entry['service'] }}</h1>

<div class="flex one two-1200">

    <div class="full half-1200">
        <article class="card card-orange">
            <header>Current</header>
            <footer>
                <table class="full">
                    <tbody>
                        <tr>
                            <td><p class="mdText"><b>Service</b></p></td>
                            <td><p class="mdText">{{ $entry['service'] }}</p></td>
                            <td><img class="pull-right" src="/images/icons/copy.svg"></td>
                        </tr>
                        <tr>
                            <td><p class="mdText"><b>Email</b></p></td>
                            <td><p class="mdText">{{ $entry['email'] }}</p></td>
                            <td><img class="pull-right" src="/images/icons/copy.svg"></td>
                        </tr>
                        <tr>
                            <td><p class="mdText"><b>Username</b></p></td>
                            <td><p class="mdText">{{ $entry['username'] }}</p></td>
                            <td><img class="pull-right" src="/images/icons/copy.svg"></td>
                        </tr>
                        <tr>
                            <td><p class="mdText"><b>Password</b></p></td>
                            <td><p class="mdText">{{ $entry['password'] }}</p></td>
                            <td><img class="pull-right" src="/images/icons/copy.svg"></td>
                        </tr>
                        <tr>
                            <td><p class="mdText"><b>Created At</b></p></td>
                            <td><p class="mdText">{{ $entry['created_at'] }}</p></td>
                            <td><img class="pull-right" src="/images/icons/copy.svg"></td>
                        </tr>
                        <tr>
                            <td><p class="mdText"><b>Last Updated</b></p></td>
                            <td><p class="mdText">{{ $entry['updated_at'] }}</p></td>
                            <td><img class="pull-right" src="/images/icons/copy.svg"></td>
                        </tr>
                    </tbody>
                </table>
            </footer>
        </article>
    </div>

    <div class="full half-1200">
        <article class="card card-blue">
            <header>Make Changes</header>
            <footer>
                <table class="full">
                    <tbody>
                        <tr>
                            <td><p class="mdText"><b>Service</b></p></td>
                            <td><input id="service" type="text" value="{{ $entry['service'] }}" onclick="showSubmit()"></td>
                        </tr>
                        <tr>
                            <td><p class="mdText"><b>Email</b></p></td>
                            <td><input id="email" type="email" value="{{ $entry['email'] }}" onclick="showSubmit()"></td>
                        </tr>
                        <tr>
                            <td><p class="mdText"><b>Username</b></p></td>
                            <td><input id="user" type="text" value="{{ $entry['username'] }}" onclick="showSubmit()"></td>
                        </tr>
                        <tr>
                            <td><p class="mdText"><b>Password</b></p></td>
                            <td><input id="password" type="text" value="{{ $entry['password'] }}" onclick="showSubmit()"></td>
                        </tr>
                        <tr>
                            <td><p class="mdText"><b>Created At</b></p></td>
                            <td><p class="mdText">{{ $entry['created_at'] }}</p></td>
                        </tr>
                        <tr>
                            <td><p class="mdText"><b>Last Updated</b></p></td>
                            <td><p class="mdText">{{ $entry['updated_at'] }}</p></td>
                        </tr>
                        <tr id="row-submit" style="display: none;">
                            <td colspan="2" class="pad30"><button class="full default" onclick="applyChanges()">Submit Changes</button></td>
                        </tr>
                    </tbody>
                </table>
            </footer>
        </article>
    </div>
</div>

<script type="text/javascript">

var entry_id = {!! $entry['entry_id'] !!}

console.log('Entry ID:', entry_id);

function showSubmit() {
    $('#row-submit').fadeIn(750);
}

function applyChanges() {
    console.log('Applying changes . . . ');
    var formData = new FormData();
    formData.append('service', $('#service').val());
    formData.append('email', $('#email').val());
    formData.append('username', $('#user').val());
    formData.append('password', $('#password').val());
    formData.append('entry_id', entry_id);

    $.ajax({
        url: '/locker/edit/applychanges',
        type: 'POST',
        xhr: function() {
            var mxXhr = $.ajaxSettings.xhr();
            return mxXhr;
        },
        success: function() {
            console.log('Successfully updated entry');
            location.reload();
        },
        error: function() {
            console.log('There was an error updating entry');
        },
        // Actual data
        data: formData,
        // Options to tell jQuery not to process data or worry about content-type.
        cache: false, contentType: false, processData: false
    });
}

</script>
@endsection


