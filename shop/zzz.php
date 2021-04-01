<?php
include_once('./_common.php');


$content = '[니코니코몰]

박지윤님, 주문하신 상품이 배송 시작되었습니다 (야옹)(야옹)(야옹)

□주문번호 : 2021011417123211
□수취인명 : 박지윤
□배송업체 : CJ대한통운
□송장번호 : 381547546582

▷[니코니코몰] 고객센터 : 
070-4283-6537
';

//$content = iconv("utf-8", "euc-kr", $content);

$query = "INSERT INTO BIZ_MSG (MSG_TYPE, CMID, REQUEST_TIME, SEND_TIME, DEST_PHONE, SEND_PHONE,
MSG_BODY, TEMPLATE_CODE, SENDER_KEY, NATION_CODE, ATTACHED_FILE)
VALUES (6, '". date("YmdHis", time()) ."', NOW(), NOW(), '01035972794', '07042836537',
'". $content ."', 'ship_start_4', 'ca4ce95f12699f2ad036fa494e8a2afea58a6e95', '82', 'button4.json')";

echo $query;
sql_query($query);


?>