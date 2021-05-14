<?php
include_once('/home/niconicomall/www/shop/_common.php');

$sql = " select
		b.it_id,
		b.ca_id,
		b.ca_id2,
		b.ca_id3,
		b.it_notax,
		b.it_weight,
		b.it_cust_price,
		b.it_useEvent,
		b.it_use,
		b.it_eventStartDate,
		b.it_eventEndDate
	   from {$g5['g5_shop_item_table']} b 
	  where b.it_useEvent = 1 ";
$result = sql_query($sql);


echo $sql ."\n\n";
echo "time : ". time() ."\n";


for ($i=0; $row=sql_fetch_array($result); $i++)
{
	echo $row['it_eventStartDate'] ."\n";
	if ($row['it_eventStartDate'] <= time()) {
		echo $row['it_id'] ." Start!\n";
		$upSql = " UPDATE {$g5['g5_shop_item_table']} SET it_use = 1 WHERE it_id = '". $row['it_id'] ."' ";
		sql_query($upSql);
	}
	if ($row['it_eventEndDate'] < time()) {
		echo $row['it_id'] ." End!\n";
		$upSql = " UPDATE {$g5['g5_shop_item_table']} SET it_use = 0 WHERE it_id = '". $row['it_id'] ."' ";
		sql_query($upSql);
	}
}
?>