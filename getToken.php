<?php
	require('/vendor/autoload.php');
	use OpenTok\OpenTok;
	use OpenTok\Session;
	if ($_SERVER['REQUEST_METHOD'] === 'GET') {
		//TODO move API key, sessionID to client side request headers
		$opentok = new OpenTok('45355412', 
			'd14bc579a363bc2dee91f2de51f8ae23898fb664');
		$token = $opentok->generateToken($_GET["sessionId"]);

		$arr = array (
			'token' => $token,
		);
		echo json_encode($arr);
		//TODO save to database
	} else {
		echo "WRONG METHOD";
	}
?>