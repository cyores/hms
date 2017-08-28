@extends('layouts.dash_layout')
@section('title', ' | Dashboard')

@section('content')

<style type="text/css">
    .ui-timepicker-wrapper { z-index: 9999999;  width: 150px; }
</style>

<div class="flex one two-1200 marginT20">

    <div class="full two-third-1200">
        <article class="card card-tp">
            <header class="bot-bor"><h3>Updates</h3></header>
            <footer>
                <div class="flex three">
                    @include('dashboard.partials.weather')
                </div>
            </footer>
        </article>
    </div>

    <div class="full third-1200">
        <article class="card card-tp">
            <header class="flex two bot-bor">
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
        var mobody = '<form id="formNewEvent" onsubmit="submitNewEvent(); return false;">'
                        +'<input id="event-title" type="text" class="marginB10" placeholder="Event title" required>'
                        +'<input id="event-desc" type="text" class="marginB10" placeholder="Event description" required>'
                        +'<div id="date-time" class="flex one two-1200">'
                            +'<div class="half">'
                                +'<label>Event Date</label>'
                                +'<input type="date" id="event-date" class="marginB10" required />'
                            +'</div>'
                            +'<div class="half">'
                                +'<label>Event Time</label>'
                                +'<input type="text" id="event-time" class="marginB20" required />'
                            +'</div>'
                        +'</div>'
                        +'<label><input type="radio" name="isPublic" value="Y" class="marginB10" required><span class="checkable">Public</span></label>'
                        +'<label><input type="radio" name="isPublic" value="N" class="marginB10" required><span class="checkable">Private</span></label>'
                        +'<br><br>'
                        +'<button type="submit" class="default">Submit</button>'
                    +'</form>';

        $('#model_title').html('Add New Event');
        $('#model_body').html(mobody);

        $('#event-time').timepicker({ 'scrollDefault': 'now' });
    }

    
    function submitNewEvent() {
        console.log('Submitting new event');
        var formData = new FormData();
        formData.append('title', $("#event-title").val());
        formData.append('desc', $("#event-desc").val());
        formData.append('date', $("#event-date").val());
        formData.append('time', $("#event-time").val());
        formData.append('public', $('input[name=isPublic]:checked', '#formNewEvent').val());

        $.ajax({
            url: '/dashboard/newevent',
            type: 'POST',
            xhr: function() {
                var mxXhr = $.ajaxSettings.xhr();
                return mxXhr;
            },
            success: function() {
                console.log('Successfully added new event');
                $(".modal").hide();
            },
            error: function() {
                console.log('There was an error adding new event');
            },
            // Actual data
            data: formData,
            // Options to tell jQuery not to process data or worry about content-type.
            cache: false, contentType: false, processData: false
        });
    }
</script>

@endsection
