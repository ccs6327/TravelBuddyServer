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

			$arr = array (
				'sessionId' => $sessionId,
				'token' => $token,
			);
			echo json_encode($arr);

			//TODO save to database
		} else {
			echo "MISSING API KEY";
		}
	} else {
		echo "WRONG METHOD";
	}
?>