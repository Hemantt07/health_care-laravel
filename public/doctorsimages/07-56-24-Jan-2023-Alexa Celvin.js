Date.prototype.isLeapYear = function () {
    var year = this.getUTCFullYear();
    if ((year & 3) != 0) return false;
    return year % 100 != 0 || year % 400 == 0;
};

// Get Day of Year
Date.prototype.getDOY = function () {
    var dayCount = [0, 31, 59, 90, 120, 151, 181, 212, 243, 273, 304, 334];
    var mn = this.getUTCMonth();
    var dn = this.getUTCDate();
    var dayOfYear = dayCount[mn] + dn;
    if (mn > 1 && this.isLeapYear()) dayOfYear++;
    return dayOfYear;
};

/**
 * Modules
 */
function parseShiftResponse(res) {
    let bidHTML = "";
    for (let i = 0; i < res.length; i++) {
        let bidText =
            res[i].bidStatus == "" ? "BID" : res[i].bidStatus.toUpperCase();

        bidHTML += `<div class="bid-box d-flex justify-content-between mb-2 flex-md-row flex-column">
                  <div class="copy">
                      <p><a href="${res[i].hospitalUrl}">${res[i].location_name}</a><br><a href="/">${res[i].website}</a></p>
                      <ul class="mb-0 mt-2 nav">
                          <li class="mb-0 me-5">Shift hours: ${res[i].shiftHours}</li>
                          <li class="mb-0">Flexible? ${res[i].flexible}</li>
                      </ul>
                  </div>
                  <div class="cta"><a class="bttn smaller d-inline-flex py-2 text-decoration-none px-4" href="${res[i].bidUrl}">${bidText}</a></div>
              </div>`;
    }
    return bidHTML;
}

function parseBidRequestResponse(res) {
    let bidHTML = "";
    for (let i = 0; i < res.length; i++) {
        let bidAcceptText = "Accept";
        let bidDeniedText = "Deny";

        bidHTML += `<div class="bid-box d-flex justify-content-between mb-2 flex-md-row flex-column">
                    <div class="copy">
                        <p><a href="">${res[i].location_name}</a><br><a href="/">${res[i].website}</a></p>
                        <ul class="mb-0 mt-2 nav">
                            <li class="mb-0 me-5">Shift hours: ${res[i].shiftHours}</li>
                            <li class="mb-0">Flexible? ${res[i].flexible}</li>
                        </ul>
                    </div>
                    <div class="cta"><a class="ad-bid-request accept-bid-request bttn smaller d-inline-flex py-2 text-decoration-none px-4" href="${res[i].bidUrl}" bid-req-id="${res[i].id}">${bidAcceptText}</a>
                    <a class="ad-bid-request deny-bid-request bttn smaller d-inline-flex py-2 text-decoration-none px-4 mt-4" href="${res[i].bidUrl}" bid-req-id="${res[i].id}">${bidDeniedText}</a></div>
                </div>`;
    }
    return bidHTML;
}

function toLocaleUTCDateString(date, locales, options) {
    const timeDiff = date.getTimezoneOffset() * 60000;
    const adjustedDate = new Date(date.valueOf() + timeDiff);
    return adjustedDate.toLocaleDateString(locales, options);
}

document.addEventListener("DOMContentLoaded", function () {
    var calendarEl = document.getElementById("calendar");
    var calendar = new FullCalendar.Calendar(calendarEl, {
        initialView: "dayGridMonth",
        timeZone: "UTC",
        allDaySlot: false,
        showNonCurrentDates: false,
        dateClick: function (info) {
            if (info.view.type == "dayGridMonth") {
                if (calendar) {
                    calendar.changeView("timeGridDay");

                    $(".switch-button")
                        .addClass("d-flex")
                        .removeClass("d-none");
                    $(".switch-button.daily")
                        .addClass("d-none")
                        .removeClass("d-flex");

                    calendar.gotoDate(info.date);
                    calendar.refetchEvents();
                }
            }
        },
        dayCellContent: function (info, create) {
            const element = create(
                "span",
                { id: "fc-day-span-" + info.date.getDOY(), class: "day" },
                info.dayNumberText
            );
            return element;
        },
        eventClick: function (info) {
            let shift_date = "";
            let available_shifts = "";
            let url = "";
            console.log(info.event);
            if (info.event.extendedProps.type == "Request") {
                shift_date =
                    "SHIFT DATE: " +
                    toLocaleUTCDateString(info.event.start, "en-us", {
                        year: "numeric",
                        month: "short",
                        day: "numeric",
                    });
                available_shifts =
                    "Requested Shifts: " +
                    info.event.extendedProps.totalRequests;
                url = route("veterinarians.bid-requests.get-details");
            } else {
                shift_date =
                    "SHIFT DATE: " +
                    toLocaleUTCDateString(info.event.start, "en-us", {
                        year: "numeric",
                        month: "short",
                        day: "numeric",
                    });
                available_shifts =
                    "Available Shifts: " + info.event.extendedProps.totalShifts;
                url = route("veterinarians.shifts.get-details");
            }
            $("#modal-shift-date").html(shift_date);
            $("#modal-shift-available").html(available_shifts);

            $.ajax({
                url: url,
                type: "POST",
                data: {
                    shiftIds: info.event.extendedProps.description,
                },
                success: function (res) {
                    let bidHTML =
                        info.event.extendedProps.type == "Request"
                            ? parseBidRequestResponse(res)
                            : parseShiftResponse(res);

                    $("#bid-body").html(bidHTML);
                    $("#bid-list").modal("show");
                },
            });
        },
        eventContent: function (arg) {
            let aEl = document.createElement("a");
            aEl.setAttribute("href", "#");
            aEl.innerHTML = arg.event.title;

            if (arg.event.extendedProps.type == "Request") {
                aEl.classList += " request-event";
                if (arg.event.extendedProps.description) {
                    let ridArr = arg.event.extendedProps.description.split(",");
                    let ridClassArr = ridArr.map((val) => {
                        let trimmedVal = val.trim();
                        return "request-event-" + trimmedVal;
                    });
                    ridClassArr.forEach((element) => {
                        aEl.classList += " " + element;
                    });

                    aEl.setAttribute(
                        "request-ids",
                        arg.event.extendedProps.description
                    );
                }
            } else {
                aEl.classList += " shift-event";
                if (arg.event.extendedProps.description) {
                    aEl.setAttribute(
                        "shift-ids",
                        arg.event.extendedProps.description
                    );
                }
            }

            let arrayOfDomNodes = [aEl];
            return { domNodes: arrayOfDomNodes };
        },
        events: function (info, successCallback, failureCallback) {
            let view = "dayGridMonth";
            let keyword = "";
            let practicetype = "";
            let patientType = "";

            let startDt = info.startStr;
            let endDt = info.endStr;

            if (calendar) {
                view = calendar.currentData.currentViewType;
            }
            let url = route("veterinarians.shifts.search", [view]);
            keyword = $("#keyword").val();
            practicetype = $("#practicetype").val();
            distance = $("#distance").val();
            patientType = $("#patient_types").val();
            no_shifts = '<div class="row mx-2"><div class="alert alert-danger text-center alert-dismissible" role="alert">There are no shifts available<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div></div>';
            $.ajax({
                url: url,
                type: "POST",
                data: 
                {
                    start: startDt,
                    end: endDt,
                    keyword: keyword,
                    practicetype: practicetype,
                    distance: distance,
                    patientType: patientType,
                },
                success: function (res)
                {
                    if(res.length == 0){
                        document.getElementById("alert_empty_calendar").innerHTML = no_shifts;
                    } else {
                        document.getElementById("alert_empty_calendar").innerHTML ="";  
                    }
                    successCallback(res);
                },
            });
            //failureCallback(err);
        },
    });
    if (calendar.el != null) {
        calendar.render();

        if ($("#passed-date").length > 0) {
            let d = new Date($("#passed-date").val());
            let sid = $("#passed-shift-id").val();
            calendar.gotoDate(d);
            setTimeout(function () {
                $("#calendar")
                    .find(".request-event-" + sid)
                    .first()
                    .trigger("click");
            }, 500);
        }
    }

    // $('body').on('click', function() {
    //   let d = new Date("2022-12-5")
    //   calendar.gotoDate(d);
    // })

    // Change View
    $(".switch-button").on("click", function () {
        $(".switch-button").addClass("d-flex").removeClass("d-none");
        $(this).addClass("d-none").removeClass("d-flex");
        if ($(this).hasClass("daily")) {
            calendar.changeView("timeGridDay");
            calendar.refetchEvents();
        } else {
            calendar.changeView("dayGridMonth");
            calendar.refetchEvents();
        }
    });

    $("#keyword").on("keyup", function () {
        calendar.refetchEvents();
    });

    $("#practicetype").on("change", function () {
        calendar.refetchEvents();
    });

    $("#patient_types").on("change", function () {
        calendar.refetchEvents();
    });

    $("#distance").on("change", function () {
        calendar.refetchEvents();
    });

    // $('#calendar').on("click", '.shift-event', function() {
    //   $('#bid-list').modal("show");
    //   return false;
    // })

    $("#bid-list").on("click", ".ad-bid-request", function () {
        let bidRequestId = parseInt($(this).attr("bid-req-id"));
        let status = "requested";
        if ($(this).hasClass("accept-bid-request")) {
            status = "accepted";
        } else {
            status = "denied";
        }
        $.ajax({
            url: route("commons.bid-requests.change-status", [bidRequestId]),
            method: "post",
            data: {
                id: bidRequestId,
                status: status,
            },
            success: function (response) {
                alert(response.message);
                if (response.status) {
                    $("#bid-list").modal("hide");
                    calendar.refetchEvents();
                }
            },
        });
    });
});
