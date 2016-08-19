<?php  
include('settings.php');
     
   
 if($_POST['quickpollsubmit'] == 'Vote') {
  
   if(($quickpolltype == "radio" && $_POST['radiovote'] != '') || ($quickpolltype == "checkbox" && $_POST['checkboxvote'] != '')){
   
	// grab users IP address
	$ipAddress = $_SERVER['REMOTE_ADDR'];
	
	$UserIptxt = $ipAddress."||";
	$all_ips = explode("||", file_get_contents("data/user_ip.txt"));
	if ( ! in_array($ipAddress, $all_ips) ) {
	   // put the ip address in .txt file
	   file_put_contents("data/user_ip.txt", $UserIptxt, FILE_APPEND);
	    
	}
	// ip adres is already stored
	else {
	 echo '<div class="alreadyvoted">You have already voted!</div>';
	}
   }
   // if no input 
   else {
        echo '<div class="noinput">You have to make at least one choice!</div>';
   }
 }
   
   // get data from txt file
   $result_file = "data/vote_result.txt";
    
   if (file_exists($result_file)) {
       $results = explode(',', file_get_contents('data/vote_result.txt'));
   } else {
       // start with zeros if you don't have a file yet
       $results = array_fill(0, count($quickpolloptions), 0);
   }
   
   
   // if IP address is not yet stored; put data in txt file
   if ( ! in_array($ipAddress, $all_ips) ) {
    
      // RADIO   
      if($quickpolltype == "radio") {
       // if at least 1 radio is choosen
       if (isset($_POST['radiovote'])) {
	   // store only data if Vote button is hit
	   if($_POST['quickpollsubmit'] == 'Vote') {
	    // we check if expire is TRUE and poll has not yet expired
	    if($quickpollexpire) {
	       if($currenttime < $quickpollexpirationdate) {
	          $results[$_POST['radiovote']]++;
	          echo '<div class="votingsuccess">Thank you for voting!</div>';
	       }
	       else {
		echo '<div class="exceeded">Poll has expired!</div>';
	       }
	    }// endif poll expire
	    else {
	     $results[$_POST['radiovote']]++;
	     echo '<div class="votingsuccess">Thank you for voting!</div>';
	    }// endelse poll expire
	    
	   }// endif == Vote
	   file_put_contents('data/vote_result.txt', implode(',', $results));
	   
       }
      }
      // CHECKBOX
      elseif($quickpolltype == "checkbox") {
       // if at least 1 checkbox is choosen
       if (isset($_POST['checkboxvote'])) {
	// store only data if Vote button is hit
	if($_POST['quickpollsubmit'] == 'Vote') {
	 // we check if expire is TRUE and poll has not yet expired
	  if($quickpollexpire) {
	     if($currenttime < $quickpollexpirationdate) {
	        foreach ($_POST['checkboxvote'] as $checkbox) {
	          $results[$checkbox]++;	  
	        }// endif foreach
		echo '<div class="votingsuccess">Thanks for voting!</div>';
	     }
	     else {
	      echo '<div class="exceeded">Poll has expired!</div>';
	     }
	  }//endif poll expire
	  else {
	   foreach ($_POST['checkboxvote'] as $checkbox) {
	     $results[$checkbox]++;	  
	   }// endif foreach
	     echo '<div class="votingsuccess">Thanks for voting!</div>';
	  }// endelse poll expire
	 
	}//endif == Vote
	 file_put_contents('data/vote_result.txt', implode(',', $results));
       }
      }
  }// endif check ip address

?>

<!-- RENDER RESULTS -->
<div class="progresswrapper">

	<table>
	    <tr>
		<td><b>Result:</b></td>
		<td></td>
		<td><b>%</b></td>
		<td><b>Votes</b></td>
	    </tr>
	<?php
	$total = array_sum($results);
	foreach (array_combine($quickpolloptions, $results) as $key => $count) {
	    $percent = 100*round($count/($total),2);
	    ?>
	    <tr>
	       <td class="quickpollheader"><?php echo $key.':'; ?></td>
	       <td class="quickpollgraphic"><div class="progresspoll">
		  <div class="percentpollgraph" style="width: <?php echo $percent; ?>%"></div>
	       </td>
	       <td class="quickpollpercent"><div class="percentpoll"><?php echo $percent; ?></div></td>
	       <td class="quickpollcount"><div class="count"><?php echo $count; ?></div></td>
	       
	    </tr>
	<?php
	}
	?>
	
	</table>
	
	<script>
	$('.percentpoll').each(function () {
	    $(this).prop('Counter',0).animate({
		Counter: $(this).text()
	    }, {
		duration: 3000, // 3 seconds
		easing: 'swing',
		step: function (now) {
		    $(this).text(Math.ceil(now) + '%');
		}
	    });
	});
	</script>
	<hr>
	Total Votes: <b><?php echo $total; ?></b>
	<br />
      
</div>
