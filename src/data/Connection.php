<?php

	final class Connection
	{
		
		public static $instance;

		public static function getInstance()
		{
			if(!isset(self::$instance))
			{

				self::$instance = new PDO(
					'mysql:host=localhost;dbname=cacp_gestor', 'root', '923885',
					array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8")
				);

				self::$instance->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	            self::$instance->setAttribute(PDO::ATTR_ORACLE_NULLS, PDO::NULL_EMPTY_STRING);
			}

			return self::$instance;
		}
	}