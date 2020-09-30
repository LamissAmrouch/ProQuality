<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>ProQuality</title>
    <!-- ================= Favicon ================== -->
    <!-- Standard 
    <link rel="shortcut icon" href="http://placehold.it/64.png/000/fff"> -->
    <link rel="shortcut icon" href="{{ asset('public/logo/ProQuality_small.png') }}">
    <!-- Retina iPad Touch Icon
    <link rel="apple-touch-icon" sizes="144x144" href="http://placehold.it/144.png/000/fff"> -->
    <link rel="apple-touch-icon" sizes="144x144" href="{{ asset('public/logo/ProQuality_small.png') }}">
    <!-- Retina iPhone Touch Icon
    <link rel="apple-touch-icon" sizes="114x114" href="http://placehold.it/114.png/000/fff"> -->
    <link rel="apple-touch-icon" sizes="114x114" href="{{ asset('public/logo/ProQuality_small.png') }}">
    <!-- Standard iPad Touch Icon
    <link rel="apple-touch-icon" sizes="72x72" href="http://placehold.it/72.png/000/fff"> -->
    <link rel="apple-touch-icon" sizes="72x72" href="{{ asset('public/logo/ProQuality_small.png') }}"> 
    <!-- Standard iPhone Touch Icon
    <link rel="apple-touch-icon" sizes="57x57" href="http://placehold.it/57.png/000/fff"> -->
    <link rel="apple-touch-icon" sizes="57x57" href="{{ asset('public/logo/ProQuality_small.png') }}">

    <!-- Styles -->
    <link href="{{ asset('public/assets/fontAwesome/css/fontawesome-all.min.css') }}" rel="stylesheet">
    <link href="{{ asset('public/assets/css/lib/themify-icons.css') }}" rel="stylesheet">
    <link href="{{ asset('public/assets/css/lib/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('public/assets/css/lib/sidebar.css')}}" rel="stylesheet">
    <link href="{{ asset('public/assets/css/lib/nixon.css')}}" rel="stylesheet">
    <link href="{{ asset('public/assets/lib/lobipanel/css/lobipanel.min.css')}}" rel="stylesheet">
  
    <link href="{{ asset('public/assets/css/mselect.css') }}" rel="stylesheet">
    <link href="{{ asset('public/assets/css/style.css') }}" rel="stylesheet">
    <link href="{{ asset('public/assets/css/bs-stepper.min.css') }}" rel="stylesheet">
    <link href="{{ asset('public/assets/css/lib/rangSlider/ion.rangeSlider.css') }}" rel="stylesheet">  
    <link href="{{ asset('public/assets/css/lib/rangSlider/ion.rangeSlider.skinFlat.css') }}" rel="stylesheet"> 
    <script src="{{ asset('public/assets/js/lib/jquery.min.js')}}"></script>

    <!--  Chart js 
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.1/Chart.min.js" charset="utf-8"></script> -->
   
    <script src="{{ asset('public/assets/js/lib/chart-js/Chart.bundle.js') }}"></script>
    <script src="{{ asset('public/assets/js/lib/chart-js/chartjs-init.js') }}"></script>

    <!-- for sweetalert -->
    <link href="{{ asset('public/assets/css/lib/sweetalert/sweetalert.css')}}" rel="stylesheet">
    <script src="{{ asset('public/assets/js/lib/sweetalert/sweetalert.min.js')}}"></script>

    <!-- for toastr -->
    <link href="{{ asset('public/assets/css/lib/toastr/toastr.min.css')}} " rel="stylesheet">
    <script src="{{ asset('public/assets/js/lib/toastr/toastr.min.js')}} "></script>

   <!-- for calender -->
   <!-- <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" /> -->
   <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
   <link href="{{ asset('public/assets/fullcalendar/fullcalendar.css') }}" rel="stylesheet">
   <script src="{{ asset('public/assets/fullcalendar/moment.min.js') }}"  integrity="sha256-4iQZ6BVL4qNKlQ27TExEhBN1HFPvAvAMbFavKKosSWQ=" crossorigin="anonymous"> </script>
   <script src="{{ asset('public/assets/fullcalendar/fullcalendar.min.js') }}" ></script>  
   
   <link href="{{ asset('public/assets/css/bs-stepper.min.css') }}" rel="stylesheet">

   <script src="{{ asset('public/assets/js/bs-stepper.min.js') }}"></script>
</head>
<body>
    @include('main.side-bar')
    @include('main.header') 
    @yield('content')
                        <!-- /# container-fluid -->
                        <footer class="u-footer">
                            <span class="text-muted">Conçu et développé par Lamiss & Widad - &copy; 2020 Tous droits reservés.</span>
                        </footer>
                    </div>
                <!-- /# main -->
            </div>
        <!-- /# content-wrap -->
    </div>
    <script src="{{ asset('public/assets/js/lib/invoice-edit.js') }}"></script>
    <script src="{{ asset('public/assets/js/lib/input-autogrow/input-autogrow.js') }}"></script>
    <script src="{{ asset('public/assets/js/lib/input-autogrow/input-autogrow.min.js') }}"></script>
    <!-- Scripts -->
    <script src="{{ asset('public/assets/js/lib/jquery.nanoscroller.min.js') }}"></script>
    <!-- nano scroller -->
    <script src="{{ asset('public/assets/js/lib/sidebar.js') }}"></script>
    <!-- sidebar -->
    <script src="{{ asset('public/assets/js/lib/bootstrap.min.js') }}"></script>  
    <!-- stepper -->
    <script src="{{ asset('public/assets/js/bs-stepper.min.js') }}"></script>

    <script src="{{ asset('public/assets/js/scripts.js') }}"></script>
    <script src="{{ asset('public/assets/js/select.js') }}"></script>
    <!-- Calendar script 
    <script src="{{ asset('public/assets/fullcalendar/calendar-script.js') }}"></script>
    -->
    <script src="{{ asset('public/assets/js/lib/rating1/jRate.min.js') }}" ></script>
    <script src="{{ asset('public/assets/js/lib/rating1/jRate.init.js')}}"></script>
    <script src="{{ asset('public/assets/js/lib/rangeSlider/ion.rangeSlider.min.js')}}"></script>

    <!--  Chart js -->
    <script src="{{ asset('public/assets/js/lib/chart-js/Chart.bundle.js') }}"></script>
    <script src="{{ asset('public/assets/js/lib/chart-js/chartjs-init.js') }}"></script>

    @if(session('toasts') !== null))
    <script type="text/javascript">
        /* display Toasters as the page is loaded */
        var array = @json(session("toasts"));
        if(array[0]>0) fournisseur(array[0]);
        if(array[1]>0) atelier(array[1]);
        if(array[2]>0) client(array[2]);
        /* to display toastr by the type of alert  */
        function fournisseur(cpt) {
            toastr.success(cpt + "  nouveaux retours" ,"Retour fournisseur",{
                timeOut: 25000,
                "closeButton": true,
                "debug": false,
                "newestOnTop": true,
                "progressBar": true,
                "positionClass": "toast-bottom-right",
                "preventDuplicates": false,
                "onclick": null,
                "showDuration": "300",
                "hideDuration": "1000",
                "extendedTimeOut": "1000",
                "showEasing": "swing",
                "hideEasing": "linear",
                "showMethod": "fadeIn",
                "hideMethod": "fadeOut",
                "tapToDismiss": false
            });
        }
        function atelier(cpt) {
            toastr.warning(cpt + "  nouveaux retours" ,"Retour production",{
                timeOut: 25000,
                "closeButton": true,
                "debug": false,
                "newestOnTop": true,
                "progressBar": true,
                "positionClass": "toast-bottom-right",
                "preventDuplicates": false,
                "onclick": null,
                "showDuration": "300",
                "hideDuration": "1000",
                "extendedTimeOut": "1000",
                "showEasing": "swing",
                "hideEasing": "linear",
                "showMethod": "fadeIn",
                "hideMethod": "fadeOut",
                "tapToDismiss": false
            });
        }
        function client(cpt) {
            toastr.info(cpt + "  nouveaux retours" ,"Retour client",{
                    timeOut: 50000,
                    "closeButton": true,
                    "debug": false,
                    "newestOnTop": true,
                    "progressBar": true,
                    "positionClass": "toast-bottom-right",
                    "preventDuplicates": false,
                    "onclick": null,
                    "showDuration": "300",
                    "hideDuration": "1000",
                    "extendedTimeOut": "1000",
                    "showEasing": "swing",
                    "hideEasing": "linear",
                    "showMethod": "fadeIn",
                    "hideMethod": "fadeOut",
                    "tapToDismiss": false
            });
        }
    </script> 
    @endif 

    @php($caracts = App\Models\Caracteristique::all())
    @php($prods = App\Models\Produit::all())
    <script>
        function showCaractersticProduit() {
            var caracts = @json($caracts);            
            var produit_id = document.getElementById("produit").value;
            $('#caracteristique').empty();
            $('#caracteristique').append('<option value="" disabled> Selectionnez la caractéristique </option>');
            for (let i = 0; i < caracts.length; i++) {
                if(caracts[i].produit_id == produit_id){
                    console.log(produit_id);
                    var option = '<option value="'+ caracts[i].nom + '">'+ caracts[i].nom + '</option>';
                    $('#caracteristique').append(option);
                }
            }
        }
        function showTypeProduit(){
            var prods = @json($prods);            
            var type = document.getElementById("typeProduit").value;
            switch (type) {
                case "Retour fournisseur":
                    var typeP = "Matiere premiere";
                    break;
                case "Retour client":
                    var typeP = "Fini";
                    break;
            }
            $('#produit').empty();
            $('#produit').append("<option value='' disabled> Selectionnez l'article </option>");
            for (let i = 0; i < prods.length; i++) {
                if(typeP == null || prods[i].type == typeP){
                    var option = '<option value="'+ prods[i].id + '">'+ prods[i].nom + '</option>';
                    $('#produit').append(option);
                }
            }
        }
    </script>

    @if(isset($anomalie->criticite))
        <script> 
        var criticite = @json($anomalie).criticite;
        $("#criticite").ionRangeSlider({
            grid: true,
            min: 0,
            max: 100,
            from: criticite,
            prefix: "%"
        });
        </script>
    @else
        <script> 
            $("#criticite").ionRangeSlider({
                grid: true,
                min: 0,
                max: 100,
                from: 10,
                prefix: "%"
            });
        </script>
    @endif

    @if(isset($anomalie->reparateur_id))
    <script>
        $('#reparer').children().attr('checked', true);
        $('.reparateur-row').show();
        console.log("update"); 
    </script>
    @endif

    <script>
        /* reparateur optionnelle */
        $('#reparer').change(function() {
            if($(this).children().is(':checked')) {
                console.log("checked");
                $('.reparateur-row').show(); 
            } 
            else {
                console.log("Unchecked");
                $('.reparateur-row').hide();
            }
        });
    </script>


    <script>  
        /* to init stepper of anomaly */
        var stepper1 = new Stepper(document.querySelector('#stepper1'), {
                linear: false,
                animation: true
        }); 
    </script>

    <script>
        /* to init stepper of inspection */
        var stepper2 = new Stepper(document.querySelector('#stepper2'), {
            linear: false,
            animation: true
        });
    </script>

    <script>
        /* to init stepper of audit */
        var stepper3 = new Stepper(document.querySelector('#stepper3'), {
            linear: false,
            animation: true
        });
    </script>

    <script>
        /* display anomalie's inputs according to selected type */
            $("#typeProduit").change(function(){
                var getSelectedType = $(this).children("option:selected").val();
                switch (getSelectedType) {
                    case 'Retour fournisseur':
                        $('#client-col').hide(); 
                        $('#atelier-col').hide(); 
                        $('#fournisseur-col').show(); 
                        break;
                    case 'Retour client':
                        $('#fournisseur-col').hide(); 
                        $('#atelier-col').hide();
                        $('#client-col').show(); 
                        break;
                    case 'Retour production':
                        $('#fournisseur-col').hide(); 
                        $('#client-col').hide();
                        $('#atelier-col').show(); 
                        break;
                }
            });  
    </script>

    @isset($anomalie)
        <script type="text/javascript">
            $(document).ready(function() {
                /* color the step the stepper's step */
                for (let i = 0; i < 4; i++) {
                    colorToSet = "#878787";
                    if(i < @json($anomalie).step){
                        colorToSet = "#00ED96";
                    }
                    if(i > 0)  document.getElementById("line-".concat(i)).style.background= colorToSet;
                    document.getElementById("circle-".concat(i+1)).style.background= colorToSet;
                    document.getElementById("label-".concat(i+1)).style.color= colorToSet;
                }
                stepper1.to(@json($anomalie).step);
                    
                /* choose the selected inputs for anomalie created from alert */
                var getAlertType = @json($anomalie).type;
                switch (getAlertType) {
                        case 'Retour fournisseur':
                            $('#fournisseur-col').show(); 
                            $('#client-col').hide(); 
                            $('#atelier-col').hide(); 
                            break;
                        case 'Retour client':
                            $('#client-col').show(); 
                            $('#fournisseur-col').hide(); 
                            $('#atelier-col').hide();
                            break;
                        case 'Retour production':
                            $('#atelier-col').show(); 
                            $('#fournisseur-col').hide(); 
                            $('#client-col').hide(); 
                            break;
                }
            });
        </script>  
    @endisset 

    @isset($inspection)
        <script>
            $(document).ready(function() {
                /* color the step the stepper's step */
                for (let i = 0; i < 3; i++) {
                    colorToSet = "#878787";
                    if(i < @json($inspection).step){
                        colorToSet = "#00ED96";
                    }
                    if(i > 0) document.getElementById("line-".concat(i)).style.background= colorToSet;
                    document.getElementById("circle-".concat(i+1)).style.background= colorToSet;
                    document.getElementById("label-".concat(i+1)).style.color= colorToSet;
                }
                stepper2.to(@json($inspection).step);
            });
        </script> 
    @endisset 

    @isset($audit)
        <script>
            $(document).ready(function() {
                /* color the step the stepper's step */
                for (let i = 0; i < 3; i++) {
                    colorToSet = "#878787";
                    if(i < @json($audit).step){
                        colorToSet = "#00ED96";
                    }
                    if(i > 0) document.getElementById("line-".concat(i)).style.background= colorToSet;
                    document.getElementById("circle-".concat(i+1)).style.background= colorToSet;
                    document.getElementById("label-".concat(i+1)).style.color= colorToSet;
                }
                stepper3.to(@json($audit).step);
            });
        </script> 
    @endisset 

    <script type="text/javascript">
        /* for making tr-alerts clickable & redirect it to creating an anomaly  */
        $(function() {
            $('table.alert-table').on("click", "tr.tr-alert", function() {
                window.location = $(this).data("url");
            });
        });
    </script>

    <script type="text/javascript"> 
        /* Add row examen in test creation */
        function addRowExam(){
            /* check this condition to avoid adding empty table rows */
            if(document.getElementById('nomE').value != '')  {
                var tr = '<tr>'+
                    
                    '<td> <input type="hidden" name="typeE[]" value="'+ document.getElementById('typeE').value + '" typeE>'
                        + document.getElementById('typeE').value + '</td>'+ 
                    '<td> <input type="hidden" name="nomE[]" value="'+ document.getElementById('nomE').value + '" nomE>'
                        + document.getElementById('nomE').value + '</td>'+
                    '<td> <input type="hidden" name="min[]" value="'+ document.getElementById('min').value + '" min>'
                        + document.getElementById('min').value  + '</td>'+ 
                    '<td> <input type="hidden" name="max[]" value="'+ document.getElementById('max').value + '" max>'
                        + document.getElementById('max').value   + '</td>'+ 
                    '<td> <input type="hidden" name="unite[]" value="'+ document.getElementById('unite').value + '" unite>'
                        + document.getElementById('unite').value   + '</td>'+ 
                  
                    '<td><button type="button" id="delete-exam" class="btn btn-danger btn-sm">'
                    + '<i class="ti-close" aria-hidden="true"></i></button></td>'
                '</tr>';        
                /* Add the row in table */
                $('#tbody-exam').append(tr);
        
                /* empty the modal's field */
                document.getElementById('nomE').value= '';
                document.getElementById('typeE').value= '';
                document.getElementById('min').value= '';
                document.getElementById('max').value= '';
                document.getElementById('unite').value= '';
                document.getElementById('question').value= '';
                document.getElementById("row1").style.display = "none";
                //document.getElementById("row2").style.display = "none";
            }
        }
        /* delete exam from table exams (in creation of test) */
        $(document).on('click', '#delete-exam', function(){
            $(this).parents('tr').remove();
        });

        /* display inputs according to the selected type of exam */
        function showTypeExam(){
            getSelectValue = document.getElementById("typeE").value;
            document.getElementById("row1").style.display = "none";
            //document.getElementById("row2").style.display = "none";
            
            if(getSelectValue == "Quantitatif"){
                document.getElementById("row1").style.display = "block";
            } 
    
           /* if(getSelectValue == "Qualitatif"){
                document.getElementById("row2").style.display = "block";  
            }     */
        } 
    </script>
    <script>
        /* Add row caracteristic in product creation */
        function addRowCaracteristic() {
            if(document.getElementById('nomCaracteristic').value != '')  {
                var tr = '<tr>'+
                    '<td> <input type="hidden" name="nomc[]" value="'+ document.getElementById('nomCaracteristic').value + '" nomc>'
                        + document.getElementById('nomCaracteristic').value + '</td>'+
                        '<td><button type="button" id="delete-procede" class="btn btn-danger btn-sm">'
                        + '<i class="ti-close" aria-hidden="true"></i></button></td>'
                    '</tr>';
                /* Add the row in table */
                $('#tbody-caracteristic').append(tr);
                /* empty the modal's field */
                document.getElementById('nomCaracteristic').value= '';
            }
        }

        $(document).on('click', '#delete-caracteristic', function(){
            $(this).parents('tr').remove();
        }); 

        /* Add row procede in product creation */
        function addRowProcede() {
            if(document.getElementById('designationProc').value != '')  {
                var tr = '<tr>'+
                    '<td> <input type="hidden" name="designationp[]" value="'+ document.getElementById('designationProc').value + '" designationp>'
                        + document.getElementById('designationProc').value + '</td>'+
                    '<td> <input type="hidden" name="descriptionp[]" value="'+ document.getElementById('descriptionProc').value + '" descriptionp>'
                        + document.getElementById('descriptionProc').value + '</td>'+ 
                    '<td> <input type="hidden" name="atelierp[]" value="'+ document.getElementById('atelierProc').value + '" atelierp>'
                        + $("#atelierProc option:selected").text() + '</td>'+ 
                    '<td><button type="button" id="delete-procede" class="btn btn-danger btn-sm">'
                    + '<i class="ti-close" aria-hidden="true"></i></button></td>'
                '</tr> ';
                /* Add the row in table */
                $('#tbody-procede').append(tr);
                /* empty the modal's field */
                document.getElementById('designationProc').value= '';
                document.getElementById('descriptionProc').value= '';
                document.getElementById('atelierProc').value= '';
            }
        }
        $(document).on('click', '#delete-procede', function(){
            $(this).parents('tr').remove();
        }); 
    </script>
    <!-- Calendar script  -->
    <script>
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
                    events: SITEURL + "/calendrier",
                    displayEventTime: true,
                    eventColor: '#444BF8',
                    eventRender: function (event, element, view) {
                        if (event.allDay == 'true') {
                            event.allDay = true;
                        } else {
                            event.allDay = false;
                        }
                        if (event.type == "Inspection")
                        {
                            $(element).css("backgroundColor", "#2CD2F6");
                            $(element).css("borderColor", "#2CD2F6");
                        }       
                    },
                    selectable: true,
                    selectHelper: true,

                select: function (start, end, allDay) {
                        
                        var start = $.fullCalendar.formatDate(start, "Y-MM-DD HH:mm:ss");
                        var end = $.fullCalendar.formatDate(end, "Y-MM-DD HH:mm:ss");

                        $('#modalAddEvent').modal();
                        
                        $("#AddEventForm").submit(function(){
                        
                            var title = $('#title').val();
                            //var heure =$('#heure').val();
                            var rappel = $('#rappel').is(':checked'); 
                            var type = $('#type').find('option:selected').text();
                           
                            $.ajax({
                                
                                url: SITEURL + "/calendrier/create",
                                data: 'title=' + title + '&type=' + type + '&rappel=' + rappel +  '&start=' + start + '&end=' + end,
                                type: "POST",
                                success: function (data) {
                                    $('#modalAddEvent').modal('hide');
                                    swal({
                                    title: "Réussi",
                                    text: "Planification d'un évenement",
                                    type: "success",
                                    showConfirmButton: true
                                    }); 

                                }
                            });
                            calendar.fullCalendar('renderEvent',
                                    {
                                        title: title,
                                        type: type,
                                        rappel : rappel,
                                        start: start,
                                        end: end,
                                        allDay: allDay,
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
                                
                                    url: SITEURL + '/calendrier/update',
                                    data: 'start=' + start + '&end=' + end + '&id=' + event.id,
                                    type: "POST",
                                    success: function (response) {
                                        
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
                                url: SITEURL + '/calendrier/delete',                          
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
    
    </script> 

    <!-- Script for linking exams with anomaly -->
    <script>
        $(document).ready(function () { //Pass the ExamID to the modal 
            $('#modalReponse1').on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget); // Button that triggered the modal
            var recipient = button.data('whatever'); // Extract info from data-* attributes
            var modal = $(this);
            modal.find('.modal-body #ExamenId1').val(recipient);
            });

            $('#modalReponse2').on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget); // Button that triggered the modal
            var recipient = button.data('whatever'); // Extract info from data-* attributes
            var modal = $(this);
            modal.find('.modal-body #ExamenId2').val(recipient);
            });
        });

        $(document).ready(function () {
            //Display the create anomalie button
            if ($('#resultats').val() == "Les réponses des examens ne sont pas toutes correctes")
                {
                    $('#anomalie').css("display","inline-block");
                }
        });

        function verifyExams() //Submit the form2 only when all the exams have a response
        {
            var verify = 1;

                $("table#tableID > tbody > tr").each(function() {
                    if (  $('td:eq(7)',this).find('input').val() == '' ){    
                        verify = 0;
                    }
                }); 
                
                if (verify == 0){
                sweetAlert("Échec...", "Veuillez répondre à tous les examens", "error");
                }
                else{
                $('#form2').submit();
                }  
        }

        function Repondre1(){
            if(document.getElementById('reponseV').value != '')  {
                        var examId = document.getElementById('ExamenId1').value;
                        var reponse = document.getElementById('reponseV').value;
                        
                        $("table#tableID > tbody > tr").each(function() {
                                      
                                        $('td:eq(8) #correct2',this).remove();
                                        $('td:eq(8) #incorrect2',this).remove();
                                        var v = $('td:eq(0)',this).text();
                                        var iNum1 = parseInt(v);
                                        var iNum = parseInt(examId);
                                        if (iNum1 == iNum){ 
                                            $('td:eq(7)',this).find('input').val(reponse);
                                            if (reponse == "Fonctionnel" || reponse == "Présent"){   
                                                $('td:eq(8) #correct2',this).remove();
                                                $('td:eq(8) #incorrect2',this).remove();
                                                $('td:eq(8)',this).find('input').val("Correct");
                                                $('td:eq(8) #incorrect',this).css("display","none");
                                                $('td:eq(8) #correct',this).css("display","inline-block");
                                            }
                                            else{
                                                $('td:eq(8) #correct2',this).remove();
                                                $('td:eq(8) #incorrect2',this).remove();
                                                $('td:eq(8)',this).find('input').val("Incorrect");
                                                $('td:eq(8) #correct',this).css("display","none");
                                                $('td:eq(8) #incorrect',this).css("display","inline-block");
                                            }
                                        }                               
                        });
                        document.getElementById('ExamenId1').value= '';         
            }
        }
        function Repondre2(){
            if(document.getElementById('val').value != '')  {  
            var examId = document.getElementById('ExamenId2').value;
            var val = document.getElementById('val').value;
            $("table#tableID > tbody > tr").each(function() {
                    var v = $('td:eq(0)',this).text();
                    var iNum1 = parseInt(v);
                    var iNum = parseInt(examId);
                    if (iNum1 == iNum) //compare the examenId
                    { 
                        $('td:eq(7)',this).find('input').val(val); 
                        var valI = parseInt(val);
                        var min = $('td:eq(3)',this).text();
                        var max = $('td:eq(4)',this).text();
                        var minI = parseInt(min);
                        var maxI = parseInt(max);

                        if ( (valI >= minI) && (valI <= maxI) )
                        {   
                            $('td:eq(8) #correct2',this).remove();
                            $('td:eq(8) #incorrect2',this).remove();
                            $('td:eq(8)',this).find('input').val("Correct");
                            $('td:eq(8) #incorrect',this).css("display","none");
                            $('td:eq(8) #correct',this).css("display","inline-block");
                        }
                        else{
                            
                            $('td:eq(8) #correct2',this).remove();
                            $('td:eq(8) #incorrect2',this).remove();
                            $('td:eq(8)',this).find('input').val("Incorrect");
                            //$('td:eq(8)',this).remove(span);
                            $('td:eq(8) #correct',this).css("display","none");
                            $('td:eq(8) #incorrect',this).css("display","inline-block");
                        }
                    }                               
            });
                    document.getElementById('ExamenId2').value= '';
                    document.getElementById('val').value= '';   
            }
        }
    </script>
</body>
</html>
