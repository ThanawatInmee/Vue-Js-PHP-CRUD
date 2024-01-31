<?php 

	require_once './config.php';

	$action = json_decode(file_get_contents("php://input"));
	$data = array();

	if ( $action->action == 'data' ) {

		$stmt = $db->prepare("SELECT * FROM user WHERE id = :id ");
		$stmt->execute([':id' => $action->id]);
		$result = $stmt->fetchAll();

		foreach($result as $row) {
			$data['id'] = $row['id'];
			$data['username'] = $row['username'];
			$data['password'] = $row['password'];
			$data['date'] = $row['date'];
		}

		echo json_encode($data);

	}

 ?>