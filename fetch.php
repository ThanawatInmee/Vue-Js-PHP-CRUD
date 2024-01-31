<?php 

	require_once './config.php';

	$action = json_decode(file_get_contents("php://input"));
	$data = array();

	if ( $action->action == 'fetchall' ) {

		$stmt = $db->prepare("SELECT * FROM user");
		$stmt->execute();

		while ($result = $stmt->fetch(PDO::FETCH_ASSOC)) {
			$data[] = $result;
		}
		echo json_encode($data);

	}

 ?>