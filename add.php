<?php 

	require_once './config.php';

	$action = json_decode(file_get_contents("php://input"));
	$data = array();

	if ( $action->action == 'insert' ) {

		$data = array(
			':username' => $action->username,
			':password' => $action->password
		);

		$stmt = $db->prepare("INSERT INTO user ( username, password, date ) VALUES ( :username, :password, NOW() ) ");
		$stmt->execute($data);

		$output = array(
			'message' => 'Data Inserted'
		);

		echo json_encode($output);

	}

 ?>