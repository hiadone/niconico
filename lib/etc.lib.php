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

function ppurio_send($cmid,$phoneNumber,$content,$type,$button = array()) {
    $body = array("at" => array("senderkey"=>"ca4ce95f12699f2ad036fa494e8a2afea58a6e95","templatecode"=>$type,"message"=>$content,"button"=>$button));

    $data = array();
    $data["account"] = "niconicomall";
    $data["refkey"] = $cmid;
    $data["type"] = "at";
    $data["from"] = "07042836537";
    $data["to"] = $phoneNumber;
    $data["content"] = $body;    

    $json_data = json_encode($data, JSON_UNESCAPED_SLASHES);
    //$url = 'https://api.bizppurio.com/v2/message';
    $url = 'https://api.bizppurio.com/v2/message';
    $oCurl = curl_init();
    curl_setopt($oCurl,CURLOPT_URL,$url);
    curl_setopt($oCurl,CURLOPT_RETURNTRANSFER, true);
    curl_setopt($oCurl,CURLOPT_NOSIGNAL, 1);
    curl_setopt($oCurl, CURLOPT_SSL_VERIFYHOST, false);
    curl_setopt($oCurl, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($oCurl, CURLOPT_FOLLOWLOCATION, true);
    curl_setopt($oCurl, CURLOPT_HTTPHEADER,array('Accept: application/json', 'Content-Type: application/json'));
    curl_setopt($oCurl, CURLOPT_VERBOSE, true);
    curl_setopt($oCurl, CURLOPT_POSTFIELDS, $json_data);
    curl_setopt($oCurl, CURLOPT_TIMEOUT, 3);
    $response = curl_exec($oCurl);
    $curl_errno = curl_errno($oCurl);
    $curl_error = curl_error($oCurl);
    curl_close($oCurl);

    return json_decode($response);
    
}

function sendPPurio($phoneNumber, $content, $type, $buttonType = 1,$od_invoice = '') {

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

        $button = array(array("name"=>"채널추가","type"=>"AC"));
	} 
	// 채널추가와 쇼핑몰 바로가기가 있는 경우
	elseif ($buttonType == 3) {	
		$query = "INSERT INTO BIZ_MSG (MSG_TYPE, CMID, REQUEST_TIME, SEND_TIME, DEST_PHONE, SEND_PHONE,
		MSG_BODY, TEMPLATE_CODE, SENDER_KEY, NATION_CODE, ATTACHED_FILE)
		VALUES (6, '". date("YmdHis", time()) ."', NOW(), NOW(), '". $phoneNumber ."', '07042836537',
		'". $content ."', '". $type ."', 'ca4ce95f12699f2ad036fa494e8a2afea58a6e95', '82', 'button3.json')";

        $button = array(array("name"=>"채널추가","type"=>"AC"),array("name"=>"쇼핑몰 바로가기","type"=>"WL","url_mobile"=>"https://bit.ly/2SUtcdy","url_pc"=>"https://bit.ly/2SUtcdy"));
	} 
	// 채널추가와 배송조회 바로가기가 있는 경우
	elseif ($buttonType == 4) {	
        $cmid = date("YmdHis", time());
        
		$query = "INSERT INTO BIZ_MSG (MSG_TYPE, CMID, REQUEST_TIME, SEND_TIME, DEST_PHONE, SEND_PHONE,
		MSG_BODY, TEMPLATE_CODE, SENDER_KEY, NATION_CODE, ATTACHED_FILE)
		VALUES (6, '". $cmid ."', NOW(), NOW(), '". $phoneNumber ."', '07042836537',
		'". $content ."', '". $type ."', 'ca4ce95f12699f2ad036fa494e8a2afea58a6e95', '82', 'button4.json')";

        $button = array(array("name"=>"채널추가","type"=>"AC"),array("name"=>"배송조회","type"=>"WL","url_mobile"=>"https://www.shiptrack.co.kr/","url_pc"=>"https://www.shiptrack.co.kr/"));

	} 
	// 쇼핑몰 바로가기만 있는 경우
	elseif ($buttonType == 5) {	
		$query = "INSERT INTO BIZ_MSG (MSG_TYPE, CMID, REQUEST_TIME, SEND_TIME, DEST_PHONE, SEND_PHONE,
		MSG_BODY, TEMPLATE_CODE, SENDER_KEY, NATION_CODE, ATTACHED_FILE)
		VALUES (6, '". date("YmdHis", time()) ."', NOW(), NOW(), '". $phoneNumber ."', '07042836537',
		'". $content ."', '". $type ."', 'ca4ce95f12699f2ad036fa494e8a2afea58a6e95', '82', 'button5.json')";

        $button = array(array("name"=>"쇼핑몰 바로가기","type"=>"WL","url_mobile"=>"https://bit.ly/2SUtcdy","url_pc"=>"https://bit.ly/2SUtcdy"));
	} 
    // 사용후기와 배송조회 바로가기가 있는 경우
    elseif ($buttonType == 6) { 
        $cmid = date("YmdHis", time());
        
        $query = "INSERT INTO BIZ_MSG (MSG_TYPE, CMID, REQUEST_TIME, SEND_TIME, DEST_PHONE, SEND_PHONE,
        MSG_BODY, TEMPLATE_CODE, SENDER_KEY, NATION_CODE, ATTACHED_FILE)
        VALUES (6, '". $cmid ."', NOW(), NOW(), '". $phoneNumber ."', '07042836537',
        '". $content ."', '". $type ."', 'ca4ce95f12699f2ad036fa494e8a2afea58a6e95', '82', 'button4.json')";

        $button = array(array("name"=>"사용후기 쓰러가기","type"=>"WL","url_mobile"=>"https://bit.ly/3tW6pyy","url_pc"=>"https://bit.ly/3tW6pyy"),array("name"=>"배송조회","type"=>"WL","url_mobile"=>"https://track.shiptrack.co.kr/cjkorex/".$od_invoice."/","url_pc"=>"https://track.shiptrack.co.kr/cjkorex/".$od_invoice."/"));

    } 
	// 쇼핑몰 놀러가기만 있는 경우
	else { 
		$query = "INSERT INTO BIZ_MSG (MSG_TYPE, CMID, REQUEST_TIME, SEND_TIME, DEST_PHONE, SEND_PHONE,
		MSG_BODY, TEMPLATE_CODE, SENDER_KEY, NATION_CODE, ATTACHED_FILE)
		VALUES (6, '". date("YmdHis", time()) ."', NOW(), NOW(), '". $phoneNumber ."', '07042836537',
		'". $content ."', '". $type ."', 'ca4ce95f12699f2ad036fa494e8a2afea58a6e95', '82', 'button.json')";
        $button = array(array("name"=>"쇼핑몰 놀러가기","type"=>"WL","url_mobile"=>"https://bit.ly/2SUtcdy","url_pc"=>"https://bit.ly/2SUtcdy"));
	}
	//sql_query($query, true);
	sql_query($query);

    $res = ppurio_send($cmid,$phoneNumber,$content,$type,$button);

        
    $sql = " update BIZ_MSG
                set CALL_STATUS      = '".$res->code."'
                where CMID = '".$res->refkey."' ";
    
    sql_query($sql);
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