<?php

class DB_Handler{
    private $host;
    private $db_name;
    private $db_username;
    private $db_password;
	public $dbh;
	
    public function __construct( $db_host, $db_name, $db_username, $db_password ){
        $this->host = $db_host;
        $this->db_name = $db_name;
        $this->db_username = $db_username;
        $this->db_password = $db_password;
    }
	
	// connect method to talk to the database.
	public function connect(){
    try{
        $this->dbh = new PDO( 'mysql: host=' . $this->host . ';dbname=' . $this->db_name, $this->db_username, $this->db_password );
        $this->dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }
    catch ( PDOException $e) {
        $error = "Error!: " . $e->getMessage() . '<br />';
        echo $error;
        return FALSE;
    }
    return TRUE;
	}
	
	// Fetch / read results from the table specified and id value specified.
	// if no id value is passed, it takes false as default and fetches all records. ELSE take the row where id is given.
	public function get($table, $city=false, $id=false, $service=false){    
    try{
		echo "<pre> city ".$city;
		echo "<pre> area ".$id;
		echo "<pre> serv ".$service;
		
        //$query = "SELECT * FROM " . $table.",salon_shops_services, salon_service";
        if( $city and $id and $service)
        {
			
			echo "<pre> #1 inside if ";
			//echo $service;
            //$query .= "select WHERE city_id = :city and neighborhoods_id = :id and shops_services contains :service";
        	$tempquery = "select shop_id from salon_shops_services WHERE service_id =:service";
			$tempstmt = $this->dbh->prepare( $tempquery );
			$tempstmt->bindParam( ':service', $service );
			$count = $tempstmt->execute();
			$tempmsg = $tempstmt->fetchAll(PDO::FETCH_ASSOC);
			
			$product_ids = array();
			foreach ($tempmsg as $row) {
				//echo $row['shop_id'];
				$product_ids[]  = $row['shop_id'];
			}
			$comma_separated_ids = implode(",", $product_ids);

			$sqlquery = "select * from salon_shops where shops_id in ($comma_separated_ids)";
			echo "$sqlquery";
			$stmt= $this->dbh->prepare( $sqlquery );
			$count = $stmt->execute();
			//echo $count;
			$msg = $stmt->fetchAll(PDO::FETCH_ASSOC);
			$count = $stmt->execute();
			echo "<pre> row count = ".$count;
			$success = true;
			return array(
	        'msg' => $msg,
	        'success' => $success
	    	);
			 /* 
        } else {
             $stmt = $this->dbh->prepare( $query );
        }*/

        //$count = $stmt->execute();
		//echo $count;
		
    }
    else
    	echo "fail";
}
    catch( PDOException $e ){
        $msg = "Error!: " . $e->getMessage() . "<br />";
        $success = FALSE;
    };

	    /*return array(
	        'msg' => $msg,
	        'success' => $success
	    );*/
	}	
	
	// Fetch / read results from the table specified and id value specified.
	// if no id value is passed, it takes false as default and fetches all records. ELSE take the row where id is given.
	public function addUser($name, $email, $pwd, $phone){    

    try{
		
		$sql = "INSERT INTO salon_users (firstname, email, pwd, phone) VALUES (:name, :email, :pwd, :phone)";
		echo $sql;
				
		$stmt = $this->dbh->prepare( $sql );
        $stmt->bindParam( ':name', $name );
		$stmt->bindParam( ':email', $email );
		$stmt->bindParam( ':pwd', $pwd );
		$stmt->bindParam( ':phone', $phone );
		
		$count = $stmt->execute();
		
		if($count > 0)
		{
                return 1;
		} 
    }
    catch( PDOException $e ){
        $msg = "Error!: " . $e->getMessage() . "<br />";
		echo $sql . "<br>" . $e->getMessage();
        //$success = FALSE;
    };

   	}
	
	public function getUser($email1, $pwd1){
		
	try{
        $query = "SELECT firstname FROM salon_users";
        
		if( $email1 != "" and $pwd1 !=""){
             $query .= " WHERE email = :email and pwd = :pwd ";
			 
			 $stmt = $this->dbh->prepare( $query );
			 $stmt->bindParam( ':email', $email1 );
			 $stmt->bindParam( ':pwd', $pwd1 );
        } 
        $count = $stmt->execute();

        if( $count > 0 ){
            echo "$count";
			$success = TRUE;
			
			$firstname =  $stmt->fetchColumn();
			
			if ($firstname != "")
			{
				echo "success";
				return $firstname;
			}
			
        } else {
            $success = FALSE;
			$msg = 'Something went wrong!';
        } 
    }
    catch( PDOException $e ){
        $msg = "Error!: " . $e->getMessage() . "<br />";
        $success = FALSE;
    };

	}
	
	public function getServices($shops_id){
		try{
			$query = "SELECT shops_services FROM salon_shops";

			if($shops_id != ""){
             $query .= " where shops_id = $shops_id ";
			 $stmt = $this->dbh->prepare( $query );
			} 

			$count = $stmt->execute();
			
			if( $count > 0 ){
				$success = TRUE;
				$msg =  $stmt->fetchColumn();
			} else {
				$success = FALSE;
				$msg = 'Something went wrong!';
			} 
		}
		
    catch( PDOException $e ){
        $msg = "Error!: " . $e->getMessage() . "<br />";
        $success = FALSE;
    };

    return $msg;
	
	}

public function getAreas(){    
    try{
				
        $query = "select neighborhoods_id,neighborhoods_name from salon_neighborhoods";
        $stmt = $this->dbh->prepare( $query );
		$count = $stmt->execute();
		//echo $count;
		
        if( $count > 0 ){
			
            $success = TRUE;
            $msg =  $stmt->fetchAll(PDO::FETCH_ASSOC);
			
        } else {
            $success = FALSE;
            $msg = 'Something went wrong!';
        }
    }
    catch( PDOException $e ){
        $msg = "Error!: " . $e->getMessage() . "<br />";
        $success = FALSE;
    };

    return array(
        'msg' => $msg,
        'success' => $success
    );
	}	
	
	public function getDropdownVal($name){    
		try{
	 

			$query = "select neighborhoods_id,neighborhoods_name from salon_neighborhoods";
			$stmt = $this->dbh->prepare( $query );
			$count = $stmt->execute();
		
			if( $count > 0 ){
				$success = TRUE;
				$msg1 =  $stmt->fetchAll(PDO::FETCH_ASSOC);
			
				if($name =="area")    
					$_SESSION['Area'] = $msg1;
				else
					$_SESSION['Service'] = $msg1;
			} else {
				$success = FALSE;
				$msg1 = 'Something went wrong!';
			}
		}
		catch( PDOException $e ){
			$msg1 = "Error!: " . $e->getMessage() . "<br />";
			$success = FALSE;
		};

		return array(
			'msg' => $msg1,
			'success' => $success
		);
	}	
	
	public function runQuery($query) {
		$stmt = $this->dbh->prepare($query);
		$count = $stmt->execute();
		  
		if( $count > 0 ){
			$success = TRUE;
			$msg =  $stmt->fetchAll(PDO::FETCH_ASSOC);
		}
		else {
			$success = FALSE;
			$msg = 'Something went wrong!';
		}
		
		return array(
			'msg' => $msg,
			'success' => $success
		);
	}	
	public function getCity(){    
    try{
		ECHO "Mahesh";
        $query = "select city_id,city_name from salon_city";
        $stmt = $this->dbh->prepare($query);
		$count = $stmt->execute();
		echo "Hello Mahesh" .$count;
		
        if( $count > 0 ){
            $success = TRUE;
            $msg =  $stmt->fetchAll(PDO::FETCH_ASSOC);
			
        } else {
            $success = FALSE;
            $msg = 'Something went wrong!';
        }
    }
    catch( PDOException $e ){
        $msg = "Error!: " . $e->getMessage() . "<br />";
        $success = FALSE;
    };

    return array(
        'msg' => $msg,
        'success' => $success
    );
	}	
	
}


?>