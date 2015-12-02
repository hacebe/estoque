<?php
	require_once "autoload.php";

	use Connection as conexao;	

	class Categoria {

		private $cid;
		private $nome;
		private $db;
		
		function __construct() {}

		public function getCategorias() {

			global $app;

			$p_sql = conexao::getInstance()->prepare('SELECT * FROM est_categorias');
			$p_sql->execute();

			$rows = $p_sql->fetchAll(PDO::FETCH_ASSOC);

			if($p_sql->rowCount()) {
				return json_encode(
					array(
						"error" => 0,
						"data" => $rows
					)
				);
			}

			else {

				return $app["Responses"][4];
			}
		}

		public function getCategoriaData($id) {

			$p_sql = conexao::getInstance()->prepare('SELECT * FROM est_categorias WHERE cid = :cid');
			$p_sql->execute(array(
						":cid" => $id
					));

			$row = $p_sql->fetch(PDO::FETCH_ASSOC);

			return json_encode(
				array(
					"error" => 0,
					"data" => $row
				)
			);
		}

		public function addCategoria($nome) {

			global $app;

			$p_sql = conexao::getInstance()->prepare('INSERT INTO est_categorias (`nome`) VALUES (:nome)');
			$p_sql->execute(array(
					":nome" => $nome
				));

			if($p_sql->rowCount() > 0) {
				return json_encode(array(
							"error" => 0
						));
			}

			else {

				return $app["Responses"][5];
			}
		}

		public function updateCategoria($id, $nome) {

			global $app;

			$p_sql = conexao::getInstance()->prepare('UPDATE est_categorias SET `nome`=:nome WHERE cid=:cid');
			$p_sql->execute(
				array(
					":nome" => $nome,
					":cid" => $id
				)
			);

			if($p_sql->rowCount() > 0) {

				return json_encode(
					array(
						"error" => 0
					)
				);
			}

			else {

				return $app["Responses"][1];
			}
		}

		public function deleteCategoria($id) {

			global $app;

			$p_sql = conexao::getInstance()->prepare('DELETE FROM est_categorias WHERE cid = :cid');
			$p_sql->execute(
				array(
					":cid" => $id
				)
			);

			if($p_sql->rowCount() > 0) {

				return json_encode(
					array(
						"error" => 0
					)
				);
			} 

			else {

				return $app["Responses"][1];
			}
		}
	}