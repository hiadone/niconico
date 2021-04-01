<?php
$sub_menu = '400650';
include_once('./_common.php');

check_demo();

if ($w == 'd')
    auth_check($auth[$sub_menu], "d");
else
    auth_check($auth[$sub_menu], "w");

check_admin_token();

if ($w == "u")
{
    $sql = "update {$g5['g5_shop_item_use_table']}
               set is_subject = '$is_subject',
                   is_content = '$is_content',
                   is_confirm = '$is_confirm',
                   is_reply_subject = '$is_reply_subject',
                   is_reply_content = '$is_reply_content',
                   is_reply_name = '".$member['mb_nick']."'
             where is_id = '$is_id' ";
    sql_query($sql);

	$use = sql_fetch(" select * from {$g5['g5_shop_item_use_table']} where is_id = '$is_id' ");
	$it_id	= $use['it_id'];
	$od_id	= $use['od_id'];
	if ($use['is_type'] == 'photo') {
		$bonusPoint = 500;
		$pointName = '포토 리뷰 포인트';
	} else {
		$bonusPoint = 200;
		$pointName = '리뷰 포인트';
	}

	/* 이미 포인트가 지급된 경우 제거해준다 */
	delete_point($use['mb_id'], '@itemuse', $od_id ."_". $it_id, '리뷰 포인트 적립');

	/* 포인트 지급 */
	insert_point($use['mb_id'], $bonusPoint, $pointName, '@itemuse', $od_id ."_". $it_id, '리뷰 포인트 적립');

    update_use_cnt($_POST['it_id']);
    update_use_avg($_POST['it_id']);

    goto_url("./itemuseform.php?w=$w&amp;is_id=$is_id&amp;sca=$sca&amp;$qstr");
}
else
{
    alert();
}
?>
