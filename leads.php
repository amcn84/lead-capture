<?php
// access URL and request method
$url = 'https://api.idxbroker.com/leads/lead';
$method = 'GET';

// headers (required and optional)
$headers = array(
    'Content-Type: application/x-www-form-urlencoded', // required
    'accesskey: s2b6RybZTLY9JKFMFP2kEw', // required - replace with your own
    'outputtype: json' // optional - overrides the preferences in our API control page
);
$handle  = curl_init();
curl_setopt($handle, CURLOPT_URL, $url);
curl_setopt($handle, CURLOPT_HEADER, 1);
curl_setopt($handle, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($handle, CURLOPT_SSL_VERIFYHOST, false);
curl_setopt($handle, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($handle, CURLOPT_HTTPHEADER, $headers);
if ($method != 'GET')
    curl_setopt($handle, CURLOPT_CUSTOMREQUEST, $method);
$response = curl_exec($handle);
$code = curl_getinfo($handle, CURLINFO_HTTP_CODE);
$info = curl_getinfo($handle);
$headers = header_response($response);
function header_response($response)
{
    $headers     = array();
    $header_text = substr($response, 0, strpos($response, "\r\n\r\n"));
    foreach (explode("\r\n", $header_text) as $i => $line)
        if ($i === 0)
            $headers['http_code'] = $line;
        else {
            list($key, $value) = explode(': ', $line);
            $headers[$key] = $value;
        }
    return $headers;
}
/*
if ($code >= 200 || $code < 300) {
	$response = json_decode($response,true);
} else {
	$error = $code;
}*/
var_dump($headers);
var_dump($code);
var_dump($response); // string?
?>