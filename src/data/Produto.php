<?php
include "autoload.php";

use Connection as conexao;	

class Produto{
	private $pid;
	private $categoria;
	private $nome;
	private $estoqueMinimo;
	private $estoqueAtual;
	
	function __construct(){

	}

	public function getProdutos(){
		$p_sql = conexao::getInstance()->prepare('SELECT p.*, c.nome as categoria_name FROM est_produtos as p LEFT JOIN est_categorias as c ON cid = categoria');
		$p_sql->execute();

		$rows = $p_sql->fetchAll(PDO::FETCH_ASSOC);

		if($p_sql->rowCount()){
			echo json_encode(
				array(
					"success" => 1,
					"data" => $rows
				)
			);
		}
	}

	public function getProdutoData($id){
		$p_sql = conexao::getInstance()->prepare('SELECT p.*, c.nome as categoria_name FROM est_produtos as p LEFT JOIN est_categorias as c ON cid = categoria WHERE pid = :pid');
		$p_sql->execute(
			array(
				":pid" => $id
			)
		);

		$row = $p_sql->fetch(PDO::FETCH_ASSOC);

		
		echo json_encode(
			array(
				"success" => 1,
				"data" => $row
			)
		);
	}

	public function getProdutosBy($field, $value){
		$p_sql = conexao::getInstance()->prepare('SELECT p.*, c.nome as categoria_name FROM est_produtos as p LEFT JOIN est_categorias as c ON cid = categoria WHERE `'. $field .'` = :value');
		$p_sql->execute(
			array(
				":value" => $value
			)
		);

		$rows = $p_sql->fetchAll(PDO::FETCH_ASSOC);

		
		echo json_encode(
			array(
				"success" => 1,
				"data" => $rows
			)
		);
	}

	public function addProduto($nome, $cat, $estoqueMinimo, $estoqueAtual){
		$p_sql = conexao::getInstance()->prepare('INSERT INTO est_produtos (`nome`, `categoria`, `estoque_minimo`, `estoque_atual`) VALUES (:nome, :cat, :estoqueMinimo, :estoqueAtual)');
		$p_sql->execute(
			array(
				":nome" => $nome,
				":cat" => $cat,
				":estoqueMinimo" => $estoqueMinimo,
				":estoqueAtual" => $estoqueAtual
			)
		);

		echo json_encode(
			array(
				"success" => 1
			)
		);
	}

	public function updateProduto($id, $nome, $cat, $estoqueMinimo, $estoqueAtual){
		$p_sql = conexao::getInstance()->prepare('UPDATE est_produtos SET `nome`=:nome, `categoria`=:cat, `estoque_minimo`=:estoqueMinimo, `estoque_atual`=:estoqueAtual WHERE pid=:pid');
		$p_sql->execute(
			array(
				":nome" => $nome,
				":cat" => $cat,
				":estoqueMinimo" => $estoqueMinimo,
				":estoqueAtual" => $estoqueAtual,
				":pid" => $id
			)
		);

		echo json_encode(
			array(
				"success" => 1
			)
		);
	}

	public function deleteProduto($id){
		$p_sql = conexao::getInstance()->prepare('DELETE FROM est_produtos WHERE pid = :pid');
		$p_sql->execute(
			array(
				":pid" => $id
			)
		);

		echo json_encode(
			array(
				"success" => 1
			)
		);
	}

}

$prod = new Produto();
$prod->getProdutos();
//$prod->getProdutosBy('categoria', 2);
//$prod->getProdutoData(5);
//$prod->addProduto("Produto 7", 1, 50, 20);
//$prod->deleteProduto(7);
//$prod->updateProduto(6, "Produto 6", 1, 50, 20);