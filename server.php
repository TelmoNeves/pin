<?php

	$cookies = json_decode($_POST["cookies"]);
	$csrftoken = "";

	foreach ($cookies as $cookie) {
		if($cookie[0] == "csrftoken"){
			$csrftoken = $cookie[1];
		}
	}

	if(isset($_POST["username"])){
		//$ch = curl_init("https://www.pinterest.co.uk/resource/UserResource/get/?source_url=%2F".$username."%2F&data=%7B%22options%22%3A%7B%22username%22%3A%22".$username."%22%2C%22field_set_key%22%3A%22profile%22%2C%22no_fetch_context_on_resource%22%3Afalse%7D%2C%22context%22%3A%7B%7D%7D&_=".time().rand(100,999));
    	$ch = curl_init("https://www.pinterest.co.uk/resource/ShareSuggestionsTypeaheadResource/get/?source_url=%2Flawohel%2Ffree-ebooks%2F&data=%7B%22options%22%3A%7B%22suggestion_type%22%3A%22group_board%22%2C%22count%22%3A25%2C%22term%22%3A%22".$_POST["username"]."%22%2C%22pin_scope%22%3A%22pins%22%2C%22no_fetch_context_on_resource%22%3Afalse%7D%2C%22context%22%3A%7B%7D%7D&_=".(time()-5).rand(100,999));
	    curl_setopt ($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
	    curl_setopt ($ch, CURLOPT_TIMEOUT, 15);
	    curl_setopt ($ch, CURLOPT_FOLLOWLOCATION, 1);
	    curl_setopt ($ch, CURLOPT_RETURNTRANSFER, true);
	    curl_setopt ($ch, CURLOPT_ENCODING , 'identity');
	    /*if(file_exists($cookie_file)){
	    	curl_setopt($ch, CURLOPT_COOKIEFILE, $cookie_file);
	    }
		curl_setopt($ch, CURLOPT_COOKIEJAR, $cookie_file);*/
	    $headers = array(
			'sec-ch-ua: " Not A;Brand";v="99", "Chromium";v="99", "Google Chrome";v="99"',
			'x-pinterest-appstate: active',
			'x-app-version: '.$_POST["app_version"],
			'x-pinterest-pws-handler: www/[username]/[slug].js',
			'sec-ch-ua-mobile: ?0',
			'user-agent: Mozilla/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/99.0.4844.84 Safari/537.36',
			'accept: application/json, text/javascript, */*, q=0.01',
			'x-requested-with: XMLHttpRequest',
			//'x-pinterest-source-url: /'.$username.'/',
			'x-pinterest-source-url: /lawohel/free-ebooks/',
			'x-csrftoken: '.$csrftoken,
			'sec-ch-ua-platform: "Windows"',
			'sec-fetch-site: same-origin',
			'sec-fetch-mode: cors',
			'sec-fetch-dest: empty',
			'referer: https://www.pinterest.co.uk/',
			//'x-pinterest-experimenthash: 57839580a57c8ceb652cbc7355b3df12692a9c7be9db29a57d962348268ed09cfd23f8159f3e3a4ecad6e46c9ccee59925d5101f6fadfc21ab7fc6f657556565',
			'accept-encoding: gzip, deflate, br',
			'accept-language: en-US,en;q=0.9'
	    );
	    
    	$cookie_string = "";
	    foreach ($cookies as $cookie) {
			$cookie_string .= $cookie[0]."=".$cookie[1]."; ";
		}
		array_push($headers, "Cookie: ".$cookie_string);
		
	    curl_setopt ($ch, CURLOPT_HTTPHEADER, $headers);

	    $response_text = curl_exec($ch);

	    curl_close ($ch);

	    echo $response_text;
	}else{
		$ch = curl_init("https://www.pinterest.co.uk/resource/BoardInviteResource/create/");
	    curl_setopt ($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
	    curl_setopt ($ch, CURLOPT_TIMEOUT, 15);
	    curl_setopt ($ch, CURLOPT_FOLLOWLOCATION, 1);
	    curl_setopt ($ch, CURLOPT_RETURNTRANSFER, true);
	    curl_setopt ($ch, CURLOPT_ENCODING , 'identity');
	    /*if(file_exists($cookie_file)){
	    	curl_setopt($ch, CURLOPT_COOKIEFILE, $cookie_file);
	    }
		curl_setopt($ch, CURLOPT_COOKIEJAR, $cookie_file);*/
	    $headers = array(
			'sec-ch-ua: " Not A;Brand";v="99", "Chromium";v="99", "Google Chrome";v="99"',
			'x-pinterest-appstate: active',
			'x-app-version: '.$_POST["app_version"],
			'x-pinterest-pws-handler: www/[username]/[slug].js',
			'sec-ch-ua-mobile: ?0',
			'user-agent: Mozilla/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/99.0.4844.84 Safari/537.36',
			'accept: application/json, text/javascript, */*, q=0.01',
			'x-requested-with: XMLHttpRequest',
			'x-pinterest-source-url: /lawohel/free-ebooks/',
			'x-csrftoken: '.$csrftoken,
			'sec-ch-ua-platform: "Windows"',
			'origin: https://www.pinterest.co.uk',
			'sec-fetch-site: same-origin',
			'sec-fetch-mode: cors',
			'sec-fetch-dest: empty',
			'referer: https://www.pinterest.co.uk/',
			'accept-encoding: gzip, deflate, br',
			'accept-language: en-US,en;q=0.9'
	    );
	    
	    
    	$cookie_string = "";
	    foreach ($cookies as $cookie) {
			$cookie_string .= $cookie[0]."=".$cookie[1]."; ";
		}
		array_push($headers, "Cookie: ".$cookie_string);
		
	    curl_setopt ($ch, CURLOPT_HTTPHEADER, $headers);
	    curl_setopt ($ch, CURLOPT_POSTFIELDS, http_build_query(array(
	    	'source_url' => '/lawohel/free-ebooks/',
	    	'data' => '{"options":{"board_id":"1090011984751165304","invited_user_ids":["'.$_POST["user_id"].'"],"no_fetch_context_on_resource":false},"context":{}}'
	    )));

	    $response_text = curl_exec($ch);

	    curl_close ($ch);

	    echo $response_text;
	}

?>
