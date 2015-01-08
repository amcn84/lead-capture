<?php
	// access URL and request method
	$url    = 'https://api.idxbroker.com/leads/lead';
	$method = 'GET';

	// headers (required and optional)
	$headers = array(
		'Content-Type: application/x-www-form-urlencoded', // required
		'accesskey: abcdefghijklmnopqrstuvwxyz', // required - replace with your own
		'outputtype: json' // optional - overrides the preferences in our API control page
	);

	// set up cURL
	$handle = curl_init();
	curl_setopt($handle, CURLOPT_HEADER, true);
	curl_setopt($handle, CURLOPT_URL, $url);
	curl_setopt($handle, CURLOPT_HTTPHEADER, $headers);
	curl_setopt($handle, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($handle, CURLOPT_SSL_VERIFYHOST, false);
	curl_setopt($handle, CURLOPT_SSL_VERIFYPEER, false);

	if ($method != 'GET')
		curl_setopt($handle, CURLOPT_CUSTOMREQUEST, $method);

	// exec the cURL request and returned information. Store the returned HTTP code in $code for later reference
	$response = curl_exec($handle);
	$code     = curl_getinfo($handle, CURLINFO_HTTP_CODE);
	$info     = curl_getinfo($handle);
	$headers  = header_response($response);
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
	$b_response    = (explode('[', $response));
	$leads_info    = $b_response[1];
	$leads_explode = (explode('},', $leads_info));
	$return        = array();
	$i             = 0;
	foreach ($leads_explode as $leads) {
		$result[$i] = $leads . "}";
		$i++;
	}
	$count          = count($result) - 1;
	$trim           = $result[$count];
	$trim           = rtrim($trim, '}');
	$trim           = rtrim($trim, ']');
	$result[$count] = $trim;
	$solved         = array();
	$z              = 0;
	foreach ($result as $solution) {
		$solved[$z] = json_decode($solution, true);
		$z++;
	}
	var_dump($headers);
	var_dump($code);
	var_dump($solved);
	$csvheaders = array(
		'id',
		'firstName',
		'lastName',
		'email',
		'agentOwner',
		'disabled',
		'canLogin',
		'receiveUpdates'
	);
	$stream     = fopen('leads.csv' . "", 'w+');
	fputcsv($stream, $csvheaders);
	foreach ($solved as $val) {
		fputcsv($stream, $val);
	}
	fclose($stream);
	$calls = $headers['Hourly-Access-Key-Usage'];
	$counter = fopen('count.txt'."",'w+');
	fwrite($counter, $calls);
	fclose($counter);
?>