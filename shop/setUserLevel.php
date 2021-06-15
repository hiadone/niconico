<?php
include_once('./_common.php');


//$lastDuration_s = date("Y-m", strtotime('2 months ago')) ."-01 00:00:00";
$lastDuration_s = date("Y-m-d", strtotime('2 months ago')) ." 00:00:00";
$lastDuration_e = date("Y-m-d", strtotime('1 day ago')) ." 23:59:59";

//$sql = " SELECT * FROM {$g5['member_table']} WHERE mb_level IN (1, 3, 5, 7) AND mb_leave_date = '' ";
$sql = " SELECT * FROM {$g5['member_table']} WHERE mb_level < 10 AND mb_leave_date = '' ";
$result = sql_query($sql);
for ($i=0; $row=sql_fetch_array($result); $i++) {
	$sum_payPrice = 0;
	
	$sql2 = " SELECT * FROM {$g5['g5_shop_order_table']} WHERE od_status = '완료' AND od_time >= '". $lastDuration_s ."' AND od_time <= '". $lastDuration_e ."' AND mb_id = '". $row['mb_id'] ."' ";
	$result2 = sql_query($sql2);
	for ($j=0; $row2=sql_fetch_array($result2); $j++) {
		$realPrice = $row2['od_receipt_price']  - $row2['od_send_cost'] - $row2['od_send_cost2'];
		$sum_payPrice += $realPrice;
	}

	$toLevel = 1;
	if ($sum_payPrice < 500000) {
		$toLevel = 1;
	} elseif ($sum_payPrice >= 500000 && $sum_payPrice < 800000) {
		$toLevel = 3;
	} elseif ($sum_payPrice >= 800000 && $sum_payPrice < 1000000) {
		$toLevel = 5;
	} elseif ($sum_payPrice >= 1000000) {
		$toLevel = 7;
	}

	
	$sql3 = " UPDATE {$g5['member_table']} SET mb_level = ". $toLevel ." WHERE mb_id = '". $row['mb_id'] ."'";
	//$result3 = sql_query($sql3);
	
	if ($sum_payPrice > 300000) {
		echo $i . " : ". $row['mb_id'] ." => ". number_format($sum_payPrice) ." / ". $toLevel ."\n";
	}
}

?>