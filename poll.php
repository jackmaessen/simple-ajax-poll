<!DOCTYPE html>

<html>
<head>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
<script src="js/quickpoll.js"></script>
<link rel="stylesheet" href="css/quickpoll.css">
</head>

<body>
<?php

include('settings.php');

?>

<!-- RADIO VOTE / CHECKBOX VOTE-->

   <div id="form" class="quickpollwrapper">
      <p><?php echo $quickpollheader; ?></p>
	   <form method="post" id="quickpoll">
	    <table class="quickpolltable">
	       
		 <input type="hidden" value="" name="quickpollsubmit" id="quickpollsubmit" readonly>
	       
	    <?php
	    
	       foreach ($quickpolloptions as $key => $value) {
		  
		  if($quickpolltype == "radio") {
		  
		     echo '<tr class="quickpollrow">';
			echo "<td>";
			   echo "<label>$value</label>";
			echo "</td>";
			echo "<td>";
			   echo "<input class='quickpollinput' type='radio' name='radiovote' value='$key'><br>";
			echo "</td>";
		     echo "</tr>";
		  }
		  elseif($quickpolltype == "checkbox") {
		     echo '<tr class="quickpollrow">';
			echo "<td>";
			   echo "<label>$value</label>";
			echo "</td>";
			echo "<td>";
			   echo "<input class='quickpollinput' type='checkbox' name='checkboxvote[]' value='$key'><br>";
			echo "</td>";
		     echo "</tr>";
		  }
	       }
	       
	    ?>
	    
	       <tr class="quickpollrow">
	          <td>
	             <input class="quickpollsubmit" type="submit" value="View">
	          </td>
	          <td>
	             <input id="quickpollsubmitvote" class="quickpollsubmit" type="submit" value="Vote">
	          </td>
	       </tr>
	    </table>
	      
		  
	   </form>
	   <br />
	   <?php
	   if($quickpollexpire) {
	     include('countdown.php');
	   ?>
	   <div id="countdowntimer"></div>
	   
           <?php
	   }
	   ?>


	   
	   
   </div>


</body>
</html>


