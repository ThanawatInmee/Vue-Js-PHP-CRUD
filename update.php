<?php 

	require_once './config.php';

	$action = json_decode(file_get_contents("php://input"));
	$data = array();

	if ( $action->action == 'update' ) {

		$data = array(
			':username' => $action->username,
			':password' => $action->password,
			':id' => $action->id,
		);

		$stmt = $db->prepare("UPDATE user SET username = :username, password = :password WHERE id = :id ");
		$stmt->execute($data);

		$output = array(
			'message' => 'Data Updated'
		);

		echo json_encode($output);

	}

 ?>