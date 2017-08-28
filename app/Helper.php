<?php

function isWisata($name)
{
	return ($name == "Budaya" || $name=="Alam" || $name == "Sejarah") ?  true :  false;
}

function apiArrayResponseBuilder($statusCode = null, $message = null, $data = [])
{
	$arr = [
		'status_code' => (isset($statusCode)) ? $statusCode : 500,
		'message' => (isset($message)) ? $message : 'error'
	];
	if (count($data) > 0) {
		$arr['data'] = $data;
	}
	return $arr;
}