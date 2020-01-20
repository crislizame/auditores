$(document).ready(function() {

    $('#calendar').fullCalendar({
      header: {
        left: '',
        center: 'prev, title, next',
          right:''
      },
        locale: 'es',
        height: 276,
      navLinks: false, // can click day/week names to navigate views
      selectable: false,
      selectHelper: false,
        dayClick: function(date, jsEvent, view, resource) {
            // $('#calendar').fullCalendar('select',date);
            //     date.dayEl.style.backgroundColor = 'red';
            $(".fc-state-highlight").removeClass("fc-state-highlight");
            $("td[data-date="+date.format('YYYY-MM-DD')+"]").addClass("fc-state-highlight");
            $("#calendar").attr("data-date",date.format());

        },
      select: function(start, end, jsEvent, view, resource) {
//        var title = prompt('Event Title:');
//        var eventData;
//        if (title) {
//          eventData = {
//            title: title,
//            start: start,
//            end: end
//          };
//          $('#calendar').fullCalendar('renderEvent', eventData, true); // stick? = true
//        }
// console.log(start.format()+" "+end.format());
$("#calendar").attr("data-date",start.format());
       // $('#calendar').fullCalendar('unselect');
      },
      editable: false,
      eventLimit: true, // allow "more" link when too many events
      events: [
//        {
//          title: 'All Day Event',
//          start: '2018-03-01'
//        }
      ]
    });

  });
