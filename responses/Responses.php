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
			])
	];