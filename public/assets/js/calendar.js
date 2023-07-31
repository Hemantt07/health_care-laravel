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
            $event_id = info.id;
            $.ajax({
                url: route("create-appointment-modal", [ $event_id ]),
                success: function(result){
                    console.log(result)
                    var html = parseModalContent( result );
                    $( '#eventModal .modal-content' ).html( html )
                    $('#eventModal').modal( 'show' );
                }
            });
        }

    });

    const parseModalContent = ( content) => {
        return "<div class=modal-header><h5 class=modal-title id=exampleModalLabel>Appointment Details</h5><button type=button class=close data-dismiss=modal aria-label=Close><span aria-hidden=true>×</span></button></div><div class=modal-body><ul><li><b>Date : </b>"+ content.date +"</li><li><b>Doctor's Name : </b>"+ content.doctorName +"</li><li><b>Doctor's Number : </b><a href='tel:"+ content.doctorNumber +"'>"+ content.doctorNumber +"</a></li></ul></div><div class=modal-footer><button type=button class='btn btn-primary' data-dismiss=modal>Close</button><a type=button class='btn btn-primary' href="+ content.url +">View</a></div>"
    }

});