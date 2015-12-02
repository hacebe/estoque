<?php

	$app["Responses"] = [
		0 => json_encode([
				"error" => true,
				"message" => "Unknown API route",
				"status" => "REQUEST_DENIED"
			]),

		1 => json_encode([
				"error" => 1,
				"message" => "Registro nao encontrado",
				"status" => "UNKNOWN_RECORD"
			]),

		2 => json_encode([
				"error" => "Registro nao encontrado",
				"status" => ""
			])
	];