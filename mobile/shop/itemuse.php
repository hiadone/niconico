<?php
include_once('./_common.php');
include_once(G5_LIB_PATH.'/thumbnail.lib.php');

$itemuse_list = G5_SHOP_URL."/itemuselist.php";
$itemuse_form = G5_SHOP_URL."/itemuseform.php?it_id=".$it_id;
$itemuse_formupdate = G5_SHOP_URL."/itemuseformupdate.php?it_id=".$it_id;
$orderOption = isset($_POST['orderOption']) ? $_POST['orderOption'] : 'photo';

 $sql_common = " from `{$g5['g5_shop_item_use_table']}` where it_id = '{$it_id}' and is_confirm = '1' AND is_status = 1 ";

// 테이블의 전체 레코드수만 얻음
$sql = " select COUNT(*) as cnt " . $sql_common;
$row = sql_fetch($sql);
$total_count = $row['cnt'];

$rows = 5;
$total_page  = ceil($total_count / $rows); // 전체 페이지 계산
if ($page < 1) $page = 1; // 페이지가 없으면 첫 페이지 (1 페이지)
$from_record = ($page - 1) * $rows; // 시작 레코드 구함

if ($orderOption == 'scoreHigh') {
	$orderBy = " is_score DESC ";
} elseif ($orderOption == 'scoreLow') {
	$orderBy = " is_score ASC ";
} else {
	$orderBy = " is_type DESC, is_id DESC ";
}

$star_score = get_star_image($it_id);

$sql = "select * $sql_common order by ". $orderBy ."  limit $from_record, $rows ";
$result = sql_query($sql);

$itemuse_skin = G5_MSHOP_SKIN_PATH.'/itemuse.skin.php';

if(!file_exists($itemuse_skin)) {
    echo str_replace(G5_PATH.'/', '', $itemuse_skin).' 스킨 파일이 존재하지 않습니다.';
} else {
    include_once($itemuse_skin);
}
?>