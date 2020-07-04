function sweetSuccess(successMsg) {
    if(successMsg != ''){
        swal({
            title: "Bravo!",
            text: successMsg,
            type: "success",
            showConfirmButton: true
        });
    }
}

$('#toastr-warning-bottom-right').click(function() {
    toastr.warning('This Is warning Message','Bottom Right',{
        "positionClass": "toast-bottom-right",
        timeOut: 5000,
        "closeButton": true,
        "debug": false,
        "newestOnTop": true,
        "progressBar": true,
        "preventDuplicates": true,
        "onclick": null,
        "showDuration": "300",
        "hideDuration": "1000",
        "extendedTimeOut": "1000",
        "showEasing": "swing",
        "hideEasing": "linear",
        "showMethod": "fadeIn",
        "hideMethod": "fadeOut",
        "tapToDismiss": false

    })
});
