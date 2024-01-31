<?php 

	require_once './config.php';

	$action = json_decode(file_get_contents("php://input"));
	$data = array();

	if ( $action->action == 'delete' ) {

		$stmt = $db->prepare("DELETE FROM user WHERE id = :id");
		$stmt->execute([':id' => $action->id]);

		$output = array(
			'message' => 'Data Deleted'
		);

		echo json_encode($output);

	}

 ?>