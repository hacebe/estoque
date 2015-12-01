<?php
include "autoload.php";

use Connection as conexao;	

class Categoria{
	private $cid;
	private $nome;
	private $db;
	
	function __construct(){

	}

	public function getCategorias(){
		$p_sql = conexao::getInstance()->prepare('SELECT * FROM est_categorias');
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

	public function getCategoriaData($id){
		$p_sql = conexao::getInstance()->prepare('SELECT * FROM est_categorias WHERE cid = :cid');
		$p_sql->execute(
			array(
				":cid" => $id
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

	public function addCategoria($nome){
		$p_sql = conexao::getInstance()->prepare('INSERT INTO est_categorias (`nome`) VALUES (:nome)');
		$p_sql->execute(
			array(
				":nome" => $nome
			)
		);

		echo json_encode(
			array(
				"success" => 1
			)
		);
	}

	public function updateCategoria($id, $nome){
		$p_sql = conexao::getInstance()->prepare('UPDATE est_categorias SET `nome`=:nome WHERE cid=:cid');
		$p_sql->execute(
			array(
				":nome" => $nome,
				":cid" => $id
			)
		);

		echo json_encode(
			array(
				"success" => 1
			)
		);
	}

	public function deleteCategoria($id){
		$p_sql = conexao::getInstance()->prepare('DELETE FROM est_categorias WHERE cid = :cid');
		$p_sql->execute(
			array(
				":cid" => $id
			)
		);

		echo json_encode(
			array(
				"success" => 1
			)
		);
	}

}

$cat = new Categoria();
$cat->getCategorias();
//$cat->getCategoriaData(1);
//$cat->addCategoria("Categoria 7");
//$cat->deleteCategoria(3);
//$cat->updateCategoria(2, "Categoria 2");