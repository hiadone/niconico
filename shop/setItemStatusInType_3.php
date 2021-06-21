<?php
include_once('/home/devniconicomall/www/common.php');
include_once(G5_PATH.'/adm/shop_admin/admin.shop.lib.php');
include_once(G5_LIB_PATH.'/etc.lib.php');



$sql = " update {$g5['g5_shop_item_table']} set it_type3 = 0 ";

sql_query($sql);

$fr_date = date('Ymd', strtotime('-1 month', G5_SERVER_TIME));
$to_date = date('Ymd', strtotime('-1 week', G5_SERVER_TIME));


if ($sort1 == "") $sort1 = "ct_status_sum";
if (!in_array($sort1, array('ct_status_1', 'ct_status_2', 'ct_status_3', 'ct_status_4', 'ct_status_5', 'ct_status_6', 'ct_status_7', 'ct_status_8', 'ct_status_9', 'ct_status_sum'))) $sort1 = "ct_status_sum";
if ($sort2 == "" || $sort2 != "asc") $sort2 = "desc";

// if ($sort1 == "") $sort1 = "ct_status_sum";
// if (!in_array($sort1, array('ct_status_1', 'ct_status_2', 'ct_status_3', 'ct_status_4', 'ct_status_5', 'ct_status_6', 'ct_status_7', 'ct_status_8', 'ct_status_9', 'ct_status_sum'))) $sort1 = "ct_status_sum";
// if ($sort2 == "" || $sort2 != "asc") $sort2 = "desc";

$sql  = " select a.it_id,
                 SUM(IF(ct_status = '쇼핑',ct_qty, 0)) as ct_status_1,
                 SUM(IF(ct_status = '주문',ct_qty, 0)) as ct_status_2,
                 SUM(IF(ct_status = '입금',ct_qty, 0)) as ct_status_3,
                 SUM(IF(ct_status = '준비',ct_qty, 0)) as ct_status_4,
                 SUM(IF(ct_status = '배송',ct_qty, 0)) as ct_status_5,
                 SUM(IF(ct_status = '완료',ct_qty, 0)) as ct_status_6,
                 SUM(IF(ct_status = '취소',ct_qty, 0)) as ct_status_7,
                 SUM(IF(ct_status = '반품',ct_qty, 0)) as ct_status_8,
                 SUM(IF(ct_status = '품절',ct_qty, 0)) as ct_status_9,
                 SUM(ct_qty) as ct_status_sum
            from {$g5['g5_shop_cart_table']} a, {$g5['g5_shop_item_table']} b ";
$sql .= " where a.it_id = b.it_id ";
if ($fr_date && $to_date)
{
    $fr = preg_replace("/([0-9]{4})([0-9]{2})([0-9]{2})/", "\\1-\\2-\\3", $fr_date);
    $to = preg_replace("/([0-9]{4})([0-9]{2})([0-9]{2})/", "\\1-\\2-\\3", $to_date);
    $sql .= " and ct_time between '$fr 00:00:00' and '$to 23:59:59' ";
}

$sql .= " group by a.it_id
          order by $sort1 $sort2 ";




$sql_type3 = " update {$g5['g5_shop_item_table']} set it_type3 = 1 where it_id in ( select C.it_id from (".$sql.") as C where ct_status_sum > 10 ) ";

sql_query($sql_type3);




$sql = " update {$g5['g5_shop_item_table']} set it_type2 = 0 ";

sql_query($sql);

$fr_date = date('Ymd', strtotime('-1 month', G5_SERVER_TIME));
$to_date = date('Ymd', strtotime('-1 week', G5_SERVER_TIME));




// if ($sort1 == "") $sort1 = "ct_status_sum";
// if (!in_array($sort1, array('ct_status_1', 'ct_status_2', 'ct_status_3', 'ct_status_4', 'ct_status_5', 'ct_status_6', 'ct_status_7', 'ct_status_8', 'ct_status_9', 'ct_status_sum'))) $sort1 = "ct_status_sum";
// if ($sort2 == "" || $sort2 != "asc") $sort2 = "desc";

$sql  = " select it_id
            from {$g5['g5_shop_item_table']} ";
$sql .= " where it_use = '1' AND it_isOnlyAdmin = 0 ";
if ($fr_date && $to_date)
{
    $fr = preg_replace("/([0-9]{4})([0-9]{2})([0-9]{2})/", "\\1-\\2-\\3", $fr_date);
    $to = preg_replace("/([0-9]{4})([0-9]{2})([0-9]{2})/", "\\1-\\2-\\3", $to_date);
    $sql .= " and it_time between '$fr 00:00:00' and '$to 23:59:59' ";
}

$sort1 = $sort2 = "";
$sort1 = "it_time";
$sort2 = "desc";


$sql .= " group by it_id
          order by $sort1 $sort2 limit 50";

$sql_type2 = " update {$g5['g5_shop_item_table']} set it_type2 = 1 where it_id in ( select C.it_id from (".$sql.") as C  ) ";

sql_query($sql_type2);



$sql = " update {$g5['g5_shop_item_use_table']} set is_best = 0 ";

sql_query($sql);

$fr_date = date('Ymd', strtotime('-2 week', G5_SERVER_TIME));
$to_date = date('Ymd', strtotime('-1 day', G5_SERVER_TIME));




// if ($sort1 == "") $sort1 = "ct_status_sum";
// if (!in_array($sort1, array('ct_status_1', 'ct_status_2', 'ct_status_3', 'ct_status_4', 'ct_status_5', 'ct_status_6', 'ct_status_7', 'ct_status_8', 'ct_status_9', 'ct_status_sum'))) $sort1 = "ct_status_sum";
// if ($sort2 == "" || $sort2 != "asc") $sort2 = "desc";

$sql  = " select is_id
            from `{$g5['g5_shop_item_use_table']}` a left join `{$g5['g5_shop_item_table']}` b on (a.it_id=b.it_id)  ";
$sql .= " where is_confirm = '1' and is_status = '1' and it_use = '1'  and it_isOnlyAdmin IN (0, 2) ";
if ($fr_date && $to_date)
{
    $fr = preg_replace("/([0-9]{4})([0-9]{2})([0-9]{2})/", "\\1-\\2-\\3", $fr_date);
    $to = preg_replace("/([0-9]{4})([0-9]{2})([0-9]{2})/", "\\1-\\2-\\3", $to_date);
    $sql .= " and is_time between '$fr 00:00:00' and '$to 23:59:59' ";
}




$sql .= " group by is_id
          order by is_time desc ,is_type= 'photo' desc, is_score= '5' desc, CHARACTER_LENGTH(is_content) desc limit 0 , 10";

$sql_type2 = " update {$g5['g5_shop_item_use_table']} set is_best = 1 where is_id in ( select C.is_id from (".$sql.") as C  ) ";

sql_query($sql_type2);

?>


