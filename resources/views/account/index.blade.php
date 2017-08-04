@extends('layouts.account_layout')
@section('title', ' | Account')

@section('content')

<style type="text/css">
    .ui-timepicker-wrapper { z-index: 9999999;  width: 150px; }
</style>

<div class="flex tabs two">

    <input id='tab-1' type='radio' name='tabgroupB' checked />
    <label class="pseudo button toggle marginB20" for="tab-1">Account Info</label>
    <input id='tab-2' type='radio' name='tabgroupB'>
    <label class="pseudo button toggle marginB20" for="tab-2">Settings</label>

    <div class="row" style="background-color: rgba(240,240,240,0);">
        <div>
            {{-- <h3>Account Details</h3> --}}
            <div class="full two-third-1200" style="margin: 0 auto;">
                <p class="mdText">Name</p>
                <input id="name" type="text" value="{{ $user['name'] }}" disabled>
                <br><br>
                <p class="mdText">Email</p>
                <input id="name" type="text" value="{{ $user['email'] }}" disabled>
                <p class="marginB50"></p>
            </div>
        </div>
        <div>
            {{-- <h3>Edit Settings</h3> --}}
            <div class="full two-third-1200" style="margin: 0 auto;">
                <p class="mdText">No editable settings yet</p>
            </div>
        </div>
    </div>
   
</div>

<script type="text/javascript">

</script>

@endsection
