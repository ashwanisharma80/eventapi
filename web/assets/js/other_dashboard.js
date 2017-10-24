//Multiple Images select
$(document).ready(function() {
	    var j = 1;

 $('#add1').click(function() {
        $('<div><br><label>Upload Images</label><input class="form-control" type="file" style="padding-right:25px;" id="addimage' + j + '"/></div>').fadeIn('slow').appendTo('.input');
		if (j >= 1) {
            $("#addimage" + j)
        }
        j++;
    });
	});
 
// Select Multiple Date//
$(function () {
            $('#events_event_schedule').multiDatesPicker({
                dateFormat: "dd/mm/yy",
                changeMonth: true,
                changeYear: true
           });
        });

//Mutilple date input field//  

$(document).ready(function() {

    //
    var i = 1;
	 $('#events_event_schedule').multiDatesPicker();
        $('#add').click(function() {
        $('<div><br><label>Event Schedule</label><input class="form-control"  name="events[event_schedule]" class="form-control" type="text" style="padding-right:25px;" id="events_event_schedule' + i + '"/></div>').fadeIn('slow').appendTo('.inputs');
		if (i >= 1) {
            $("#events_event_schedule" + i).multiDatesPicker()
        }
        i++;
    });

   /* $('#remove').click(function() {
        if (i > 1) {
            $('.fieldset:last').remove();

            i--;
        }
    });

    $('#reset').click(function() {
        while (i > 2) {
            $('.field:last').remove();
            i--;
        }
    });*/
});
  
// select tab according to open page
 var pgurl = window.location.href.substr(window.location.href.lastIndexOf("/")+1); 
 $(".side-nav li").each(function(){
      if($(this).attr("href") == pgurl || $(this).attr("href") == '' )
      $(this).parent().addClass("activetab");
 })
    
	
	