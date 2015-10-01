<?php
	if ($_SERVER['REQUEST_METHOD'] === 'GET') {
		$servername = "localhost";
		$username = "root";
		$password = "";
		$dbname = "travel_buddy";

		// Create connection
		$conn = new mysqli($servername, $username, $password, $dbname);
		// Check connection
		if ($conn->connect_error) {
		    die("Connection failed: " . $conn->connect_error);
		} 

		$sql = "SELECT (sessionId) FROM session";
		$result = $conn->query($sql);

		if ($result->num_rows > 0) {
			$row = $result->fetch_array(MYSQLI_NUM);		
			echo $row[0];
		} else {
		    erro_log("Error: " . $sql . "<br>" . $conn->error);
		}	
	} else {
		echo "WRONG METHOD";
	}
?>