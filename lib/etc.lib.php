<?php
if (!defined('_GNUBOARD_')) exit;

// 로그를 파일에 쓴다
function write_log($file, $log) {
    $fp = fopen($file, "a+");
    ob_start();
    print_r($log);
    $msg = ob_get_contents();
    ob_end_clean();
    fwrite($fp, $msg);
    fclose($fp);
}

function getTemplate($type) {
	$g5_path = g5_path();
	$file = $g5_path['path'] ."/skin/ppurioTemplate/". $type .".template";
	if (!is_file($file)) {
		return null;
	} else {
		$content = file_get_contents($file);
		return $content;
	}
}

function replaceStrPPurio($content) {
	$content = str_replace("#{shop_name}", "니코니코몰", $content);
	$content = str_replace("#{shortcut_link}", "https://bit.ly/2DrGNVG", $content);
	$content = str_replace("#{cs_phone}", "070-4283-6537", $content);
	return $content;
}

function sendPPurio($phoneNumber, $content, $type, $buttonType = 1) {
	if ($buttonType == 'none') {
		$query = "INSERT INTO BIZ_MSG (MSG_TYPE, CMID, REQUEST_TIME, SEND_TIME, DEST_PHONE, SEND_PHONE,
		MSG_BODY, TEMPLATE_CODE, SENDER_KEY, NATION_CODE, ATTACHED_FILE)
		VALUES (6, '". date("YmdHis", time()) ."', NOW(), NOW(), '". $phoneNumber ."', '07042836537',
		'". $content ."', '". $type ."', 'ca4ce95f12699f2ad036fa494e8a2afea58a6e95', '82', '')";
	} 
	// 채널추가만 있는 경우
	elseif ($buttonType == 2) {	
		$query = "INSERT INTO BIZ_MSG (MSG_TYPE, CMID, REQUEST_TIME, SEND_TIME, DEST_PHONE, SEND_PHONE,
		MSG_BODY, TEMPLATE_CODE, SENDER_KEY, NATION_CODE, ATTACHED_FILE)
		VALUES (6, '". date("YmdHis", time()) ."', NOW(), NOW(), '". $phoneNumber ."', '07042836537',
		'". $content ."', '". $type ."', 'ca4ce95f12699f2ad036fa494e8a2afea58a6e95', '82', 'button2.json')";
	} 
	// 채널추가와 쇼핑몰 바로가기가 있는 경우
	elseif ($buttonType == 3) {	
		$query = "INSERT INTO BIZ_MSG (MSG_TYPE, CMID, REQUEST_TIME, SEND_TIME, DEST_PHONE, SEND_PHONE,
		MSG_BODY, TEMPLATE_CODE, SENDER_KEY, NATION_CODE, ATTACHED_FILE)
		VALUES (6, '". date("YmdHis", time()) ."', NOW(), NOW(), '". $phoneNumber ."', '07042836537',
		'". $content ."', '". $type ."', 'ca4ce95f12699f2ad036fa494e8a2afea58a6e95', '82', 'button3.json')";
	} 
	// 채널추가와 배송조회 바로가기가 있는 경우
	elseif ($buttonType == 4) {	
		$query = "INSERT INTO BIZ_MSG (MSG_TYPE, CMID, REQUEST_TIME, SEND_TIME, DEST_PHONE, SEND_PHONE,
		MSG_BODY, TEMPLATE_CODE, SENDER_KEY, NATION_CODE, ATTACHED_FILE)
		VALUES (6, '". date("YmdHis", time()) ."', NOW(), NOW(), '". $phoneNumber ."', '07042836537',
		'". $content ."', '". $type ."', 'ca4ce95f12699f2ad036fa494e8a2afea58a6e95', '82', 'button4.json')";
	} 
	// 쇼핑몰 바로가기만 있는 경우
	elseif ($buttonType == 5) {	
		$query = "INSERT INTO BIZ_MSG (MSG_TYPE, CMID, REQUEST_TIME, SEND_TIME, DEST_PHONE, SEND_PHONE,
		MSG_BODY, TEMPLATE_CODE, SENDER_KEY, NATION_CODE, ATTACHED_FILE)
		VALUES (6, '". date("YmdHis", time()) ."', NOW(), NOW(), '". $phoneNumber ."', '07042836537',
		'". $content ."', '". $type ."', 'ca4ce95f12699f2ad036fa494e8a2afea58a6e95', '82', 'button5.json')";
	} 
	// 쇼핑몰 놀러가기만 있는 경우
	else { 
		$query = "INSERT INTO BIZ_MSG (MSG_TYPE, CMID, REQUEST_TIME, SEND_TIME, DEST_PHONE, SEND_PHONE,
		MSG_BODY, TEMPLATE_CODE, SENDER_KEY, NATION_CODE, ATTACHED_FILE)
		VALUES (6, '". date("YmdHis", time()) ."', NOW(), NOW(), '". $phoneNumber ."', '07042836537',
		'". $content ."', '". $type ."', 'ca4ce95f12699f2ad036fa494e8a2afea58a6e95', '82', 'button.json')";
	}
	//sql_query($query, true);
	sql_query($query);
}

function format_phone($phone){
    $phone = preg_replace("/[^0-9]/", "", $phone);
    $length = strlen($phone);

    switch($length){
      case 11 :
          return preg_replace("/([0-9]{3})([0-9]{4})([0-9]{4})/", "$1-$2-$3", $phone);
          break;
      case 10:
          return preg_replace("/([0-9]{3})([0-9]{3})([0-9]{4})/", "$1-$2-$3", $phone);
          break;
      default :
          return $phone;
          break;
    }
}
?>