<?php 
$page_title = 'Dashboard';
include('includes/header.php'); 
?>

	<!-- Begin page content 12 col layout -->
	<div class="container">
		
		<!-- header adverts -->
				<div class="row">
    		<!--
			<div class="span12 adboxtop hidden-phone">
			<a href="https://www.izettle.com/gb/?utm_source=local_partnership&utm_medium=online&utm_content=webbox&utm_campaign=webbox_banner" target="_blank">
            <span class="visible-tablet"><img src="images/iZettle_728x90.gif" alt="iZettle"></span>
            <span class="visible-desktop"><img src="images/iZettle_970x90.gif" alt="iZettle"></span>
			</a>
			</div> 
			-->
    		<div class="span12 adboxtop">
			<a href="addons.php">
            <span class="visible-phone"><img src="images/app_300x250.gif" alt="Android App"></span>
            <span class="visible-tablet"><img src="images/app_728x90.gif" alt="Android App"></span>
            <span class="visible-desktop"><img src="images/app_728x90.gif" alt="Android App"></span>
			</a>
			</div>
    	  </div><!-- /row -->
		  		
		<!-- messages -->
				 
		 <div class="row">
		 	<div class="span5" style=""><!-- calendar -->
				<div class="visible-phone text-center" style="margin-bottom:20px;"><a href="#newbookings" class="btn btn-warning">You have 0 new bookings</a></div>
				<h2>Bookings Calendar</h2>
				<p>This calendar shows your <span class="badge badge-warning">Incoming</span> and <span class="badge badge-info">Accepted</span> bookings. Click on date to see details of the booking.</p>
				<p class="text-center">
				<button id="prev" class="btn" type="button">&laquo;<span class="hidden-phone"> Prev</span></button> 
				<button id="current" class="btn" type="button">Current</button> 
				<button id="next" class="btn" type="button"><span class="hidden-phone">Next </span>&raquo;</button>
				</p>
				<div id="calendarplaceholder"></div>
				
<h2>Completed Bookings</h2>
<p>Mark job as Completed or Cancelled. Bookings will automatically be set to "cancelled" 5 days after travel date. No emails are sent.</p>

				
<div id="currentbookingrow1706" class="currentbookingrow"><form action="dashboard.php" method="post" name="current">
			<input name="bookingform" type="hidden" value="current" />
			<input name="transId" type="hidden" value="" />
			<input name="cartId" type="hidden" value="cash" />
			<input name="finalcost" type="hidden" value="" />
			<input name="vouchernumber" type="hidden" value="1706" />
				
<div class="row-fluid">
    <div class="span12">
	<!--<div class="row-fluid"> -->
	<!--<div class="span7"> -->
		<h4>Watford  to Aberdeen</h4>
		<p>Travel: Fri&nbsp;16/05/2014&nbsp;12:15</p>
		<p>Saj</p>
	<!--</div>
    <div class="span5"> -->
	
		<div id="currentjobbuttons">
	    <input name="complete" type="submit" value="Job completed" class="btn btn-success" /> 
		<input id="cancelled1706" name="cancelled" type="submit" value="Job cancelled" class="btn btn-inverse" />
		<input id="sh1706" name="showhide" type="button" value="Show/hide details" class="btn">
		</div>
		
	<!--</div> -->
	<!--</div>/row-fluid -->
    <div id="currentbookingrowmore1706" class="currentbookingrowmoreclear">
		<div class="row-fluid">
			<div class="detailscol1">Price:</div>
			<div class="detailscol2">&pound;788.30</div>
		</div>
		<div class="row-fluid">
			<div class="detailscol1">Vehicles:</div>
			<div class="detailscol2">1x saloon </div>
		</div>
		<div class="row-fluid">
			<div class="detailscol1">Name:</div>
			<div class="detailscol2">Saj</div>
		</div>
		<div class="row-fluid">
			<div class="detailscol1">Telephone:</div>
			<div class="detailscol2"><tel>07546254954</tel></div>
		</div>
		<div class="row-fluid">
			<div class="detailscol1">Email: </div>
			<div class="detailscol2"><a href="mailto:saghirshah@hotmail.com">saghirshah@hotmail.com</a></div>
		</div>
				<div class="row-fluid">
			<div class="detailscol1">Pick-up address:</div>
			<div class="detailscol2">My house</div>
		</div>
						<div class="row-fluid">
			<div class="detailscol1">Drop-off address:</div>
			<div class="detailscol2">His house</div>
		</div>
				
						
				<div class="row-fluid">
			<div class="detailscol1">More info:</div>
			<div class="detailscol2">Zac pls ignore this booking just testing</div>
		</div>
				<div class="row-fluid">
			<div class="detailscol1">Payment:</div>
			<div class="detailscol2"><span class="cashbooking">Cash booking</span></div>
		</div>
		<div class="row-fluid">
			<div class="detailscol1">Booking:</div>
			<div class="detailscol2"><p>07/05/2014 19:19:22 <br>rainbow-abbots-taxis.co.uk <br>Ref: 1706</p></div>
		</div>
			<!--<div class="row-fluid">
				<div class="detailscol1">Full message:</div>
				<div class="detailscol2"><p>If you need to contact Rainbow Abbots Taxis please call 01923 555000.<br />
If you need to amend your booking please call Rainbow Abbots Taxis on the number above.<br />
<br />
CASH booking<br />
Booking made: 07-05-2014 19:19 BST. <br />
<br />
DESCRIPTION<br />
=============================<br />
Journey: Watford  to Aberdeen<br />
Cost: 788.30 GBP<br />
<br />
SINGLE JOURNEY<br />
=============================<br />
Travel date: 16-05-2014 1215<br />
Travel direction: From Abbots Langley (or surrounds)<br />
<br />
CARS REQUIRED<br />
=============================<br />
1 x Saloon <br />
<br />
CUSTOMER INFORMATION<br />
=============================<br />
Name: Saj<br />
Phone: 07546254954<br />
Email: saghirshah@hotmail.com<br />
<br />
Pickup address: <br />
My house<br />
<br />
Dropoff address: <br />
His house<br />
<br />
Outgoing airport: <br />
Outgoing terminal: <br />
<br />
Return airport: <br />
Return terminal: <br />
Return flight no: <br />
<br />
More info: <br />
Zac pls ignore this booking just testing<br />
</p></div>
			</div> -->
			</div> 
	</div><!--/row12 -->
  </div><!--/row-fluid -->	
</form></div>

				
				<!--
				<p><span class="badge badge-warning">New/incoming (warning)</span></p>
				<p><span class="badge badge-info">Accepted (info)</span></p>
				<p><span class="badge badge-success">Active? (success)</span></p>
				<p><span class="badge badge-inverse2">Completed (inverse2)</span></p>
				<p><span class="badge badge-inverse">Cancelled (inverse)</span></p>
				<p><span class="badge badge-important"> (important)</span></p>
				 -->
			</div>
    		<div class="span7"><!-- incoming jobs -->
				<h2 id="newbookings">Incoming Bookings</h2>
				<p>Please Accept, Decline or Cancel incoming  bookings.</p>
				<p><button class="btn btn-info" type="button">Accept</button> Adds job to your calendar and sends a confirmation email to your customer.</p>
				<p><button class="btn btn-danger" type="button">Decline</button> Removes job from this list and sends a declining email to your customer.</p>
				<p><button class="btn btn-inverse" type="button">Cancel</button> Removes job from this list, no email sent.</p>
				<div class="alert alert-block"><h4>Important!</h4> If you DECLINE or CANCEL a job which has been paid for online, you must refund your customer from your PayPal or GoogleCheckout admin</div>

			
			</div><!-- /incoming jobs -->
    	  </div><!-- /row -->	  	
		
	</div><!-- /container -->
	<div id="push"></div>
</div><!-- /wrap -->

<!-- FOOTER -->
<?php echo include('includes/footer.php'); ?>


<script>

function showonlyone(thechosenone) {
     $('.datedata').each(function(index) {
          if ($(this).attr("id") == thechosenone) {
              // $(this).show() ; // this works!
			   //$('#cell' + thechosenone).css('borderBottomColor','white');
			   if($(this).is(':visible')) { // already visible, so hide
    				$(this).hide() ;
					$('#cell' + $(this).attr("id") ).css('borderBottomColor','#777777');
				} else {
					$(this).show() ; // this works!
			    	$('#cell' + thechosenone).css('borderBottomColor','white');
				}
          }
          else {
               $(this).hide() ;// this works!
				/*
				if($(this).is(':visible')) {
    				alert( $(this).attr("id") + ' is vis');
				} else {
				//	alert( $(this).attr("id") + ' not vis');
				}
				*/
			   $('#cell' + $(this).attr("id") ).css('borderBottomColor','#777777');
          }
     });
	}
	function hideall() {
     $('.datedata').each(function(index) {
	 	$(this).hide();
	  });
}
hideall();
	
$(document).ready(function(){
  
$('#cancelled1706').click(function() {
  $('#showdecline1706box').slideToggle('slow', function() {
    // Animation complete.
  });
});
$('#cancel1706').click(function() {
  $('#showdecline1706box').slideToggle('slow', function() {
    // Animation complete.
  });
});
$('#ignorebutton1706').click(function() {
  $('#showdecline1706box').slideToggle('slow', function() {
    // Animation complete.
  });
});
$('#sh1706').click(function() {
  $('#currentbookingrowmore1706').slideToggle('slow', function() {
    // Animation complete.
  });
});
$('input#declinereason1706b').change(
	function() {
        if ($(this).is(':checked')) {
			$('#otherbox1706').show();
        }
});
$('input#declinereason1706a').change(
	function() {
        if ($(this).is(':checked')) {
			$('#otherbox1706').hide();
        }
});

$('#currentbookingrowmore1706').hide();
$('#showdecline1706box').hide();
$('#otherbox1706').hide();

  //$('#sessioncountdown').countdown({until: +1200}); // auto logout count down
  // load calendar
  $("#next").click(function(){
    $("#calendarplaceholder").load("inc_calendar.php",
      {
        month:"+1"
      },
      function(data,status){
        hideall();
		//alert("Status: " + status); // "Data: " + data + "\n
      });
  });
  $("#prev").click(function(){
    $("#calendarplaceholder").load("inc_calendar.php",
      {
        month:"-1"
      },
      function(data,status){
        hideall();
		//alert("Status: " + status); // "Data: " + data + "\n
      });
  });
  $("#current").click(function(){
    $("#calendarplaceholder").load("inc_calendar.php",
      {
        month:"0"
      },
      function(data,status){
        hideall();
		//alert("Status: " + status); // "Data: " + data + "\n
      });
  });
  // load default calendar for today
  $("#calendarplaceholder").load("inc_calendar.php",
    {
      month:"0"
    },
    function(data,status){
      hideall();
    });
});
</script>

</body>
</html>