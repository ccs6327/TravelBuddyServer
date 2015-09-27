<?php
	require('./vendor/autoload.php');
	use OpenTok\OpenTok;
	if ($_SERVER['REQUEST_METHOD'] === 'POST') {
		if (isset($_POST['apiKey'])) {
			$opentok = new OpenTok($_POST['apiKey'], 
				'd14bc579a363bc2dee91f2de51f8ae23898fb664');
			$session = $opentok->createSession();
			$sessionId = $session->getSessionId();
			$token = $session->generateToken();

			// $arr = array (
			// 	'sessionId' => $sessionId,
			// 	'token' => $token,
			// );
			// echo json_encode($arr);
			echo $sessionId.'"'.$token;

			//latest active session save to database
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

			$sql = "SELECT * FROM session";
			$result = $conn->query($sql);

			if ($result->num_rows > 0) {
			    //replace it
			    $stmt = $conn->prepare("UPDATE session 
									    SET sessionId = ?
									    WHERE sessionId <> ''"); 
				$stmt->bind_param("s", $sessionId);
				$stmt->execute();		
			} else {
				//add it	
				$sql = "INSERT INTO session (sessionId)
				VALUES ('". $sessionId ."')";

				if ($conn->query($sql) === TRUE) {
				    error_log("New record created successfully");
				} else {
				    error_log("Error: " . $sql . "<br>" . $conn->error);
				}	
			}

			$conn->close();
		} else {
			echo "MISSING API KEY";
		}
	} else {
		echo "WRONG METHOD";
	}
?>