<?php
include "../autoload.php";

use Connection;	

class Categorias{
	public $cid;
	public $nome;
	

	function __construct(){
		$this->db = Conexao::getInstance();
		$p_sql = Conexao::getInstance()->prepare('SELECT * FROM est_categorias');
		print_r($p_sql);
	}

}