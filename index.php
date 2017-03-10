<?php

function reply_str($text, $replyToken) {
	$access_token = 'JvXW9ZR3h2C1gw0iS00s4T7tgphrcfqnye6wAln1Yh/RWEsE+2G6VQt+DKvhQtRW+lp/c8r+QHSeOxHZSAbOMvLKGog0msjNu4pzlTS4ILjeZDT3hN7ZZcWQ0zTHl/Sq7gUNzr08Vg+0r+GxtUOgggdB04t89/1O/w1cDnyilFU=';		//Token
	$messages = [
		'type' => 'text',
		'text' => $text
	];
	$data = [
		'replyToken' => $replyToken,
		'messages' => [$messages],
	];

	$post = json_encode($data);	

	$url = "https://api.line.me/v2/bot/message/reply";
	$header = array('http' => 
					Array (	'header' =>
								"Content-Type: application/json\r\n" .
								"Authorization: Bearer " . $access_token . "\r\n" .
								"Content-Length: " . strlen($post),
							'content' => $post,
							'method' => 'POST',
							'follow_location' => 1,
							'timeout' => 10
						)
					);
	 
	$result = @file_get_contents($url, false, stream_context_create($header));
}

$content = file_get_contents('php://input');
$events = json_decode($content, true);

if (!is_null($events['events'])) {
	foreach ($events['events'] as $event) {
		if ($event['type'] == 'message' && $event['message']['type'] == 'text') {			
			$recv_str = strtolower(preg_replace('/[\s]+/', '', $event['message']['text']));
			$text = "[[Auto Reply]]\n";			
			else if(strpos($recv_str, "myid") !== false) {
				$text .= "------------------------------------\n";
				$text .= "Your ID: " . $event['source']['userId'];
			}
			else {
				$text .= "นอกเงื่อนไข คำสั่ง";
			}

			reply_str($text, $event['replyToken']);
		}
	}
}

?>
