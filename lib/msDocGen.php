#!/usr/bin/php
<?php

$filenameIn = __DIR__ . '/../doc/examples/input.php';
$filenameOut = __DIR__ . '/../doc/examples/output.php';

$output = parseFile($filenameIn);

file_put_contents($filenameOut, $output);

function parseFile($filenameIn987654321){
	$output987654321 = '';
	$file987654321 = file($filenameIn987654321);

	foreach($file987654321 as $line987654321){
		if(substr($line987654321, 0, 3) == '///'){
			continue;
		}
		ob_start();
		$evalLine987654321 = str_replace(array('<?php'), null, $line987654321);
		eval($evalLine987654321);
		$result987654321 = trim(ob_get_clean());
		$output987654321 .= sprintf($result987654321 ? "%s\n///%s\n" : "%s\n", trim($line987654321), str_replace(array("\r\n", "\n\r", "\n", "\r"), "\n///", $result987654321));
	}
}
