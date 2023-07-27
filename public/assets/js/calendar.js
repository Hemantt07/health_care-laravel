
$(document).ready(function () {

    $.ajaxSetup({
        headers:{
            'X-CSRF-TOKEN' : $('meta[name="csrf-token"]').attr('content')
        }
    });

    $('#calendar').fullCalendar({
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
        timeZone: "UTC",
        allDaySlot: false,
        showNonCurrentDates: false,
        dayCellContent: function (info, create) {
            const element = create(
                "span",
                { id: "fc-day-span-" + info.date.getDOY(), class: "day" },
                info.dayNumberText
            );
            return element;
        },
        eventClick: function ( info ) {
            console.log( info.id );
            let url;
            url = route("create-appointment-modal");
            $.ajax({
                url: url,
                success: function(result){
                    $("#div1").html(result);
                }
            });
            $('#eventModal').modal( 'show' );
        }

    });

});