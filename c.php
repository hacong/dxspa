<?php

function get_curl($url, $attr = array())
{
	$curl = curl_init();
	$a = array(
		'useheader' => false,
		'useragent' => 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_10_5) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/45.0.2454.85 Safari/537.36',
		'referer' => '',
		'autoreferer' => false,
		'usehttpheader' => true,
		'ucookie' => '',
		'encoding' => '',
		'timeout' => 20,
		'host' => cut($url, '://', '/', 0, 0),
		'follow' => true,
		'mpost' => false,
		'mpostfield' => '',
	);
	foreach ($a AS $key => $default) {
		if (isset($attr[$key])) $$key = $attr[$key];
		else $$key = $default;
	}
	$header[0] = "Accept: text/html,application/xhtml+xml,application/xml;q=0.9,*/*;q=0.8";
	$header[] = "Accept-Language: en-us,en;q=0.5";
	$header[] = "Accept-Encoding: gzip,deflate";
	$header[] = "Accept-Language: en-US";
	$header[] = "Accept-Charset: ISO-8859-1,utf-8;q=0.7,*;q=0.7";
	$header[] = "Keep-Alive: 200";
	$header[] = "Pragma: no-cache";
	$header[] = "Connection: keep-alive";

	if ($host) $header[] = "Host: $host";


	curl_setopt($curl, CURLOPT_URL, $url);
	curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, 0);

	if ($useheader) {
		curl_setopt($curl, CURLOPT_HEADER, 1);
	}
	if ($useragent != "") {
		curl_setopt($curl, CURLOPT_USERAGENT, $useragent);
	}
	if ($usehttpheader) {
		curl_setopt($curl, CURLOPT_HTTPHEADER, $header);
	}
	if ($ucookie != "") {
		curl_setopt($curl, CURLOPT_COOKIE, $ucookie);
	}
	if ($referer != "") {
		curl_setopt($curl, CURLOPT_REFERER, $referer);
	}
	if ($mpost) {
		curl_setopt($curl, CURLOPT_POST, 1);
	}
	if ($mpostfield != "") {
		curl_setopt($curl, CURLOPT_POSTFIELDS, $mpostfield);
	}
	if ($autoreferer) {
		curl_setopt($curl, CURLOPT_AUTOREFERER, 1);
	}

	curl_setopt($curl, CURLOPT_ENCODING, $encoding);

	if ($timeout != "") {
		curl_setopt($curl, CURLOPT_TIMEOUT, $timeout);
	}
	if ($follow) {
		curl_setopt($curl, CURLOPT_FOLLOWLOCATION, 1);
	}

	$result = curl_exec($curl);
	return $result;
}

function cut($bandau, $batdau, $ketthuc, $laydau = 1, $laycuoi = 1)
{
	$ban = ' ' . $bandau;
	if (!$batdau || !$ketthuc) return '';
	$a = strpos($ban, $batdau);
	if ($a == 0) return '';
	$b = strpos($ban, $ketthuc, $a + strlen($batdau));
	if ($b == 0) return '';
	if ($laydau <> 1) $a = $a + strlen($batdau);
	if ($laycuoi == 1) $b = $b + strlen($ketthuc);
	return substr($ban, $a, $b - $a);
}

$url = $_POST['u'];
echo get_curl($url);
