<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
       <?php
 
$strAccessToken = "dF9FzccBxm3nZ8x4EEvyuccuNsOcA9Y9j2rglwhxrnsk7rFnM1ZySJ4cmK10YJ9Ziumj2l13xncHwW8g7ea/6z8BarkehtJHKMDWmHKrKkyHMwWxqscJhUJ3WQHX7N+fG6C3KFl5S13x9lOOCNNSswdB04t89/1O/w1cDnyilFU=";
 
$content = file_get_contents('php://input');
$arrJson = json_decode($content, true);
	    	 
if (!is_null($arrJson['events'])) {
	
$strUrl = "https://api.line.me/v2/bot/message/reply";
 
$arrHeader = array();
$arrHeader[] = "Content-Type: application/json";
$arrHeader[] = "Authorization: Bearer {$strAccessToken}";
 
if(similar_text($arrJson['events'][0]['message']['text'],"สวัสดี",$percent) >50 ){
  $arrPostData = array();
  $arrPostData['replyToken'] = $arrJson['events'][0]['replyToken'];
  $arrPostData['messages'][0]['type'] = "text";
 // $arrPostData['messages'][0]['text'] = "สวัสดี ID คุณคือ ".$arrJson['events'][0]['source']['userId'];
	$arrPostData['messages'][0]['text'] = "สวัสดี คุณชื่ออะไรเหรอ ?";
	echo $percent; 
}
// else if(similar_text($arrJson['events'][0]['message']['text'],"ชื่ออะไร",$percent)>50){
//   $arrPostData = array();
//   $arrPostData['replyToken'] = $arrJson['events'][0]['replyToken'];
//   $arrPostData['messages'][0]['type'] = "text";
//   $arrPostData['messages'][0]['text'] = "สงกรานต์ไงไม่รู้จักเหรอ Thevoice Umm ยินที่ได้รู้จักนะ";
// }else if(similar_text($arrJson['events'][0]['message']['text'],"ทำอะไรได้บ้าง",$percent)>50){
//   $arrPostData = array();
//   $arrPostData['replyToken'] = $arrJson['events'][0]['replyToken'];
//   $arrPostData['messages'][0]['type'] = "text";
//   $arrPostData['messages'][0]['text'] = "ฉันทำอะไรไม่ได้เลย คุณต้องสอนฉันอีกเยอะ";
// }else if(similar_text($arrJson['events'][0]['message']['text'],"ดี" ,$percent)>50){
//   $arrPostData = array();
//   $arrPostData['replyToken'] = $arrJson['events'][0]['replyToken'];
//   $arrPostData['messages'][0]['type'] = "text";
//   $arrPostData['messages'][0]['text'] = "จะดีไม่ดีจะบอกทำไมเนี่ย !!!!";
// }

// else{
//   $arrPostData = array();
//   $arrPostData['replyToken'] = $arrJson['events'][0]['replyToken'];
//   $arrPostData['messages'][0]['type'] = "text";
//   $arrPostData['messages'][0]['text'] = "ไม่เข้าใจเทอพูดอะไรเหรอ";
//  $arrPostData['messages'][1]['type'] = "text";
//   $arrPostData['messages'][1]['text'] = "ฉันเหนื่อยนะที่ต้องตอบคำถามคุณ";
// }
 
 
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL,$strUrl);
curl_setopt($ch, CURLOPT_HEADER, false);
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, $arrHeader);
curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($arrPostData));
curl_setopt($ch, CURLOPT_RETURNTRANSFER,true);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
$result = curl_exec($ch);
curl_close ($ch);
}
echo "OK"; 
?>
    </body>
</html>
