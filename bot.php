<?php
$access_token = 'dF9FzccBxm3nZ8x4EEvyuccuNsOcA9Y9j2rglwhxrnsk7rFnM1ZySJ4cmK10YJ9Ziumj2l13xncHwW8g7ea/6z8BarkehtJHKMDWmHKrKkyHMwWxqscJhUJ3WQHX7N+fG6C3KFl5S13x9lOOCNNSswdB04t89/1O/w1cDnyilFU=';

// Get POST body content
$content = file_get_contents('php://input');
// Parse JSON
$events = json_decode($content, true);
// Validate parsed JSON data
if (!is_null($events['events'])) {
	// Loop through each event
	foreach ($events['events'] as $event) {
		// Reply only when message sent is in 'text' format
		if ($event['type'] == 'message' && $event['message']['type'] == 'text') {

			              // Get text sent
			$text = $event['message']['text'];
			// Get replyToken
			$replyToken = $event['replyToken'];

			// Build message to reply back
			//$messages = ['type' => 'text','text' => ''];

  if($event['message']['text'] == 'สวัสดี'){
  $messages = ['type' => 'text','text' => 'สวัสดี'];
}else if($event['message']['text']== 'ชื่ออะไร'){

    $messages = ['type' => 'text','text' => 'ฉันยังไม่มีชื่อนะ'];
}else if($event['message']['text'] == 'ทำอะไรได้บ้าง'){
   $messages = ['type' => 'text','text' => 'ฉันทำอะไรไม่ได้เลย คุณต้องสอนฉันอีกเยอะ']; 
}else{$messages = ['type' => 'text','text' => 'ฉันไม่เข้าใจ'];  }
    
			// Make a POST Request to Messaging API to reply to sender
			$url = 'https://api.line.me/v2/bot/message/reply';
			$data = [
				'replyToken' => $replyToken,
				'messages' => [$messages],
			];
			$post = json_encode($data);
			$headers = array('Content-Type: application/json', 'Authorization: Bearer ' . $access_token);

			$ch = curl_init($url);
			curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
			curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
			curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
			curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
			$result = curl_exec($ch);
			curl_close($ch);

			echo $result . "\r\n";
		}
	}
}
echo "OK";
