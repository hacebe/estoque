<?php

	$app["Responses"] = [
		0 => json_encode([
				"error" => 1,
				"message" => "Rota nao encontrada",
				"status" => "REQUEST_DENIED"
			]),

		1 => json_encode([
				"error" => 1,
				"message" => "Registro nao encontrado",
				"status" => "UNKNOWN_RECORD"
			]),

		2 => json_encode([
				"error" => 1,
				"message" => "Senha incorreta",
				"status" => "PASSWORD_MATCH_FAILURE"
			]),

		3 => json_encode([
				"error" => 1,
				"message" => "Usuario inexistente",
				"status" => "UNKNOWN_USER"
			]),

		4 => json_encode([
				"error" => 1,
				"message" => "Nenhuma categoria cadastrada",
				"status" => "MISSING_ROWS"
			]),

		5 => json_encode([
				"error" => 1,
				"message" => "Não foi possivel cadastrar esta categoria",
				"status" => "INSERT_FAILURE"
			]),

		6 => json_encode([
				"error" => 1,
				"message" => "Requisicao nao autenticada",
				"status" => "AUTH_FAILURE"
			]),

		7 => json_encode([
				"error" => 1,
				"message" => "Nao foi possivel incluir este produto",
				"status" => "INSERT_FAILURE"
			])
	];