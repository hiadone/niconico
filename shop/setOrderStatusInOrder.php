<?php
include_once('/home/niconicomall/www/common.php');

$sql = " SELECT * FROM {$g5['g5_shop_default_table']} ";
$default = sql_fetch($sql);

if ($default['de_autoCompleteShipDay'] > 0) {
	$sql = " SELECT * FROM {$g5['g5_shop_order_table']} WHERE od_status = '배송' ";
	$result = sql_query($sql);
    for ($i=0; $row=sql_fetch_array($result); $i++) {
		if (date("YmdHi", strtotime($row['od_invoice_time'])) == date("YmdHi", time() - ($default['de_autoCompleteShipDay'] * 24 * 60 * 60))) {
			$uSql = " UPDATE {$g5['g5_shop_order_table']} SET od_status = '완료' WHERE od_id = '". $row['od_id'] ."' ";
			sql_query($uSql);
		}
	}
}



?>