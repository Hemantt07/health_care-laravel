var map, myLatLang;
$( document ).ready(function() {

    var json_location = 'https://opendata.howardcountymd.gov/resource/96q9-qbh7.json';

    geoLocationInit();
    function geoLocationInit(){
        if ( navigator.geolocation ) {
            navigator.geolocation.getCurrentPosition(success, fail);
        } else {
            alert( 'Browser does not support !' );
        }
    }

    function success(position) {
        var latval = position.coords.latitude;
        var lngval = position.coords.longitude;

        console.log([latval, lngval]);

        myLatLang = new google.maps.LatLng( latval,lngval);

        createMap(myLatLang);
        // nearBySearch(myLatLang, 'hospital');
        searchHospitals(latval, lngval);
    }
    
    function fail(){
        alert('We could not retriev location');
    }

    // Create Map ---------------------------------------------------------------
    function createMap ( latlng ) {
        map  = new google.maps.Map( document.getElementById('map'), {
            center: latlng,
            scrollwheel: true,
            zoom: 15
        } );

        var marker_curr = new google.maps.Marker({
            position: latlng,
            map: map
        })
    }

    // Create Marker ---------------------------------------------------------------
    function createMarker (latlng, icn, name) {
        var marker  = new google.maps.Marker({
            position: latlng,
            map: map,
            icon: icn,
            title: name,
          });
    }

    // Search Girls 
    function searchHospitals( lat, lng ) {

        $.post( 'http://127.0.0.1:8000/api/searchHospitals',{lat:lat, lng:lng }, function(match){
            console.log(match);
        } );

    }

    // Nearby Search ---------------------------------------------------------------
    // function nearBySearch(myLatLang, type) {
    //     var request = {
    //         location: myLatLang,
    //         radius: '1500',
    //         types: [type]
    //     }
    
    //     service = new google.maps.places.PlacesService(map);
    //     service.nearbySearch(request, callback);
    
    //     function callback (results , status) {
    
    //         if (status == google.maps.places.PlacesServiceStatus.OK ) {
    //             for (let i = 0; i < results.length; i++) {
    //                 var place = results[i];
    
    //                 var latlng = place.geometry.location;
    //                 var icn  = 'data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAADAAAAAwCAYAAABXAvmHAAAACXBIWXMAAAsTAAALEwEAmpwYAAABuklEQVR4nO2WsUoDQRRFp9FK/IWwo6ImWOUXBGuFzKgYsIqFnZUSWyuTaLBJsLNR8AvUwsKsJDGd8R920SaJVi5cmVl0o3FjIsjMyhx47JT3vvtm5xFi+GdgeSIBbh2AWU0w+uyXPBeQmowTXUEqPgpGj8CpB04RUh6YVUQmOUK0E8/plRS5OgVkF4HyDnCW879fjTB6qZUJ+J0H1ueA413gvBhUafv7NJh1SPSZeerJzr+LP9kDthaAtemwUQK49Qoem1Wtn4hOSkHZpUB8Ot5H+KdRyqvWT8CtBylGzLowIDo/iHg/hXsdDHSkmNOcb6Dv2PQYaOtgoP2RQNiFDR0hq6XDHWgOJVq7EWK08GsDjO6r1k/EevDD6xv+G12JzRAdkOvB8N0vEF0Qa4FcDwYXf6HVKhGYEI+aeGH7jI24M7qJ77kTjOZfNufhpROyxBmc5rRYHQbFrrvoLhI1bGNAMSYB1ZgEVGMSUI1JQDUmAdWYBFRjElCNSUA1JgHVmARUY9edRpCC0yBR4/bO2egykCFR47rpjlXqTsuuOZ1q9WmcRJFKzS1Xam6JRJWb6mNSlGodBvKHvAEmVo/4wCwVdgAAAABJRU5ErkJggg==';
    //                 var name  = place.name;
    
    //                 createMarker(latlng, icn, name);
    //             }
    //         }
    //     }
    // }


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



