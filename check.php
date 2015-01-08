<?php
	$fp = fopen('count.txt','r');
	$calls = fread($fp, 1024);
	fclose($fp);
	$timestamp = time();
	$gt = fopen('timer.txt','r');
	$timer = fread($gt, 1024);
	if($timestamp >= $timer) {
		include('get_leads.php');
		$tf = fopen('timer.txt','w+');
		$timeout = 0;
		fwrite($tf,$timeout);
		fclose($tf);
	} else {
		echo "Too many calls";
	}
	if($calls >= 50) {
		$tf = fopen('timer.txt','w+');
		$timeout = time()+60*60;
		fwrite($tf,$timeout);
		fclose($tf);
	}
?>