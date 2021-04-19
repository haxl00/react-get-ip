<?php
	$h = "";
	function getIp(&$headers) {
		$headers = "";
		foreach($_SERVER as $header=>$val) {
			if (strtoupper(substr($header, 0, 4)) == "HTTP") {
				$headers .= ", ".$header.":".$val;
			}
		}
		
		$headers = substr($headers, 1);
		if (array_key_exists('HTTP_CF_CONNECTING_IP', $_SERVER)) {
			return $_SERVER['HTTP_CF_CONNECTING_IP'];	//Cloud flare (https://www.cloudflare.com/ips-v4)
		}
		if (array_key_exists('HTTP_X_FORWARDED_FOR', $_SERVER)) {
			$ff = explode(",",$_SERVER['HTTP_X_FORWARDED_FOR']);
			return $ff[0];	//Http proxy or load balancer:  real IP address, proxy 1, proxy 2, ...
		}
		if (array_key_exists('HTTP_X_REAL_IP', $_SERVER)) {
			return $_SERVER['HTTP_X_REAL_IP'];	//Some load balancer
		}
		if (array_key_exists('HTTP_X_CLIENT_IP', $_SERVER)) {
			return $_SERVER['HTTP_X_CLIENT_IP'];
		}
		if (array_key_exists('HTTP_FORWARDED_FOR', $_SERVER)) {
			return $_SERVER['HTTP_FORWARDED_FOR'];
		}
		if (array_key_exists('HTTP_CLIENT_IP', $_SERVER)) {
			return $_SERVER['HTTP_CLIENT_IP'];
		}
		return $_SERVER['REMOTE_ADDR'];        
    }
	header('Content-Type: application/json');
	$results["IPv4"] = getIp($h);
	$results["headers"] = $h;
	echo json_encode($results);
?>