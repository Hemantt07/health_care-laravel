$( document ).ready(function() {

    $('.fc-title').click( function(){
        console.log('hello');
    });

    $('#password_confirmation').keyup( function (){
        if ( $('#password').val() == $(this).val() ) {
            $('#err').text('');
            $('#submit').removeAttr('disabled','');
        } else {
            $('#err').text('Passwords do not macth !!');
            $('#submit').attr('disabled','');
        }
    } );

});

$( '#close' ).click(function (){
    $( '.alert-dismissible' ).remove();
});

