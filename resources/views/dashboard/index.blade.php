@extends('layouts.dash_layout')
@section('title', ' | Dashboard')

@section('content')

<div class="flex one two-1200 marginT20">

    <div class="two-third pull-left">
        <article class="card card-tp">
            <header class="center-text bot-bor"><h3>News</h3></header>
            <footer><p>Coming soon . . .<p></footer>
        </article>
    </div>

    <div class="third pull-right">
        <article class="card card-tp">
            <header class="bot-bor">
                <h3>Upcoming Events</h3>
                <label for="modal"><span class="pull-right bgText icon" onclick="showAddEvent();"><b>&#65291;</b></span></label>
            </header>
            <footer>
                @include('dashboard.partials.upcoming_events')
            </footer>
        </article>
    </div>

</div>

<script type="text/javascript">
    function showAddEvent() {
        var mobody = '<form id="formNewEvent" onsumbit="">'
                        +'<input type="text" class="marginB10" placeholder="Event title" required>'
                        +'<input type="text" class="marginB10" placeholder="Event description" required>'
                        +'<label>Event Date</label>'
                        +'<input type="date" class="marginB10" required>'
                        +'<label>Event Time</label>'
                        +'<input type="text" class="marginB20" required>'
                        +'<label><input type="radio" name="public" value="public" class="marginB10" required><span class="checkable">Public</span></label>'
                        +'<label><input type="radio" name="public" value="private" class="marginB10" required><span class="checkable">Private</span></label>'
                        +'<br><br>'
                        +'<button type="submit" class="">Submit</button>'
                    +'</form>'

        $('#model_title').html('Add New Event');
        $('#model_body').html(mobody);
        // $('#model_footer').html('Add Event');
    }
</script>

@endsection
