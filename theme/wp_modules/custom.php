<?php
date_default_timezone_set('US/Central');
// define('API_ENDPOINT', ''); // optional api endpoint uri (to be used in 'do_curl_get()')

function do_curl($options) {
	$endpoint = isset($options['endpoint']) ? $options['endpoint'] : null;
	if ( $endpoint == null ) return array();

	$username_password = isset($options['username_password']) ? $options['username_password'] : null;
	$action = isset($options['action']) ? $options['action'] : 'POST';
	$data = isset($options['data']) ? $options['data'] : '';
	$headers = isset($options['headers']) ? $options['headers'] : array('Content-Type: application/json', 'Accept: application/json');

	$ch = curl_init();

	curl_setopt($ch, CURLOPT_URL, $endpoint);
	if ( $username_password !== null ) {
		curl_setopt($ch, CURLOPT_USERPWD, $username_password);
	}
	curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($ch, CURLOPT_TIMEOUT, 10);
	curl_setopt($ch, CURLOPT_CUSTOMREQUEST, $action);
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);

	if ( is_array($data) || strlen($data) > 0 ) {
		curl_setopt($ch, CURLOPT_POST, true);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
	}

	$result = curl_exec($ch);
	if ( !is_array($result) ) {
		$result = json_decode($result, true);
	}

	$httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
	curl_close($ch);

	return array(
		'result' => $result,
		'httpcode' => $httpCode
	);
}

function get_data_from_cache($cache_file) {
	if ( file_exists($cache_file) ) {
		$fh = fopen($cache_file, 'r');
		// if fopen fails
		if ( $fh === false ) {
			fclose($fh);
			return array(
				'result' => array(),
				'httpcode' => -101,
				'message' => "Cached data retrieval failed",
				'error' => "Could not open cached file $cache_file",
			);
		}

		$firstline = fgets($fh);
		// if fgets fails
		if ( $firstline === false ) {
			fclose($fh);
			return array(
				'result' => array(),
				'httpcode' => -102,
				'message' => "Cached data retrieval failed",
				'error' => "Could not read first line of cached file $cache_file"
			);
		}

		$cacheTime = trim($firstline);

		// if data was cached recently, return cached data
		if ($cacheTime > strtotime('-160 minutes')) {
			$response = fread($fh, filesize($cache_file));
			// if fread fails
			if ( $response === false ) {
				fclose($fh);
				return array(
					'result' => array(),
					'httpcode' => -103,
					'message' => "Cached data retrieval failed",
					'error' => "Could not read cached file $cache_file"
				);
			}

			// if cached file is opened and read successfully
			$data = json_decode($response, true);

			$ret = array(
				'result' => $data,
				'httpcode' => 200,
				'message' => "Cached data retrieval successful",
				'error' => null
			);

			fclose($fh);
			return $ret;
		}

		// else delete cache file
		// fclose($fh);
		unlink($cache_file);
	}

	return array(
		'result' => array(),
		'httpcode' => -104,
		'message' => 'No cache file exists',
		'error' => 'Could not find cache or cache does not exist'
	);
}

// add Read More functionality to ACF
// https://support.advancedcustomfields.com/forums/topic/read-more-in-acf-text-or-wysiwyg-field/

function readmore($fullText){
	if(@strpos($fullText, '<!--more-->')){
		$morePos  = strpos($fullText, '<!--more-->');
		$fullText = preg_replace('/<!--(.|\s)*?-->/', '', $fullText);
		print substr($fullText,0,$morePos);
		print "<div class=\"expandable-content read-more\">";
		print "<div class=\"expandable-content-trigger\">Read More</div>";
		print "<div class=\"expandable-content-container\">";
		print "<div>". substr($fullText,$morePos,-1) . "</div>";
		print "<div class=\"expandable-content-trigger\">Show Less</div>";
		print "</div>";
		print "</div>";
	} else {
		print $fullText;
	}
}

function slugify($string){
        return strtolower(trim(preg_replace('/[^A-Za-z0-9-]+/', '-', $string), '-'));
    }

?>
