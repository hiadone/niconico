<?php
include_once('/home/niconicomall/www/common.php');
include_once(G5_LIB_PATH.'/etc.lib.php');

$searchDate = date("Y-m-d", strtotime("3 days ago"));
//$searchDate = '2020-12-02';

echo $searchDate ."\n";

$query = " SELECT * FROM {$g5['g5_shop_order_table']} WHERE od_status = '주문' AND od_settle_case = '가상계좌' AND od_misu > 0 AND LEFT(od_time, 10) = '". $searchDate ."' ";
$result = sql_query($query);

for ($i=0; $row=sql_fetch_array($result); $i++)
{
	echo $row['od_id'] ." / ". $row['od_name'] ." / ". $row['od_cart_price'] ." / ". $row['od_misu'] ." / ". $row['od_receipt_price'] ." / ". $row['od_time'] ."\n";

	$od_hp = $row['od_hp'];
	$od_id = $row['od_id'];
	//$od_hp = '01035972794';
	$od_bankaccount = $row['od_bank_account'];
	$od_misu = $row['od_misu'];
	$od_name = $row['od_name'];


	$content = getTemplate('order_bankaccount_2');
	$content = replaceStrPPurio($content);

	$content = str_replace("#{order_name}", $od_name, $content);
	$content = str_replace("#{orderNo}", $od_id, $content);
	$content = str_replace("#{settlePrice}", number_format($od_misu), $content);
	$content = str_replace("#{bankaccount}", $od_bankaccount, $content);

	//echo $content ."\n";

	sendPPurio(str_replace("-", "", $od_hp), $content, 'order_bankaccount_2', 2);

	sleep(2);
}
?>