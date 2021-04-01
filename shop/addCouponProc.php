<?php
include_once('./_common.php');


$couponNumber = isset($_POST['couponNumber']) ? strtoupper($_POST['couponNumber']) : null;

if (!$couponNumber) {
	$returnMsg = [
		'code'	=> 9,
		'msg'	=> "쿠폰번호가 없습니다."
	];

	echo json_encode($returnMsg);
	exit;
}

/* 존재하는 쿠폰인지 체크 */
$query = " SELECT * FROM {$g5['g5_shop_coupon_table']} WHERE cp_method = 10 AND cp_id = '". $couponNumber ."' ";
$couponInfo = sql_fetch($query);

if (!$couponInfo || count($couponInfo) == 0) {
	$returnMsg = [
		'code'	=> 8,
		'msg'	=> "없는 쿠폰번호입니다.\n다시 확인하여 주세요."
	];

	echo json_encode($returnMsg);
	exit;
}

/* 사용 가능한 날짜인지 체크 */
if (str_replace("-", "", $couponInfo['cp_start']) <= date("Ymd", time()) && str_replace("-", "", $couponInfo['cp_end']) >= date("Ymd", time())) {
	/* 이미 등록했는지 체크 */
	$query = " SELECT count(*) as cnt FROM g5_shop_coupon_log WHERE cp_id = '". $couponNumber ."' AND mb_id = '". $member['mb_id'] ."' ";
	$useInfo = sql_fetch($query);
	if ($useInfo['cnt'] > 0) {
		$returnMsg = [
			'code'	=> 6,
			'msg'	=> "이미 등록한 쿠폰입니다.\n다시 확인하여 주세요."
		];

		echo json_encode($returnMsg);
		exit;
	}

} else {
	$returnMsg = [
		'code'	=> 7,
		'msg'	=> "사용 가능한 기간이 아닙니다.\n해당 쿠폰은 ". $couponInfo['cp_start'] ." ~ ". $couponInfo['cp_end'] ." 까지 등록하실 수 있습니다."
	];

	echo json_encode($returnMsg);
	exit;
}

/*
$query = " UPDATE g5_member SET mb_point = mb_point + ". $couponInfo['cp_price'] ." WHERE mb_id = '". $member['mb_id'] ."' ";
sql_query($query);
*/

insert_point($member['mb_id'], $couponInfo['cp_price'], '쿠폰 등록 ('. $couponNumber .')');

$query = " INSERT INTO g5_shop_coupon_log (cp_id, mb_id, cp_price, cl_datetime) VALUES ('". $couponNumber ."', '". $member['mb_id'] ."', '". $couponInfo['cp_price'] ."', now()) ";
sql_query($query);

$returnMsg = [
	'code'	=> 1,
	'msg'	=> "등록 완료되었습니다."
];

echo json_encode($returnMsg);
exit;

?>