<?php
include "autoload.php";

use Connection as conexao;	

class Categoria{
	public $cid;
	public $nome;
	

	function __construct(){
		$this->db = conexao::getInstance();
		$p_sql = conexao::getInstance()->prepare('SELECT * FROM est_categorias');
		print_r($p_sql);
	}

}

$cat = new Categoria();