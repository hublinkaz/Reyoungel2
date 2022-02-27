//
//
//
//
// $('.changestatus').click(function(e) {
//     var order_id= $("#order_id").val();
//
//     console.log(e.target.parentElement.parentElement.parentElement)
//     var is_delivered =$("#is_delivered").val();
//
//     var token =  $('input[name="_token"]').attr('value')
//     $.ajaxSetup({
//         beforeSend: function(xhr) {
//             xhr.setRequestHeader('X-CSRF-Token', token);
//         }
//     });
//
//     let resault={
//         order_id:order_id,
//         is_delivered: is_delivered,
//     }
//
//
//     let cart_data = JSON.stringify(resault);
//
//     $.ajax({
//         type: "POST",
//         url: "/admin/order/status",
//         async:false,
//         dataType: "json",
//         contentType: 'application/json',
//         data: cart_data,
//         success: function (data) {
//             console.log(data);
//         },
//         error: function (data) {
//             console.log('Error:', data);
//
//         },
//     });
//
//
// });


$(document).ready(function(){

    $("#mapchange").click(function(){

        var id = $(this).data('id');
        var token = $(this).data('token');



        if(navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(function(position) {
                var positionInfo = "Your current position is (" + "Latitude: " + position.coords.latitude + ", " + "Longitude: " + position.coords.longitude + ")";
                let resault= {
                    id: id,
                    map_x: position.coords.latitude,
                    map_y: position.coords.longitude,
                }
                let cart_data = JSON.stringify(resault);
                console.log(cart_data);

                $.ajaxSetup({
                    beforeSend: function(xhr) {
                        xhr.setRequestHeader('X-CSRF-Token', token);
                    }
                });
                $.ajax({
                    type: "POST",
                    url: "/location",
                    async:false,
                    dataType: "json",
                    contentType: 'application/json',
                    data: cart_data,
                    success: function (data) {
                        console.log(data)
                        alert('Əlavə Edildi')
                    },
                    error: function (data) {
                        console.log('Error:', data);
                        alert('Xəta')


                    },
                });

            });
        }
    });
});

// function showPosition() {
//     var id = $(this).data('id');
//
//     if(navigator.geolocation) {
//         navigator.geolocation.getCurrentPosition(function(position) {
//             var positionInfo = "Your current position is (" + "Latitude: " + position.coords.latitude + ", " + "Longitude: " + position.coords.longitude + ")";
//             alert('X :'+ position.coords.latitude + ", " + "Y: " + position.coords.longitude +"=="+id)
//         });
//     } else {
//         alert("Sorry, your browser does not support HTML5 geolocation.");
//     }
// }
