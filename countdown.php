<script>
	
// parse the PHP variables to javascript 
var quickpollexpirationdate = parseInt("<?php echo $quickpollexpirationdate; ?>");

var currenttime = parseInt("<?php echo $currenttime; ?>");
		
// get the difference between the expiration time and the time now to work out how long there is to go in seconds
var dif = quickpollexpirationdate - currenttime;

// run the timer
var counter = setInterval(timer, 1000); //1000 will  run it every 1 second



function timer()
{
    var note = $("#countdowntimer");
    var message = "";
    
    // if we reach the expirationtime; display "Poll expired!"
    if(dif <= 0){
		    
	    message += "<span id=\"countdown\" class=\"quickpollexpired\"><?php echo $expirationtext; ?></span>";
	    
	    note.html(message);
	    
	    var hidebutton = $("#quickpollsubmitvote");
	    hidebutton.addClass('votehidden'); // hide the vote button
	    
	    
    }else{
			    
	    // work out how many days, hours, minutes and seconds there are
	    var rdays = Math.floor(dif/86400) % 24;
	    var rhours = Math.floor(dif/3600) % 24;
	    var rminutes = Math.floor(dif/60) % 60;
	    var rseconds = dif % 60; 
	    
	    // countdown one second
	    dif=dif-1;
	    
	    // show remaining on the countdown timer
	    message += "Poll expires in:<br />";
	    message += "<span id=\"countdown\">"+rdays+" days "+rhours+" hours "+rminutes+" minutes "+rseconds+" seconds</span>";
	    
	    note.html(message);
	    	    
	    // make the integers bold
	    $("#countdown").html(function() {
	       return $(this).text().replace(/(\d+)/g,"<strong>$1</strong>");
	    });
    }
}

				
</script>