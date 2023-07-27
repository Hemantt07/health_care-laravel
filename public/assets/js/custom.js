var map, myLatLang;
$( document ).ready(function() {

    // Password Confirmation ---------------------------------------------------------------
    $('#password_confirmation').keyup( function (){
        if ( $('#password').val() == $(this).val() ) {
            $('#err').text('');
            $('#submit').removeAttr('disabled','');
        } else {
            $('#err').text('Passwords do not macth !!');
            $('#submit').attr('disabled','');
        }
    } );

    // Close Alert Box ---------------------------------------------------------------
    $( '#close' ).click(function (){
        $( '.alert-dismissible' ).remove();
    });

});



