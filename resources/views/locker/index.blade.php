@extends('layouts.minimal_layout')
@section('title', ' | Locker')

@section('content')

<h1>Locker</h1>

<input class="full" id="search" type="search" placeholder="Search" onkeyup="search()" autofocus>

<div class="flex one three-1200" id="results" style="min-height: 575px;">

</div>

<div class="action-btn-group">
    <label for="modal">
        <div class="action-btn bg-orange" onclick="newEntryModal()">
            <img class="img-responsive" src="/images/icons/plus.svg">
        </div>
    </label>
</div>

@endsection

<script type="text/javascript">
function newEntryModal() {
    var body = '';

    $('#model_title').html('New Entry');
    $('#model_body').html(body);
}
function search() {
    console.log('Searching . . .');

}
</script>
