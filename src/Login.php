<?php

	require_once "autoload.php";

	use Connection as conexao;	

	final class Login {



		public static function submit($user,$pass) {

			$p_sql = conexao::getInstance()->prepare("SELECT uid, nome, senha FROM est_usuarios WHERE `usuario` = :user");
			$p_sql->execute(
				array(
					':user' => $user
				)
			);

			$row = $p_sql->fetchAll(PDO::FETCH_ASSOC);
			
			if($p_sql->rowCount()) {
				if($pass == $row[0]['senha']) {

					$row = $row[0];

					unset($row['senha']);

					$_SESSION['user_session'] = $row['uid'];
					$key = self::createSessionHash($user);
					$row['key'] = $key;


					return json_encode(array(
						"error" => 0,
						"data" => $row
					));

				}

				else {

					return $app["Responses"][2];
				}
			}

			else {

				return $app["Responses"][3];
			}
		}

	public static function createSessionHash($user){
		$key = md5($user . ":" . time());

		$expiry = time() + 300;

		try{
			$p_sql = conexao::getInstance()->prepare("INSERT INTO est_session_keys VALUES (null, 'usuario', :key, :expiry)");
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

	public static function logout(){
		unset($_SESSION['user_session']);
	}

	public static function check_session($key){

		$now = time();

		try{
			$p_sql = conexao::getInstance()->prepare("SELECT * FROM est_session_keys WHERE `key` = :key and expiry > :now");
			$stmt = $p_sql->execute(
				array(
					':key'=>$key,
					':now'=>$now
				)
			);
		}catch(PDOException $e){
			echo $e->getMessage();
		}


		if($p_sql->rowCount()) {

			$row = $p_sql->fetch(PDO::FETCH_ASSOC);
			$expiry = $now + 300; 
			try {

				$p_sql = conexao::getInstance()->prepare("UPDATE est_session_keys SET `expiry` = :expiry WHERE `key` = :key");
				$stmt = $p_sql->execute(
					array(
						':expiry'=>$expiry,
						':key'=>$key
					)
				);
			}

			catch(PDOException $e) {

				echo $e->getMessage();
			}

			return true;
		}else{
			return false;
		}
		
	}
 }
