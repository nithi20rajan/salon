<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Holiday - templatemo</title>
<!--
Holiday Template
http://www.templatemo.com/tm-475-holiday
-->
  <link href='http://fonts.googleapis.com/css?family=Open+Sans:400,300,400italic,600,700' rel='stylesheet' type='text/css'>
  <link href="css/font-awesome.min.css" rel="stylesheet">
  <link href="css/bootstrap.min.css" rel="stylesheet">
  <link href="css/bootstrap-datetimepicker.min.css" rel="stylesheet">  
  <link href="css/flexslider.css" rel="stylesheet">
  <link href="css/templatemo-style.css" rel="stylesheet">

  <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
	
			<?php
		// including the db connection file into the page 
		require "common/DB_Handler.class.php";

		$db_host = "localhost";
		$db_name = "salondb";
		$db_username = "root";
		$db_password = "password";

		$salon_db = new DB_Handler( $db_host, $db_name, $db_username, $db_password );
		$result = $salon_db->connect();
		if($result)
			echo "Meow-tastic!";
		else 
			die();	

		if(isset($_POST['submit'])){
		$selected_city = $_POST['city'];  // Storing Selected Value In Variable
		$selected_area = $_POST['area'];
		$selected_service = $_POST['service'];
		$selected_date = $_POST['date1'];
		//echo $selected_date;
		//echo "You have selected :" .$selected_val;  // Displaying Selected Value
		}

		// Specify table name for record fetch
		$table = 'salon_shops';

		// fetch all the resords
		//$records = $salon_db->get( $table );

		// fetch the specific record
		$records = $salon_db->get( $table, $selected_city, $selected_area, $selected_service );
         //print_r ($records);
		//Simply formats our results so they are easier to read
		//echo"<pre>";
		?>

  </head>
  <body class="tm-gray-bg">
  	<!-- Header -->
  	<div class="tm-header">
  		<div class="container">
  			<div class="row">
  				<div class="col-lg-6 col-md-4 col-sm-3 tm-site-name-container">
  					<a href="#" class="tm-site-name">INSTA BEAUTY</a>	
  				</div>
	  			<div class="col-lg-6 col-md-8 col-sm-9">
	  				<div class="mobile-menu-icon">
		              <i class="fa fa-bars"></i>
		            </div>
	  				<nav class="tm-nav">
						<ul>
							<li><a href="index.php" class="active">Home</a></li>
							<li><a href="signup.php">Sign Up/Log In</a></li>
							<li><a href="index.php">Log Out</a></li>
						</ul>
					</nav>		
	  			</div>				
  			</div>
  		</div>	  	
  	</div>
	
	<!-- Banner -->
	<section class="tm-banner">
		<!-- Flexslider -->
		<div class="flexslider flexslider-banner">
		  <ul class="slides">
		    <li>
			    <div class="tm-banner-inner">
					<h1 class="tm-banner-title">Find <span class="tm-yellow-text">The Best</span> Place</h1>
					<p class="tm-banner-subtitle">For Your Holidays</p>

					<form action="stylists.php" method="post" class="hotel-search-form">
						<div class="tm-form-inner">
							<div class="form-group">
								<table>
									<tr>
										<td>
							            	<select name="city" class="form-control">
							            	 	<option selected value="0">Select City</option>
												<option value="1">Bangalore</option>
												<option value="2">Chennai</option>
											</select> 
										</td>	
										<td>&nbsp;&nbsp;</td>
										<td>										
											<select name="area" class="form-control">
							            	 	<option selected value="0">Select Area</option>
												<option value="1">Marathahalli</option>
												<option value="2">Brookfields, ITPL Main Road</option>
												<option value="3">AECS Layout</option>
												<option value="4">Banashankri II Stage</option>
												<option value="5">BTM Layout</option>
												<option value="6">Jayanagar</option>
											</select> 
										</td>
										<td>&nbsp;&nbsp;</td>
										<td>
											<select name="service" class="form-control">
							            	 	<option selected value="0">Select Service</option>
												<option value="loc=Bangalore">Haircut</option>
												<option value="loc=Chennai" >facial</option>
												<option value="loc=Chennai" >waxing</option>
												<option value="loc=Chennai" >hair spa</option>
											 </select>
									    </td>
										<td>&nbsp;&nbsp;</td>
										<td>
											<button type="submit" name="submit" class="tm-yellow-btn">Search</button>											 
										</td>
									<tr>
								</table>
							</div>
						</div>						
					</form>
				</div>
				<img src="img/banner-1.jpg" alt="Image" />	
		    </li>
		  </ul>
		</div>	
	</section>
	


	<!-- gray bg -->	
	<section class="container tm-home-section-1" id="more">
		<div class="row">
		<br>
		<br>
		<br>
       <center> 
	   
<form method="post" action="services.php"  class="hotel-search-form">
  
	   <table border="1">
	   
	   	   <table>
<?php foreach( $records['msg'] as $record ){		   
	echo "<tr>";
	echo "<td><img src='img/pic_mountain.jpg' alt='Mountain View'></td>";
	echo "<td>&nbsp;&nbsp;&nbsp;</td>";
	echo "<td align='top'>" .$record['shops_name'] ."<br> <br> <br>" .$record['shops_services']."</td>";
	echo "<td>&nbsp;&nbsp;&nbsp;</td>";
	echo "<td align='top'><button type='submit' name='submit' value ='".$record['shops_id']."' class='tm-yellow-btn'> Book Now </button> </td>";
	echo "</tr>";
   }
?> 
</table>
	   
  
<!--	   <table> 	   
<tr>
	<td><img src="file:///D:/saloon/templatemo_475_holiday/img/pic_mountain.jpg" alt="Mountain View"></td>
	<td>&nbsp;&nbsp;&nbsp;</td>
	<td align="top">Multiple Services $45 - $50 <br> <br> <br><a href="">View Photos</a></td>
	<td>&nbsp;&nbsp;&nbsp;</td>
	<td align="top"><button class="tm-yellow-btn"> Book Now </button> </td>
</tr>
<tr>
	<td><img src="file:///D:/saloon/templatemo_475_holiday/img/pic_mountain.jpg" alt="Mountain View"></td>
	<td>&nbsp;&nbsp;&nbsp;</td>
	<td>Multiple Services $45 - $50 <br> <br> <br><a href="">View Photos</a></td>
	<td>&nbsp;&nbsp;&nbsp;</td>
	<td><button class="tm-yellow-btn"> Book Now </button> </td>
</tr>
<tr>
	<td><img src="file:///D:/saloon/templatemo_475_holiday/img/pic_mountain.jpg" alt="Mountain View"></td>
	<td>&nbsp;&nbsp;&nbsp;</td>
	<td>Multiple Services $45 - $50 <br> <br> <br><a href="">View Photos</a></td>
	<td>&nbsp;&nbsp;&nbsp;</td>
	<td><button class="tm-yellow-btn">Book Now</button> </td>
</tr>
<tr>
	<td><img src="file:///D:/saloon/templatemo_475_holiday/img/pic_mountain.jpg" alt="Mountain View"></td>
	<td>&nbsp;&nbsp;&nbsp;</td>
	<td>Multiple Services $45 - $50 <br> <br> <br><a href="">View Photos</a></td>
	<td>&nbsp;&nbsp;&nbsp;</td>
	<td><button class="tm-yellow-btn"> Book Now </button> </td>
</tr>

</table>-->
</form>
</center>
		</div>

	</section>		
	
	<!-- white bg -->

	<footer class="tm-black-bg">
		<div class="container">
			<div class="row">
				<p class="tm-copyright-text">Copyright &copy; 2084 Your Company Name 
                
                | Designed by <a rel="nofollow" href="http://www.templatemo.com" target="_parent">templatemo</a></p>
			</div>
		</div>		
	</footer>
	<script type="text/javascript" src="js/jquery-1.11.2.min.js"></script>      		<!-- jQuery -->
  	<script type="text/javascript" src="js/moment.js"></script>							<!-- moment.js -->
	<script type="text/javascript" src="js/bootstrap.min.js"></script>					<!-- bootstrap js -->
	<script type="text/javascript" src="js/bootstrap-datetimepicker.min.js"></script>	<!-- bootstrap date time picker js, http://eonasdan.github.io/bootstrap-datetimepicker/ -->
	<script type="text/javascript" src="js/jquery.flexslider-min.js"></script>
<!--
	<script src="js/froogaloop.js"></script>
	<script src="js/jquery.fitvid.js"></script>
-->
   	<script type="text/javascript" src="js/templatemo-script.js"></script>      		<!-- Templatemo Script -->
	<script>
		// HTML document is loaded. DOM is ready.
		$(function() {

			$('#hotelCarTabs a').click(function (e) {
			  e.preventDefault()
			  $(this).tab('show')
			})

        	$('.date').datetimepicker({
            	format: 'MM/DD/YYYY'
            });
            $('.date-time').datetimepicker();

			// https://css-tricks.com/snippets/jquery/smooth-scrolling/
		  	$('a[href*=#]:not([href=#])').click(function() {
			    if (location.pathname.replace(/^\//,'') == this.pathname.replace(/^\//,'') && location.hostname == this.hostname) {
			      var target = $(this.hash);
			      target = target.length ? target : $('[name=' + this.hash.slice(1) +']');
			      if (target.length) {
			        $('html,body').animate({
			          scrollTop: target.offset().top
			        }, 1000);
			        return false;
			      }
			    }
		  	});
		});
		
		// Load Flexslider when everything is loaded.
		$(window).load(function() {	  		
			// Vimeo API nonsense
		//	changeDiv()
/*
			  var player = document.getElementById('player_1');
			  $f(player).addEvent('ready', ready);
			 
			  function addEvent(element, eventName, callback) {
			    if (element.addEventListener) {
			      element.addEventListener(eventName, callback, false)
			    } else {
			      element.attachEvent(eventName, callback, false);
			    }
			  }
			 
			  function ready(player_id) {
			    var froogaloop = $f(player_id);
			    froogaloop.addEvent('play', function(data) {
			      $('.flexslider').flexslider("pause");
			    });
			    froogaloop.addEvent('pause', function(data) {
			      $('.flexslider').flexslider("play");
			    });
			  }
*/

			 
			 
			  // Call fitVid before FlexSlider initializes, so the proper initial height can be retrieved.
/*

			  $(".flexslider")
			    .fitVids()
			    .flexslider({
			      animation: "slide",
			      useCSS: false,
			      animationLoop: false,
			      smoothHeight: true,
			      controlNav: false,
			      before: function(slider){
			        $f(player).api('pause');
			      }
			  });
*/


			  

//	For images only
		    $('.flexslider').flexslider({
			    controlNav: false
		    });


	  	});
		
			function disableTest(){
             alert("mahesh123")
            document.getElementById("more").disabled = true;
            var nodes = document.getElementById("more").getElementsByTagName('*');
            for(var i = 0; i < nodes.length; i++){
                nodes[i].disabled = true;
            }

         }
		 
		 function changeDiv()
      {
	   alert("mahesh143")
      document.getElementById('more').hidden = "hidden"; // hide body div tag
      //document.getElementById('body1').hidden = ""; // show body1 div tag
     // document.getElementById('body1').innerHTML = "If you can see this, JavaScript function worked"; 
      // display text if JavaScript worked
       }

	</script>

 </body>
 </html>













