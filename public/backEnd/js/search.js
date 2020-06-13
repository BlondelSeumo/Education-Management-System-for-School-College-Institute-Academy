$("#livesearch").hide();
function showResult(str) {

    var url = $('#url').val();
    
    if (str.length == 0) {
         document.getElementById("livesearch").innerHTML="";
         $("#livesearch").hide();
    return;
    }


    $.ajax({
            method:'POST',
            url: url + '/' + 'search',
            data:{search:str},
            success:function(data){
                // console.log(data);
                $("#livesearch").show();
                if (data.length != 0) {
                 document.getElementById("livesearch").innerHTML="";
                 data.forEach(value => {
                     var str = value.name;
                    $("#livesearch").append("<a href='"+value.route+"'>"+str+"</a>");
                 }); 
                }
                else{
                    document.getElementById("livesearch").innerHTML="";
                    $("#livesearch").append("<a id='lol'> Not Found </a>");
                }
            },
            error: function (data) {
                console.log('Error:', data);
            }

        });
    
}
$(document).on("click", function(e) {
    if (!$(e.target).closest('#serching').length)  {
        $("#livesearch").hide();
    }
});