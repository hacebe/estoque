<?php
include "autoload.php";

use Connection as conexao;	

class Login{
	public $uid;
	public $nome;

	function __construct($user, $pass){
		$this->db = conexao::getInstance();
		$p_sql = conexao::getInstance()->prepare("SELECT uid, nome FROM est_usuarios WHERE `usuario` = '$user' and `senha` = '" . md5($pass) . "'");
		$p_sql->execute();

		$result = $p_sql->fetchAll(PDO::FETCH_ASSOC);
		
		if(sizeof($result)){
			$this->uid = $result[0]['uid'];
			$this->nome = $result[0]['nome'];

			echo json_encode(array(
				"success" => 1,
				"data" => $result
			));
		}else{
			echo json_encode(array(
				"success" => 0,
				"error" => "Usuario e/ou senha incorretos(as)"
			));
		}
	}
 }

//$login = new Login($_POST['user'], $_POST['passwd']);
$login = new Login("hacebe", "102030");
