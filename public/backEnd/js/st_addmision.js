var url = $('#STurl').val();
var user_id = $('#_id').val();

$(function() {
    var croppie = null;
    var el = document.getElementById('resize');

    $.base64ImageToBlob = function(str) {
        // extract content type and base64 payload from original string
        var pos = str.indexOf(';base64,');
        var type = str.substring(5, pos);
        var b64 = str.substr(pos + 8);
      
        // decode base64
        var imageContent = atob(b64);
      
        // create an ArrayBuffer and a view (as unsigned 8-bit)
        var buffer = new ArrayBuffer(imageContent.length);
        var view = new Uint8Array(buffer);
      
        // fill the view, using the decoded base64
        for (var n = 0; n < imageContent.length; n++) {
          view[n] = imageContent.charCodeAt(n);
        }
      
        // convert ArrayBuffer to Blob
        var blob = new Blob([buffer], { type: type });
      
        return blob;
    }

    $.getImage = function(input, croppie) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function(e) {  
                croppie.bind({
                    url: e.target.result,
                });
            }
            reader.readAsDataURL(input.files[0]);
            //var file = input.files[0];
            //console.log(file);
        }
    }

    $("#photo").on("change", function(event) {
        $("#LogoPic").modal();
        croppie = new Croppie(el, {
                viewport: {
                    width: 200,
                    height: 200,
                    type: 'square'
                },
                boundary: {
                    width: 250,
                    height: 250
                },
                enableOrientation: true
            });
        $.getImage(event.target, croppie); 

       
    });
   
    $("#upload_logo").on("click", function() {
        croppie.result('base64').then(function(base64) {
            $("#LogoPic").modal("hide"); 
          //  var t =$("#profile-pic").attr("src",`${url}/public/frontend/img/profile/1.png`); 
            
            //var url = "{{ url('/demos/jquery-image-upload') }}";
            console.log($.base64ImageToBlob(base64).type);
            
            var formData = new FormData();
            formData.append("logo_pic", $.base64ImageToBlob(base64));

            // This step is only needed if you are using Laravel
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                }
            });
           // console.log(t);
         
            $.ajax({
                type: 'POST',
                url: url,
                data: formData,
                processData: false,
                contentType: false,
                success: function(data) { 
                    console.log(data);
                                           
                    // if (data == "success") {
                    //     toastr.success('Succsesfully logo picture updated', 'Success');
                    //     //$("#profile-pic").attr("src", base64); 
                    // } else {
                    //     //$("#profile-pic").attr("src",`${url}/public/frontend/img/profile/1.png`); 
                        
                    // }
                },
                error: function(error) {                    
                    toastr.error('Something went wrong ! try again ','Error');
                   // $("#profile-pic").attr("src",`${url}/public/frontend/img/profile/1.png`); 
                }
            });
        });
    });

    $(".rotate").on("click", function() {
        croppie.rotate(parseInt($(this).data('deg'))); 
    });

    $('#LogoPic').on('hidden.bs.modal', function (e) {
        setTimeout(function() { croppie.destroy(); }, 100);
    })

});

// end student

// parent

$(function() {
    var croppie = null;
    var el = document.getElementById('fa_resize');

    $.base64ImageToBlob = function(str) {
        // extract content type and base64 payload from original string
        var pos = str.indexOf(';base64,');
        var type = str.substring(5, pos);
        var b64 = str.substr(pos + 8);
      
        // decode base64
        var imageContent = atob(b64);
      
        // create an ArrayBuffer and a view (as unsigned 8-bit)
        var buffer = new ArrayBuffer(imageContent.length);
        var view = new Uint8Array(buffer);
      
        // fill the view, using the decoded base64
        for (var n = 0; n < imageContent.length; n++) {
          view[n] = imageContent.charCodeAt(n);
        }
      
        // convert ArrayBuffer to Blob
        var blob = new Blob([buffer], { type: type });
      
        return blob;
    }

    $.getImage = function(input, croppie) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function(e) {  
                croppie.bind({
                    url: e.target.result,
                });
            }
            reader.readAsDataURL(input.files[0]);
            //var file = input.files[0];
            //console.log(file);
        }
    }

    $("#fathers_photo").on("change", function(event) {
        $("#FatherPic").modal();
        croppie = new Croppie(el, {
                viewport: {
                    width: 200,
                    height: 200,
                    type: 'square'
                },
                boundary: {
                    width: 250,
                    height: 250
                },
                enableOrientation: true
            });
        $.getImage(event.target, croppie); 

       
    });
   
    $("#FatherPic_logo").on("click", function() {
        croppie.result('base64').then(function(base64) {
            $("#FatherPic").modal("hide"); 
          //  var t =$("#profile-pic").attr("src",`${url}/public/frontend/img/profile/1.png`); 
            
            //var url = "{{ url('/demos/jquery-image-upload') }}";
            console.log($.base64ImageToBlob(base64).type);
            
            var formData = new FormData();
            formData.append("fathers_photo", $.base64ImageToBlob(base64));

            // This step is only needed if you are using Laravel
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                }
            });
           // console.log(t);
         
            $.ajax({
                type: 'POST',
                url: url,
                data: formData,
                processData: false,
                contentType: false,
                success: function(data) { 
                    console.log(data);
                                           
                    // if (data == "success") {
                    //     toastr.success('Succsesfully logo picture updated', 'Success');
                    //     //$("#profile-pic").attr("src", base64); 
                    // } else {
                    //     //$("#profile-pic").attr("src",`${url}/public/frontend/img/profile/1.png`); 
                        
                    // }
                },
                error: function(error) {                    
                    toastr.error('Something went wrong ! try again ','Error');
                   // $("#profile-pic").attr("src",`${url}/public/frontend/img/profile/1.png`); 
                }
            });
        });
    });

    $(".rotate").on("click", function() {
        croppie.rotate(parseInt($(this).data('deg'))); 
    });

    $('#FatherPic').on('hidden.bs.modal', function (e) {
        setTimeout(function() { croppie.destroy(); }, 100);
    })

});


// end parent

// moather

$(function() {
    var croppie = null;
    var el = document.getElementById('ma_resize');

    $.base64ImageToBlob = function(str) {
        // extract content type and base64 payload from original string
        var pos = str.indexOf(';base64,');
        var type = str.substring(5, pos);
        var b64 = str.substr(pos + 8);
      
        // decode base64
        var imageContent = atob(b64);
      
        // create an ArrayBuffer and a view (as unsigned 8-bit)
        var buffer = new ArrayBuffer(imageContent.length);
        var view = new Uint8Array(buffer);
      
        // fill the view, using the decoded base64
        for (var n = 0; n < imageContent.length; n++) {
          view[n] = imageContent.charCodeAt(n);
        }
      
        // convert ArrayBuffer to Blob
        var blob = new Blob([buffer], { type: type });
      
        return blob;
    }

    $.getImage = function(input, croppie) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function(e) {  
                croppie.bind({
                    url: e.target.result,
                });
            }
            reader.readAsDataURL(input.files[0]);
            //var file = input.files[0];
            //console.log(file);
        }
    }

    $("#mothers_photo").on("change", function(event) {
        $("#MotherPic").modal();
        croppie = new Croppie(el, {
                viewport: {
                    width: 200,
                    height: 200,
                    type: 'square'
                },
                boundary: {
                    width: 250,
                    height: 250
                },
                enableOrientation: true
            });
        $.getImage(event.target, croppie); 

       
    });
   
    $("#Mother_logo").on("click", function() {
        croppie.result('base64').then(function(base64) {
            $("#MotherPic").modal("hide"); 
          //  var t =$("#profile-pic").attr("src",`${url}/public/frontend/img/profile/1.png`); 
            
            //var url = "{{ url('/demos/jquery-image-upload') }}";
            console.log($.base64ImageToBlob(base64).type);
            
            var formData = new FormData();
            formData.append("mothers_photo", $.base64ImageToBlob(base64));

            // This step is only needed if you are using Laravel
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                }
            });
           // console.log(t);
         
            $.ajax({
                type: 'POST',
                url: url,
                data: formData,
                processData: false,
                contentType: false,
                success: function(data) { 
                    console.log(data);
                                           
                    // if (data == "success") {
                    //     toastr.success('Succsesfully logo picture updated', 'Success');
                    //     //$("#profile-pic").attr("src", base64); 
                    // } else {
                    //     //$("#profile-pic").attr("src",`${url}/public/frontend/img/profile/1.png`); 
                        
                    // }
                },
                error: function(error) {                    
                    toastr.error('Something went wrong ! try again ','Error');
                   // $("#profile-pic").attr("src",`${url}/public/frontend/img/profile/1.png`); 
                }
            });
        });
    });

    $(".rotate").on("click", function() {
        croppie.rotate(parseInt($(this).data('deg'))); 
    });

    $('#MotherPic').on('hidden.bs.modal', function (e) {
        setTimeout(function() { croppie.destroy(); }, 100);
    })

});



// Gurdian

$(function() {
    var croppie = null;
    var el = document.getElementById('Gu_resize');

    $.base64ImageToBlob = function(str) {
        // extract content type and base64 payload from original string
        var pos = str.indexOf(';base64,');
        var type = str.substring(5, pos);
        var b64 = str.substr(pos + 8);
      
        // decode base64
        var imageContent = atob(b64);
      
        // create an ArrayBuffer and a view (as unsigned 8-bit)
        var buffer = new ArrayBuffer(imageContent.length);
        var view = new Uint8Array(buffer);
      
        // fill the view, using the decoded base64
        for (var n = 0; n < imageContent.length; n++) {
          view[n] = imageContent.charCodeAt(n);
        }
      
        // convert ArrayBuffer to Blob
        var blob = new Blob([buffer], { type: type });
      
        return blob;
    }

    $.getImage = function(input, croppie) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function(e) {  
                croppie.bind({
                    url: e.target.result,
                });
            }
            reader.readAsDataURL(input.files[0]);
            //var file = input.files[0];
            //console.log(file);
        }
    }

    $("#guardians_photo").on("change", function(event) {
        $("#GurdianPic").modal();
        croppie = new Croppie(el, {
                viewport: {
                    width: 200,
                    height: 200,
                    type: 'square'
                },
                boundary: {
                    width: 250,
                    height: 250
                },
                enableOrientation: true
            });
        $.getImage(event.target, croppie); 

       
    });
   
    $("#Gurdian_logo").on("click", function() {
        croppie.result('base64').then(function(base64) {
            $("#GurdianPic").modal("hide"); 
          //  var t =$("#profile-pic").attr("src",`${url}/public/frontend/img/profile/1.png`); 
            
            //var url = "{{ url('/demos/jquery-image-upload') }}";
            console.log($.base64ImageToBlob(base64).type);
            
            var formData = new FormData();
            formData.append("guardians_photo", $.base64ImageToBlob(base64));

            // This step is only needed if you are using Laravel
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                }
            });
           // console.log(t);
         
            $.ajax({
                type: 'POST',
                url: url,
                data: formData,
                processData: false,
                contentType: false,
                success: function(data) { 
                    console.log(data);
                                           
                    // if (data == "success") {
                    //     toastr.success('Succsesfully logo picture updated', 'Success');
                    //     //$("#profile-pic").attr("src", base64); 
                    // } else {
                    //     //$("#profile-pic").attr("src",`${url}/public/frontend/img/profile/1.png`); 
                        
                    // }
                },
                error: function(error) {                    
                    toastr.error('Something went wrong ! try again ','Error');
                   // $("#profile-pic").attr("src",`${url}/public/frontend/img/profile/1.png`); 
                }
            });
        });
    });

    $(".rotate").on("click", function() {
        croppie.rotate(parseInt($(this).data('deg'))); 
    });

    $('#GurdianPic').on('hidden.bs.modal', function (e) {
        setTimeout(function() { croppie.destroy(); }, 100);
    })

});


