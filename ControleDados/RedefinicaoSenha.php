<?php
namespace mailjet;
use \Mailjet\Resources;
require 'mailjet/vendor/autoload.php';

Class MailjetMail
{
	public function emailPost($nameUser, $emailUser, $passUser)
	{
			$client = new \Mailjet\Client('308f549a732b5fbd97b43f0b0c6f3054', 'e1400ff82ace61bd86a0a57b1998510b');
			$email = [
				'FromName'     => 'Academiq',
				'FromEmail'    => 'marcos.junior@uniriotec.br',
				'Text-Part'    => '',
				'Html-Part'    => '<h2>Olá, ' . $nameUser .'</h2><br><p>Este e-mail foi enviado em resposta a uma solicitação de redefinição de senha.</p><br><p>Sua nova senha é:' . $passUser . '</p><br><p>           Equipe Academiq</p>',
				'Subject'      => 'Academiq - Redefinição de Senha',
				'Recipients'   => [['Email' => $emailUser]],
			];

			$ret = $client->post(Resources::$Email, ['body' => $email]);

	}
}
	header('Content-Type: text/html; charset=utf-8');
	include_once 'Base.php';

	function redefinirSenha() {
		$email = $_POST['email'];

		$_POST['func'] = "";
		include_once 'Usuario.php';

		if (existeEmail($email)) {
			$nomeUsuario= getByEmailIgualUsuario($email);
			$senha = substr(md5(rand()), 0, 7);
			$senhaHash = hash('sha256', $senha);

			// Salva nova senha no banco:
			$sql = "UPDATE Usuario SET senha = '$senhaHash' WHERE email = '$email'";
			$emailSender= new MailjetMail();
			$emailSender->emailPost($nomeUsuario, $email, $senha);

			echo query_no_result($sql);

		} else {
			echo ("[]");
		}
	}


	$func = $_POST['func'];

	switch ($func) {
		case "redefinirSenha":
			redefinirSenha();
			break;
	}

?>
