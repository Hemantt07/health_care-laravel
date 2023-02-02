
$(document).ready(function () {

    $.ajaxSetup({
        headers:{
            'X-CSRF-TOKEN' : $('meta[name="csrf-token"]').attr('content')
        }
    });

    var calendar = $('#calendar').fullCalendar({
        editable: true,
        timeZone: "UTC",
        header:{
            left:'prev, next today',
            right:'title',
            center:'month, agendaWeek, agendaDay'
        },
        events:'/my-appointments',
        selectable:true,
        selectHelper:true,
    });

    $( '.fc-day-grid-event' ).click( function(){
        
    } );
});