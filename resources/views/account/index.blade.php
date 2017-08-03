@extends('layouts.account_layout')
@section('title', ' | Account')

@section('content')

<style type="text/css">
    .ui-timepicker-wrapper { z-index: 9999999;  width: 150px; }
</style>

<div class="flex tabs two">

    <input id='tab-1' type='radio' name='tabgroupB' checked />
    <label class="pseudo button toggle" for="tab-1">Account Info</label>
    <input id='tab-2' type='radio' name='tabgroupB'>
    <label class="pseudo button toggle" for="tab-2">Settings</label>

    <div class="row">
        <div>
            <h3>Account Details</h3>
            <div class="full two-third-1200" style="margin: 0 auto;">
                <p class="mdText">Name</p>
                <input id="name" type="text" value="{{ $user['name'] }}" disabled>
                <br><br>
                <p class="mdText">Email</p>
                <input id="name" type="text" value="{{ $user['email'] }}" disabled>
            </div>
        </div>
        <div>
            <h3>Edit Settings</h3>
        </div>
    </div>
   
</div>

<script type="text/javascript">

</script>

@endsection
