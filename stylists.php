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
		echo "<pre>".json_encode($records['msg']);
		?>

  </head>
  <body class="tm-gray-bg">
  	
  
	   <table border="1">
	   
	   	   <table>
<?php 
	
		foreach( $records['msg'] as $record ){		   
	echo "<tr>";
	echo "<td><img src='img/pic_mountain.jpg' alt='Mountain View'></td>";
	echo "<td>&nbsp;&nbsp;&nbsp;</td>";
	echo "<td align='top'>" .$record['shops_name'] ."<br> <br> <br>" .$record['shops_address']."</td>";
	echo "<td>&nbsp;&nbsp;&nbsp;</td>";
	echo "<td align='top'><button type='submit' name='submit' value ='".$record['shops_id']."' class='tm-yellow-btn'> Book Now </button> </td>";
	echo "</tr>";
   }	
	
	
?> 
</table>
	   
  
	
	
 </body>
 </html>













