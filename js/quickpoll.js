$(document).ready(function()
{
	     
	/*
	
	using $.post() function
	
	$(document).on('submit', '#reg-form', function()
	{		
		$.post('submit.php', $(this).serialize())
		.done(function(data)
		{
			$("#reg-form").fadeOut('slow', function()
			{
				$(".result").fadeIn('slow', function()
				{
					$(".result").html(data);	
				});
			});
		})
		.fail(function()
		{
			alert('fail to submit the data');
		});
		return false;
	});	
	
	using $.post() function
	
	*/
	
	
	$(document).on('click', '.quickpollsubmit', function()
	{
		
		//var fn = $("#fname").val();
		//var ln = $("#lname").val();
	        //var data = 'fname='+fn+'&lname='+ln;
		//var data = $(this).serialize();
		
		$('#quickpollsubmit').val($(this).val());
                var data = $("#quickpoll").serialize();
				
		$.ajax({
		
		type : 'POST',
		url  : 'quickpoll_vote.php',
		data : data,
		success :  function(data)
				   {						
						$("#quickpoll").fadeOut(500).hide(function()
						{
							$(".quickpollwrapper").fadeIn(500).show(function()
							{
								$(".quickpollwrapper").html(data);
								
							});
							
							
						});
						
				   }
		});
		return false;
	});	 
	
});





    



