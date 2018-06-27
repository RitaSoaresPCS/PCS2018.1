<?php
	header('Content-Type: text/html; charset=utf-8');
	include_once 'Base.php';
		
	function getAmizade() {
		$idVisualizador = $_POST['idVisualizador'];
		$idPerfil = $_POST['idPerfil'];
		
		$sql = "SELECT * from UsuarioAmizadeUsuario where (idUsuario1 = $idVisualizador AND idUsuario2 = $idPerfil) OR (idUsuario1 = $idPerfil AND idUsuario2 = $idVisualizador)";
		
		$result = query_result($sql);
		$return = array();
		
		if (mysqli_num_rows($result) > 0) {
			
			// Para cada linha de resultado:
			while($row = mysqli_fetch_assoc($result)) {
				$idUsuario1 = $row["idUsuario1"];
				$idUsuario2 = $row["idUsuario2"];
				
				$s = "{'idUsuario1': '$idUsuario1', 'idUsuario2': '$idUsuario2'}";
				array_push($return, str_replace("'", "\"", $s));
			}
		} 
				
		// Retorna o array concatenado.
		echo "[" . implode(",", $return) . "]";
	}
	
	
	function removerUsuarioAmizadeUsuario() {
		$idVisualizador = $_POST['idVisualizador'];
		$idPerfil = $_POST['idPerfil'];

		$sql = "DELETE FROM UsuarioAmizadeUsuario where (idUsuario1 = $idVisualizador AND idUsuario2 = $idPerfil) OR (idUsuario1 = $idPerfil AND idUsuario2 = $idVisualizador)";
		
		// Retorna um json com o resultado.
		echo query_no_result($sql);		
	}
	
	
	function adicionarUsuarioAmizadeUsuario() {
		$idVisualizador = $_POST['idVisualizador'];
		$idPerfil = $_POST['idPerfil'];

		// Deveria ser feita uma Solicitacao para o usuario2 (idPerfil) antes de ser adicionado, para
		// que ele pudesse aceitar ou rejeitar a amizade, porém manter solicitação está fora do escopo.
		$sql = "INSERT INTO UsuarioAmizadeUsuario VALUES($idVisualizador, $idPerfil)";
		
		echo query_no_result($sql);		
	}
	

	$func= $_POST['func'];

	if ($_SESSION['idUsuarioLogado'] != "") { // Usuário no mínimo deve estar logado.
		switch ($func) {
			case "getAmizade":
				getAmizade();
				break;
			case "removerUsuarioAmizadeUsuario":
				removerUsuarioAmizadeUsuario();
				break;
			case "adicionarUsuarioAmizadeUsuario":
				adicionarUsuarioAmizadeUsuario();
				break;
		}
	}
?>