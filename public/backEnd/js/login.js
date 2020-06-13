"use strict"; 

$(document).ready(function () {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
        }
    });


});



$(document).ready(function () {
    $('.login-area p.get-login-access').click(function(){ 
        var abc = $(this).html(); 
        $( "p.get-login-access" ).each(function() {
            if($(this).html() == abc){
                $( this ).addClass( " login-area-button" );
            }else{
                $( this ).removeClass( " login-area-button" );
            } 
        }); 

	var value = $(this).text(); 
    var url = $('#url').val();

    var formData = {
        value : value
    };
    // get section for student
    $.ajax({
        type: "GET",
        data: formData,
        dataType: 'json',
        url: url + '/' + 'ajax-get-login-access',
        success: function (data) {
            console.log(data);

        	if(data != ""){
        		$('#email').val(data.email);
        		$('#password').val(123456);
        	}else{
        		$('#email').val('');
        		$('#password').val();
        	}

        },
        error: function (data) {
            console.log('Error:', data);
        }
    });

});
});



// $('.btn-group').on('click', '.p', function() {
//   $(this).addClass('fix-gr-bg').siblings().removeClass('fix-gr-bg');
// });
