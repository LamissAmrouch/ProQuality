
  $(document).ready(function () {
         
        var SITEURL = "{{url('/')}}";
        $.ajaxSetup({
          headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          }
        });
        var calendar = $('#calendar').fullCalendar({
            header: {
              left: 'prev,next,today',
              center: 'title',
              right: 'month,agendaWeek,agendaDay,list'
            },
            editable: true,
            events: SITEURL + "/fullcalendareventmaster",
            displayEventTime: true,
            editable: true,
            eventRender: function (event, element, view) {
                if (event.allDay === 'true') {
                    event.allDay = false;
                } else {
                    event.allDay = false;
                }
            },
            selectable: true,
            selectHelper: true,

            select: function (start, end, allDay) {
                $('#modalAddEvent').modal();
                $("#AddEventForm").submit(function(){
                    var start = $.fullCalendar.formatDate(start, "Y-MM-DD HH:mm:ss");
                    var end = $.fullCalendar.formatDate(end, "Y-MM-DD HH:mm:ss");
                    var title =$('#title').val();
                    //var heure =$('#heure').val();
                    var type = $('#type').find('option:selected').text();
                   
                    $.ajax({
                        url: SITEURL + "/fullcalendareventmaster/create",
                        data: 'title=' + title + '&type=' + type + '&start=' + start + '&end=' + end,
                        type: "POST",
                        success: function (data) {
                            $('#modalAddEvent').modal('hide');
                            swal({
                              title: "Bravo!",
                              text: "Planification d'un évenement",
                              type: "success",
                              showConfirmButton: true
                            }); 
                        },
                        error: function(data){
                            $('#modalAddEvent').modal('hide');
                            sweetAlert(
                                "Erreur...", 
                                data,
                                "error");
                        }
                    });
                    calendar.fullCalendar('renderEvent',
                    {
                        title: title,
                        start: start,
                        end: end,
                        allDay: allDay
                    },
                    true
                    ); 
                 });
            
                calendar.fullCalendar('unselect'); 
            },
             
            eventDrop: function (event, delta) {
                        var start = $.fullCalendar.formatDate(event.start, "Y-MM-DD HH:mm:ss");
                        var end = $.fullCalendar.formatDate(event.end, "Y-MM-DD HH:mm:ss");
                        $.ajax({
                            url: SITEURL + '/fullcalendareventmaster/update',
                            data: 'title=' + event.title + '&type=' + type + '&start=' + start + '&end=' + end + '&id=' + event.id,
                            type: "POST",
                            success: function (response) {
                               /* swal({
                                   title: "Bravo!",
                                   text: "Date d'évenement modifiée",
                                   type: "success",
                                   showConfirmButton: true
                                }); */
                            }
                        });
                    },
            eventClick: function (event) {
                      swal({
                          title: "Voulez-vous supprimer cet évenement ?",
                          text: "",
                          type: "warning",
                          showCancelButton: true,
                          confirmButtonColor: "#DD6B55",
                          confirmButtonText: "Oui, supprimer",
                          cancelButtonText: "Non, annuler",
                          closeOnConfirm: false,
                          closeOnCancel: false
                          },
                      function(isConfirm){
                        if (isConfirm) {
                           $.ajax({
                           type: "POST",
                           url: SITEURL + '/fullcalendareventmaster/delete',
                           data: "&id=" + event.id,
                           success: function (response) {
                            if(parseInt(response) > 0) {
                                $('#calendar').fullCalendar('removeEvents', event.id);
                               swal("Suppression !!", "Votre évenement a été supprimer !!", "success");
                             }
                            }
                           });
                        }
                        else {
                             swal("Annulation !!", "Votre évenement existe encore", "error");
                         }
                       });
            }
 
        });

  });
 
