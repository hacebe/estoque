<?php

	require_once "autoload.php";

	use Connection as conexao;

	class Produto {

		private $pid;
		private $categoria;
		private $nome;
		private $estoqueMinimo;
		private $estoqueAtual;
		
		function __construct(){

		}

		public function getProdutos() {

			
			
				$p_sql = conexao::getInstance()->prepare('SELECT p.*, c.nome as categoria_name FROM est_produtos as p LEFT JOIN est_categorias as c ON cid = categoria');
				$p_sql->execute();

				$rows = $p_sql->fetchAll(PDO::FETCH_ASSOC);

				if($p_sql->rowCount()) {

					return json_encode(
						array(
							"success" => 1,
							"data" => $rows
						)
					);
				}
			

		}

		public function getProdutoData($id) {

			$p_sql = conexao::getInstance()->prepare('SELECT p.*, c.nome as categoria_name FROM est_produtos as p LEFT JOIN est_categorias as c ON cid = categoria WHERE pid = :pid');
			$p_sql->execute(
				array(
					":pid" => $id
				)
			);

			$row = $p_sql->fetch(PDO::FETCH_ASSOC);
			
			return json_encode(
				array(
					"success" => 1,
					"data" => $row
				)
			);
		}

		public function getProdutosBy($field, $value) {

			$p_sql = conexao::getInstance()->prepare('SELECT p.*, c.nome as categoria_name FROM est_produtos as p LEFT JOIN est_categorias as c ON cid = categoria WHERE `'. $field .'` = :value');
			$p_sql->execute(
				array(
					":value" => $value
				)
			);

			$rows = $p_sql->fetchAll(PDO::FETCH_ASSOC);

			
			return json_encode(
				array(
					"success" => 1,
					"data" => $rows
				)
			);
		}

		public function addProduto($nome, $cat, $estoqueMinimo, $estoqueAtual) {

			global $app;

			$p_sql = conexao::getInstance()->prepare('INSERT INTO est_produtos (`nome`, `categoria`, `estoque_minimo`, `estoque_atual`) VALUES (:nome, :cat, :estoqueMinimo, :estoqueAtual)');
			$p_sql->execute(
				array(
					":nome" => $nome,
					":cat" => $cat,
					":estoqueMinimo" => $estoqueMinimo,
					":estoqueAtual" => $estoqueAtual
				)
			);

			if($p_sql->rowCount() > 0) {

				return json_encode(
					array(
						"success" => 1
					)
				);
			}

			else {

				return $app["Responses"][7];
			}
		}

		public function updateProduto($id, $nome, $cat, $estoqueMinimo) {

			global $app;

			$p_sql = conexao::getInstance()->prepare('UPDATE est_produtos SET `nome`=:nome, `categoria`=:cat, `estoque_minimo`=:estoqueMinimo WHERE pid=:pid');
			$p_sql->execute(
				array(
					":nome" => $nome,
					":cat" => $cat,
					":estoqueMinimo" => $estoqueMinimo,
					":pid" => $id
				)
			);

			if($p_sql->rowCount() > 0) {

				return json_encode(
					array(
						"success" => 1
					)
				);
			}

			else {

				return $app["Responses"][1];
			}
		}

		public function deleteProduto($id) {

			global $app;

			$p_sql = conexao::getInstance()->prepare('DELETE FROM est_produtos WHERE pid = :pid');
			$p_sql->execute(
				array(
					":pid" => $id
				)
			);

			if($p_sql->rowCount() > 0) {

				return json_encode(
					array(
						"success" => 1
					)
				);
			}

			else {

				return $app["Responses"][1];
			}
		}
	}