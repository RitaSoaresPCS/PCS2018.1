<?php
	function logout() {
		$GLOBALS['userId'] = null;
	}

  
	$func = $_POST['func'];

	switch ($func) {
		case "logout":
			logout();
			break;
	}
  
?>