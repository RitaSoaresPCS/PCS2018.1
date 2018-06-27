<?php
	header('Content-Type: text/html; charset=utf-8');
	include_once 'Base.php';
		
	function verificarPermissaoUsuarioVisualizaComunidade() {
		$idUsuario = $_POST['idUsuario'];
		$idComunidade = $_POST['idComunidade'];
		
		// Verifica se o usuário está na tabela UsuarioVisualizaComunidade OU
		// é parceiro OU
		// é membro.
		
		$sql = "SELECT (a.r + b.r + c.r) AS result FROM (SELECT COUNT(*) AS r FROM usuario where id=$idUsuario and idComunidadePertence = $idComunidade) AS a, (SELECT COUNT(*) AS r FROM usuarioparceriacomunidade where idUsuario=$idUsuario and idComunidade = $idComunidade) AS b, (SELECT COUNT(*) AS r FROM usuariovisualizacomunidade where idUsuario=$idUsuario and idComunidade = $idComunidade) AS c";
		
		$result = query_result($sql);
		$return = array();
		$return['exibir'] = false;
		
		if (mysqli_num_rows($result) > 0) {
			while($row = mysqli_fetch_assoc($result)) {
				$resultado = $row["result"];
				
				// Tem alguma permissão:
				if ($resultado > 0) {
					$return['exibir'] = true;
				} 
			}
		} 
		
		echo json_encode($return);
	}
	
	
	function solicitarAcessoUsuarioVisualizaComunidade() {
		$idUsuario = $_POST['idUsuario'];
		$idComunidade = $_POST['idComunidade'];
		$justificativa = $_POST['justificativa'];

		// Deveria ser feita uma Solicitacao para o administrador do laboratório antes de ser dada permissão, para
		// que ele pudesse aceitar ou rejeitar, porém manter solicitação está fora do escopo.
		$sql = "INSERT INTO UsuarioVisualizaComunidade VALUES($idUsuario, $idComunidade)";
		
		echo query_no_result($sql);		
	}
	
	

	$func= $_POST['func'];

	if ($_SESSION['idUsuarioLogado'] != "") { // Usuário no mínimo deve estar logado.
		switch ($func) {
			case "verificarPermissaoUsuarioVisualizaComunidade":
				verificarPermissaoUsuarioVisualizaComunidade();
				break;
			case "solicitarAcessoUsuarioVisualizaComunidade":
				solicitarAcessoUsuarioVisualizaComunidade();
				break;
		}
	}

?>