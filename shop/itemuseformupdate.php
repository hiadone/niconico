<?php
include_once('./_common.php');

if (!$is_member) {
    alert_close("사용후기는 회원만 작성이 가능합니다.");
}

$it_id       = trim($_REQUEST['it_id']);
$od_id       = trim($_REQUEST['od_id']);
$is_subject  = trim($_POST['is_subject']);
$is_content  = trim($_POST['is_content']);
$is_content = preg_replace('#<script(.*?)>(.*?)</script>#is', '', $is_content);
$is_name     = trim($_POST['is_name']);
$is_password = trim($_POST['is_password']);
$is_score    = (int)$_POST['is_score'] > 5 ? 0 : (int)$_POST['is_score'];
$get_editor_img_mode = $config['cf_editor'] ? false : true;
$is_id       = (int) trim($_REQUEST['is_id']);

// 사용후기 작성 설정에 따른 체크
check_itemuse_write($it_id, $member['mb_id']);

if ($w == "" || $w == "u") {
    $is_name     = addslashes(strip_tags($member['mb_name']));
    $is_password = $member['mb_password'];

    if (!$is_subject) alert("제목을 입력하여 주십시오.");
    if (!$is_content) alert("내용을 입력하여 주십시오.");
}

if ($default['de_item_use_use']) {
	$is_confirm = 0;
} else {
	$is_confirm = 1;
}

/* 자동노출불가 단어 입력한 경우 체크 */
$filterArr = explode(',', $default['de_filterUselist']);
foreach($filterArr as $ft) {
	if (preg_match("/[\,]?{$ft}/i", $is_content)) {
		$is_confirm = 0;
	}
	if (preg_match("/[\,]?{$ft}/i", $is_subject)) {
		$is_confirm = 0;
	}
}


$isType = 'text';
$bonusPoint = 200;
$pointName = '리뷰 포인트';

/* 포토리뷰인지 텍스트리뷰인지 확인 */
if ($is_mobile_shop) {
	if ($_FILES['reviewImage']['name']) {
		$dataDir = G5_DATA_PATH.'/file/review';

		$file_name = $_FILES['reviewImage']['name'];
		$file_name_array = explode(".", $file_name);
		$s_point = count($file_name_array) - 1;
		$upload_check = $file_name_array[$s_point];
		$filetype = strtolower($upload_check);

		$uploadFileName = date("YmdHis", time()) ."_". rand(0, 9999);
		
		move_uploaded_file($_FILES['reviewImage']['tmp_name'], $dataDir ."/". $uploadFileName .".". $filetype);

		$fileTag = "<p><img src=\"/data/file/review/". $uploadFileName .".". $filetype ."\"></p>";
		$is_content = $fileTag . $is_content;

		$isType = 'photo';
		$bonusPoint = 500;
		$pointName = '포토 리뷰 포인트';
	}
} else {
	preg_match_all("/<img[^>]*src=[\"']?([^>\"']+)[\"']?[^>]*>/i", $is_content, $matches);
	
	if (count($matches[0]) > 0) {
		$isType = 'photo';
		$bonusPoint = 500;
		$pointName = '포토 리뷰 포인트';
	}
}




if($is_mobile_shop)
    $url = './iteminfo.php?it_id='.$it_id.'&info=use';
else
    $url = shop_item_url($it_id, "_=".get_token()."#sit_use");

if ($w == "")
{
    /*
    $sql = " select max(is_id) as max_is_id from {$g5['g5_shop_item_use_table']} ";
    $row = sql_fetch($sql);
    $max_is_id = $row['max_is_id'];

    $sql = " select max(is_id) as max_is_id from {$g5['g5_shop_item_use_table']} where it_id = '$it_id' and mb_id = '{$member['mb_id']}' ";
    $row = sql_fetch($sql);
    if ($row['max_is_id'] && $row['max_is_id'] == $max_is_id)
        alert("같은 상품에 대하여 계속해서 평가하실 수 없습니다.");
    */

    $sql = "insert {$g5['g5_shop_item_use_table']}
               set it_id = '$it_id',
                   mb_id = '{$member['mb_id']}',
                   is_score = '$is_score',
                   is_name = '$is_name',
                   is_password = '$is_password',
                   is_subject = '$is_subject',
                   is_content = '$is_content',
                   is_time = '".G5_TIME_YMDHIS."',
                   is_ip = '{$_SERVER['REMOTE_ADDR']}',
				   is_type = '{$isType}',
				   is_confirm = '$is_confirm',
				   od_id = '". $od_id ."'";

    sql_query($sql);

    //if ($default['de_item_use_use']) {
	if ($is_confirm == 0) {
        $alert_msg = "평가하신 글은 금지 단어가 포함되어 있어 관리자가 확인한 후에 출력됩니다.";
    }  else {
        $alert_msg = "사용후기가 등록 되었습니다.";
		/* 포인트 지급 */
		insert_point($member['mb_id'], $bonusPoint, $pointName, '@itemuse', $od_id ."_". $it_id, '리뷰 포인트 적립');
    }

}
else if ($w == "u")
{
    $sql = " select is_password from {$g5['g5_shop_item_use_table']} where is_id = '$is_id' ";

    $row = sql_fetch($sql);
    if ($row['is_password'] != $is_password)
        alert("비밀번호가 틀리므로 수정하실 수 없습니다.");

    $sql = " update {$g5['g5_shop_item_use_table']}
                set is_subject = '$is_subject',
                    is_content = '$is_content',
                    is_score = '$is_score',
					is_type = '{$isType}',
					is_confirm = '$is_confirm' 
              where is_id = '$is_id' ";

    sql_query($sql);

	/* 이미 포인트가 지급된 경우 제거해준다 */
	delete_point($member['mb_id'], '@itemuse', $od_id ."_". $it_id, '리뷰 포인트 적립');

	if ($is_confirm == 0) {
        $alert_msg = "평가하신 글은 금지 단어가 포함되어 있어 관리자가 확인한 후에 출력됩니다.";
    }  else {
	
		$alert_msg = "사용후기가 수정 되었습니다.";

		/* 포인트 지급 */
		insert_point($member['mb_id'], $bonusPoint, $pointName, '@itemuse', $od_id ."_". $it_id, '리뷰 포인트 적립');
	}

}
else if ($w == "d" || $w == "dp")
{
    if (!$is_admin)
    {
        $sql = " select count(*) as cnt from {$g5['g5_shop_item_use_table']} where mb_id = '{$member['mb_id']}' and is_id = '$is_id' ";
        $row = sql_fetch($sql);
        if (!$row['cnt'])
            alert("자신의 사용후기만 삭제하실 수 있습니다.");
    }

    // 에디터로 첨부된 이미지 삭제
    $sql = " select is_content from {$g5['g5_shop_item_use_table']} where is_id = '$is_id' and md5(concat(is_id,is_time,is_ip)) = '{$hash}' ";
    $row = sql_fetch($sql);

    $imgs = get_editor_image($row['is_content'], $get_editor_img_mode);

    for($i=0;$i<count($imgs[1]);$i++) {
        $p = parse_url($imgs[1][$i]);
        if(strpos($p['path'], "/data/") != 0)
            $data_path = preg_replace("/^\/.*\/data/", "/data", $p['path']);
        else
            $data_path = $p['path'];


        if( preg_match('/(gif|jpe?g|bmp|png)$/i', strtolower(end(explode('.', $data_path))) ) ){

            $destfile = ( ! preg_match('/\w+\/\.\.\//', $data_path) ) ? G5_PATH.$data_path : '';

            if($destfile && preg_match('/\/data\/editor\/[A-Za-z0-9_]{1,20}\//', $destfile) && is_file($destfile))
                @unlink($destfile);
        }
    }

    
	$sql = " delete from {$g5['g5_shop_item_use_table']} where is_id = '$is_id' and md5(concat(is_id,is_time,is_ip)) = '{$hash}' ";
	
	//$sql = " update {$g5['g5_shop_item_use_table']} set is_status = 9 where is_id = '$is_id' and md5(concat(is_id,is_time,is_ip)) = '{$hash}' ";
    sql_query($sql);

    $alert_msg = "사용후기를 삭제 하였습니다.";

	/* 이미 포인트가 지급된 경우 제거해준다 */
	delete_point($member['mb_id'], '@itemuse', $od_id ."_". $it_id, '리뷰 포인트 적립');
}

//쇼핑몰 설정에서 사용후기가 즉시 출력일 경우
if( ! $default['de_item_use_use'] ){
    update_use_cnt($it_id);
    update_use_avg($it_id);
}

if($w == 'd') {
    alert($alert_msg, $url);
} elseif ($w == 'dp') {
	//alert_close($alert_msg);
	$url = '/shop/orderItemList.php?od_id='. $od_id;
	alert($alert_msg, $url);
} else {
    alert_opener($alert_msg, $url);
}
?>