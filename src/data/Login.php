<?php
require_once "autoload.php";

use Connection as conexao;	

class Login{
	private $uid;
	private $nome;

	function __construct(){

	}

	public function login($user,$pass){
		$this->db = conexao::getInstance();
		$p_sql = conexao::getInstance()->prepare("SELECT uid, nome, senha FROM est_usuarios WHERE `usuario` = :user");
		$p_sql->execute(
			array(
				':user'=>$user
			)
		);

		$row = $p_sql->fetchAll(PDO::FETCH_ASSOC);
		
		if($p_sql->rowCount()){
			if(md5($pass) == $row[0]['senha']){
				$this->uid = $row[0]['uid'];
				$this->nome = $row[0]['nome'];

				$_SESSION['user_session'] = $this->uid;

				echo json_encode(array(
					"success" => 1,
					"data" => $row
				));
			}else{
				echo json_encode(array(
					"success" => 0,
					"error" => "Senha incorreta!"
				));
			}
		}else{
			echo json_encode(array(
				"success" => 0,
				"error" => "Usuario inexistente!"
			));
		}
	}

	public function logout(){
		unset($_SESSION['user_session']);
	}

	public function check_session(){
		if(isset($_SESSION['user_session'])){
			return true;
		}
	}
 }
$user = (isset($_POST['user'])) ? $_POST['user'] : null;
$passwd = (isset($_POST['passwd'])) ? $_POST['passwd'] : null;
$login = new Login();
//$login->login($user, $passwd);

//Check if user is logged in!
//echo $login->check_session();

//$login->logout();
