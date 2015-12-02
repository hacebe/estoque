<?php

require_once "autoload.php";

use Connection as conexao;

class Login{
	private $uid;
	private $nome;

	function __construct(){

	}

	public function login($user,$pass){
		$p_sql = conexao::getInstance()->prepare("SELECT uid, nome, senha FROM est_usuarios WHERE `usuario` = :user");
		$p_sql->execute(
			array(
				':user'=>$user
			)
		);

		$row = $p_sql->fetchAll(PDO::FETCH_ASSOC);
		
		if($p_sql->rowCount()){
			if($pass == $row[0]['senha']){
				$this->uid = $row[0]['uid'];
				$this->nome = $row[0]['nome'];
				$row[0]['senha'] = null;
				unset($row[0]['senha']);

				$_SESSION['user_session'] = $this->uid;
				$hash = $this->createSessionHash($user);
				setcookie('sess_key', $hash);

				echo json_encode(array(
					"success" => 1,
					"data" => $row,
					"hash" => $hash
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

	private function createSessionHash($user){
		$key = md5($user . ":" . time());

		$expiry = time() + 300;

		try{
			$p_sql = conexao::getInstance()->prepare("INSERT INTO est_session_keys VALUES (null, :key, :expiry)");
			$p_sql->execute(
				array(
					':key'=>$key,
					':expiry'=>$expiry
				)
			);

			return $key;
		}catch(PDOException $e){
			return $e->getMessage();			
		}

	}

	public function logout(){
		unset($_SESSION['user_session']);
	}

	public function check_session(){
		$cookie = (isset($_COOKIE['sess_key'])) ? $_COOKIE['sess_key'] : null;

		if(!$cookie) return false;

		$now = time();

		try{
			$p_sql = conexao::getInstance()->prepare("SELECT * FROM est_session_keys WHERE `key` = :key and expiry > :now");
			$stmt = $p_sql->execute(
				array(
					':key'=>$cookie,
					':now'=>$now
				)
			);
		}catch(PDOException $e){
			echo $e->getMessage();
		}


		if($p_sql->rowCount()){
			$row = $p_sql->fetch(PDO::FETCH_ASSOC);
			$expiry = $row['expiry'] + 300; 
			try{
				$p_sql = conexao::getInstance()->prepare("UPDATE est_session_keys SET `expiry` = :expiry WHERE `key` = :key");
				$stmt = $p_sql->execute(
					array(
						':expiry'=>$expiry,
						':key'=>$key
					)
				);
			}catch(PDOException $e){
				echo $e->getMessage();
			}
			return true;
		}else{
			return false;
		}
		
	}
 }
/*$user = (isset($_POST['user'])) ? $_POST['user'] : null;
$passwd = (isset($_POST['passwd'])) ? $_POST['passwd'] : null;
$login = new Login();
$login->login($user, $passwd);*/

//Check if user is logged in!
//echo $login->check_session();

//$login->logout();
