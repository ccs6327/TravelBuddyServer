<?php
	require('./vendor/autoload.php');
	use OpenTok\OpenTok;
	use OpenTok\Session;
	if ($_SERVER['REQUEST_METHOD'] === 'POST') {
		if (isset($_POST['apiKey'])) {
			$opentok = new OpenTok($_POST['apiKey'], 
				'd14bc579a363bc2dee91f2de51f8ae23898fb664');
			$token = $opentok->generateToken($_POST["sessionId"]);

			$arr = array (
				'token' => $token,
			);
			echo json_encode($arr);
		}
	} else {
		echo "WRONG METHOD";
	}
?>