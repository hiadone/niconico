<?php
include_once('./_common.php');



if (!$is_member) {
    $result = array('error' => '사용후기는 회원만 작성이 가능합니다.');
    exit(json_encode($result));
}

$it_id       = isset($_REQUEST['it_id']) ? safe_replace_regex($_REQUEST['it_id'], 'it_id') : '';
$od_id       = trim($_REQUEST['od_id']);
$is_subject  = isset($_POST['is_subject']) ? trim($_POST['is_subject']) : '';
$is_content  = isset($_POST['is_content']) ? trim($_POST['is_content']) : '';
$is_content = preg_replace('#<script(.*?)>(.*?)</script>#is', '', $is_content);
$is_name     = isset($_POST['is_name']) ? trim($_POST['is_name']) : '';
$is_password = isset($_POST['is_password']) ? trim($_POST['is_password']) : '';
$is_score    = isset($_POST['is_score']) ? (int) $_POST['is_score'] : 0;
$is_score    = ($is_score > 5) ? 0 : $is_score;
$get_editor_img_mode = $config['cf_editor'] ? false : true;
$is_id       = isset($_REQUEST['is_id']) ? (int) $_REQUEST['is_id'] : 0;
$is_mobile_shop = isset($_REQUEST['is_mobile_shop']) ? (int) $_REQUEST['is_mobile_shop'] : 0;


// 사용후기 작성 설정에 따른 체크
if(check_itemuse_write($it_id, $member['mb_id'])){
    $result = array('error' => check_itemuse_write($it_id, $member['mb_id']));
    exit(json_encode($result));
}

if ($w == "" || $w == "u") {
    $is_name     = addslashes(strip_tags($member['mb_name']));
    $is_password = $member['mb_password'];

    if (!$is_subject) {
        $result = array('error' => '제목을 입력하여 주십시오.');
        exit(json_encode($result));
    }
    if (!$is_content) {
        $result = array('error' => '내용을 입력하여 주십시오.');
        exit(json_encode($result));
    }
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
// if ($is_mobile_shop) {
	if ($_POST['img_length']) {

		$isType = 'photo';
		$bonusPoint = 500;
		$pointName = '포토 리뷰 포인트';
	}
// } else {
// 	preg_match_all("/<img[^>]*src=[\"']?([^>\"']+)[\"']?[^>]*>/i", $is_content, $matches);
	
// 	if (count($matches[0]) > 0) {
// 		$isType = 'photo';
// 		$bonusPoint = 500;
// 		$pointName = '포토 리뷰 포인트';
// 	}
// }

// 파일개수 체크
// 
$bo_table = 'review';
$wr_id = $is_id;
$file_count   = 0;
$upload_max_filesize = ini_get('upload_max_filesize');
$upload_count = $_FILES['bf_file']['name'] ? count($_FILES['bf_file']['name']) : 0;

for ($i=0; $i<$upload_count; $i++) {
    if($_FILES['bf_file']['name'][$i] && is_uploaded_file($_FILES['bf_file']['tmp_name'][$i]))
        $file_count++;
}

if($w == 'u') {
    $file = get_file($bo_table, $wr_id);
    if($file_count && (int)$file['count'] > 10){        
        $result = array('error' => '기존 파일을 삭제하신 후 첨부파일을 '.number_format(10).'개 이하로 업로드 해주십시오.');
        exit(json_encode($result));
    }
} else {
    
    if($file_count > 10){
        $result = array('error' => '첨부파일을 '.number_format(10).'개 이하로 업로드 해주십시오.');
        exit(json_encode($result));
    }
}

// 디렉토리가 없다면 생성합니다. (퍼미션도 변경하구요.)
@mkdir(G5_DATA_PATH.'/file/'.$bo_table, G5_DIR_PERMISSION);
@chmod(G5_DATA_PATH.'/file/'.$bo_table, G5_DIR_PERMISSION);

$chars_array = array_merge(range(0,9), range('a','z'), range('A','Z'));

// 가변 파일 업로드
$file_upload_msg = '';
$upload = array();
for ($i=0; $i<$upload_count; $i++) {
    $upload[$i]['file']     = '';
    $upload[$i]['source']   = '';
    $upload[$i]['filesize'] = 0;
    $upload[$i]['image']    = array();
    $upload[$i]['image'][0] = '';
    $upload[$i]['image'][1] = '';
    $upload[$i]['image'][2] = '';
    $upload[$i]['fileurl'] = '';
    $upload[$i]['thumburl'] = '';
    $upload[$i]['storage'] = '';

    // 삭제에 체크가 되어있다면 파일을 삭제합니다.
    if (isset($_POST['bf_file_del'][$i]) && $_POST['bf_file_del'][$i]) {
        $upload[$i]['del_check'] = true;

        $row = sql_fetch(" select * from {$g5['board_file_table']} where bo_table = '{$bo_table}' and wr_id = '{$wr_id}' and bf_no = '{$i}' ");

        $delete_file = run_replace('delete_file_path', G5_DATA_PATH.'/file/'.$bo_table.'/'.str_replace('../', '', $row['bf_file']), $row);
        if( file_exists($delete_file) ){
            @unlink($delete_file);
        }
        // 썸네일삭제
        if(preg_match("/\.({$config['cf_image_extension']})$/i", $row['bf_file'])) {
            delete_board_thumbnail($bo_table, $row['bf_file']);
        }
    }
    else
        $upload[$i]['del_check'] = false;

    $tmp_file  = $_FILES['bf_file']['tmp_name'][$i];
    $filesize  = $_FILES['bf_file']['size'][$i];
    $filename  = $_FILES['bf_file']['name'][$i];
    $filename  = get_safe_filename($filename);

    // 서버에 설정된 값보다 큰파일을 업로드 한다면
    if ($filename) {
        if ($_FILES['bf_file']['error'][$i] == 1) {
            $file_upload_msg .= '\"'.$filename.'\" 파일의 용량이 서버에 설정('.$upload_max_filesize.')된 값보다 크므로 업로드 할 수 없습니다.\\n';
            continue;
        }
        else if ($_FILES['bf_file']['error'][$i] != 0) {
            $file_upload_msg .= '\"'.$filename.'\" 파일이 정상적으로 업로드 되지 않았습니다.\\n';
            continue;
        }
    }   

    if (is_uploaded_file($tmp_file)) {
        // 관리자가 아니면서 설정한 업로드 사이즈보다 크다면 건너뜀
        if (!$is_admin && $filesize > (1024 * 25)) {
            $file_upload_msg .= '\"'.$filename.'\" 파일의 용량('.number_format($filesize).' 바이트)이 게시판에 설정('.number_format(25).' MB) 값보다 크므로 업로드 하지 않습니다.\\n';
            continue;
        }

        //=================================================================\
        // 090714
        // 이미지나 플래시 파일에 악성코드를 심어 업로드 하는 경우를 방지
        // 에러메세지는 출력하지 않는다.
        //-----------------------------------------------------------------
        $timg = @getimagesize($tmp_file);
        // image type
        if ( preg_match("/\.({$config['cf_image_extension']})$/i", $filename) ||
             preg_match("/\.({$config['cf_flash_extension']})$/i", $filename) ) {
            if ($timg['2'] < 1 || $timg['2'] > 16)
                continue;
        }
        //=================================================================

        $upload[$i]['image'] = $timg;

        // 4.00.11 - 글답변에서 파일 업로드시 원글의 파일이 삭제되는 오류를 수정
        if ($w == 'u') {
            // 존재하는 파일이 있다면 삭제합니다.
            $row = sql_fetch(" select * from {$g5['board_file_table']} where bo_table = '$bo_table' and wr_id = '$wr_id' and bf_no = '$i' ");

            $delete_file = run_replace('delete_file_path', G5_DATA_PATH.'/file/'.$bo_table.'/'.str_replace('../', '', $row['bf_file']), $row);
            if( file_exists($delete_file) ){
                @unlink(G5_DATA_PATH.'/file/'.$bo_table.'/'.$row['bf_file']);
            }
            // 이미지파일이면 썸네일삭제
            if(preg_match("/\.({$config['cf_image_extension']})$/i", $row['bf_file'])) {
                delete_board_thumbnail($bo_table, $row['bf_file']);
            }
        }

        // 프로그램 원래 파일명
        $upload[$i]['source'] = $filename;
        $upload[$i]['filesize'] = $filesize;

        // 아래의 문자열이 들어간 파일은 -x 를 붙여서 웹경로를 알더라도 실행을 하지 못하도록 함
        $filename = preg_replace("/\.(php|pht|phtm|htm|cgi|pl|exe|jsp|asp|inc)/i", "$0-x", $filename);

        shuffle($chars_array);
        $shuffle = implode('', $chars_array);

        // 첨부파일 첨부시 첨부파일명에 공백이 포함되어 있으면 일부 PC에서 보이지 않거나 다운로드 되지 않는 현상이 있습니다. (길상여의 님 090925)
        $upload[$i]['file'] = abs(ip2long($_SERVER['REMOTE_ADDR'])).'_'.substr($shuffle,0,8).'_'.replace_filename($filename);

        $dest_file = G5_DATA_PATH.'/file/'.$bo_table.'/'.$upload[$i]['file'];

        // 업로드가 안된다면 에러메세지 출력하고 죽어버립니다.
        $error_code = move_uploaded_file($tmp_file, $dest_file) or die($_FILES['bf_file']['error'][$i]);

        // 올라간 파일의 퍼미션을 변경합니다.
        chmod($dest_file, G5_FILE_PERMISSION);

        $dest_file = run_replace('write_update_upload_file', $dest_file, array(), $wr_id, $w);
        $upload[$i] = run_replace('write_update_upload_array', $upload[$i], $dest_file, array(), $wr_id, $w);

        
    }
}


if($is_mobile_shop)
    $url = './iteminfo.php?it_id='.$it_id.'&info=use';
else
    $url = shop_item_url($it_id, "_=".get_token()."&tab_tit=sit_use");

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

    $is_id = sql_insert_id();
    $wr_id = $is_id;
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
    if ($row['is_password'] != $is_password){        
        $result = array('error' => '비밀번호가 틀리므로 수정하실 수 없습니다.');
        exit(json_encode($result));
    }

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
        if (!$row['cnt']){
            $result = array('error' => '자신의 사용후기만 삭제하실 수 있습니다.');
            exit(json_encode($result));
        }
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
	sql_query($sql);
    

    
    
    // 업로드된 파일이 있다면
    $sql2 = " select * from {$g5['board_file_table']} where bo_table = '$bo_table' and wr_id = '{$is_id}' ";
    $result2 = sql_query($sql2);
    while ($row2 = sql_fetch_array($result2)) {
        // 파일삭제
        $delete_file = run_replace('delete_file_path', G5_DATA_PATH.'/file/'.$bo_table.'/'.str_replace('../', '',$row2['bf_file']), $row2);
        if( file_exists($delete_file) ){
            @unlink($delete_file);
        }

        // 썸네일삭제
        if(preg_match("/\.({$config['cf_image_extension']})$/i", $row2['bf_file'])) {
            delete_board_thumbnail($bo_table, $row2['bf_file']);
        }
    }
    
    

    sql_query(" delete from {$g5['board_file_table']} where bo_table = '$bo_table' and wr_id = '{$is_id}' ");

    $alert_msg = "사용후기를 삭제 하였습니다.";

	/* 이미 포인트가 지급된 경우 제거해준다 */
	delete_point($member['mb_id'], '@itemuse', $od_id ."_". $it_id, '리뷰 포인트 적립');
}




// 나중에 테이블에 저장하는 이유는 $wr_id 값을 저장해야 하기 때문입니다.
for ($i=0; $i<count($upload); $i++)
{
    if (!get_magic_quotes_gpc()) {
        $upload[$i]['source'] = addslashes($upload[$i]['source']);
    }

    $row = sql_fetch(" select count(*) as cnt from {$g5['board_file_table']} where bo_table = '{$bo_table}' and wr_id = '{$wr_id}' and bf_no = '{$i}' ");
    if ($row['cnt'])
    {
        // 삭제에 체크가 있거나 파일이 있다면 업데이트를 합니다.
        // 그렇지 않다면 내용만 업데이트 합니다.
        if ($upload[$i]['del_check'] || $upload[$i]['file'])
        {
            $sql = " update {$g5['board_file_table']}
                        set bf_source = '{$upload[$i]['source']}',
                             bf_file = '{$upload[$i]['file']}',
                             bf_content = '{$bf_content[$i]}',
                             bf_fileurl = '{$upload[$i]['fileurl']}',
                             bf_thumburl = '{$upload[$i]['thumburl']}',
                             bf_storage = '{$upload[$i]['storage']}',
                             bf_filesize = '{$upload[$i]['filesize']}',
                             bf_width = '{$upload[$i]['image']['0']}',
                             bf_height = '{$upload[$i]['image']['1']}',
                             bf_type = '{$upload[$i]['image']['2']}',
                             bf_datetime = '".G5_TIME_YMDHIS."'
                      where bo_table = '{$bo_table}'
                                and wr_id = '{$wr_id}'
                                and bf_no = '{$i}' ";
            sql_query($sql);
        }
        else
        {
            $sql = " update {$g5['board_file_table']}
                        set bf_content = '{$bf_content[$i]}'
                        where bo_table = '{$bo_table}'
                                  and wr_id = '{$wr_id}'
                                  and bf_no = '{$i}' ";
            sql_query($sql);
        }
    }
    else
    {
        $sql = " insert into {$g5['board_file_table']}
                    set bo_table = '{$bo_table}',
                         wr_id = '{$wr_id}',
                         bf_no = '{$i}',
                         bf_source = '{$upload[$i]['source']}',
                         bf_file = '{$upload[$i]['file']}',
                         bf_content = '{$bf_content[$i]}',
                         bf_fileurl = '{$upload[$i]['fileurl']}',
                         bf_thumburl = '{$upload[$i]['thumburl']}',
                         bf_storage = '{$upload[$i]['storage']}',
                         bf_download = 0,
                         bf_filesize = '{$upload[$i]['filesize']}',
                         bf_width = '{$upload[$i]['image']['0']}',
                         bf_height = '{$upload[$i]['image']['1']}',
                         bf_type = '{$upload[$i]['image']['2']}',
                         bf_datetime = '".G5_TIME_YMDHIS."' ";
        sql_query($sql);

        run_event('write_update_file_insert', $bo_table, $wr_id, $upload[$i], $w);
    }
}

// 업로드된 파일 내용에서 가장 큰 번호를 얻어 거꾸로 확인해 가면서
// 파일 정보가 없다면 테이블의 내용을 삭제합니다.
$row = sql_fetch(" select max(bf_no) as max_bf_no from {$g5['board_file_table']} where bo_table = '{$bo_table}' and wr_id = '{$wr_id}' ");

for ($i=(int)$row['max_bf_no']; $i>=0; $i--)
{
    $row2 = sql_fetch(" select bf_file from {$g5['board_file_table']} where bo_table = '{$bo_table}' and wr_id = '{$wr_id}' and bf_no = '{$i}' ");
    
    // 정보가 있다면 빠집니다.
    if ($row2['bf_file']) continue;

    // 그렇지 않다면 정보를 삭제합니다.
    sql_query(" delete from {$g5['board_file_table']} where bo_table = '{$bo_table}' and wr_id = '{$wr_id}' and bf_no = '{$i}' ");
}


$sql = " select bf_no from {$g5['board_file_table']} where bo_table = '{$bo_table}' and wr_id = '{$wr_id}' order by   bf_no asc ";
$result = sql_query($sql);
for($i=0; $row=sql_fetch_array($result); $i++) {
    

    $sql = " update {$g5['board_file_table']}
                        set bf_no = '$i'
                        where bo_table = '{$bo_table}'
                                  and wr_id = '{$wr_id}'
                                  and bf_no = '{$row['bf_no']}' ";
    sql_query($sql);
}

//쇼핑몰 설정에서 사용후기가 즉시 출력일 경우
if( ! $default['de_item_use_use'] ){
    update_use_cnt($it_id);
    update_use_avg($it_id);
}

if($w == 'd') {    
    $result = array('success' => $file_upload_msg.$alert_msg,'url' => $url);
    exit(json_encode($result));
} elseif ($w == 'dp') {
	//alert_close($alert_msg);
	$url = '/shop/orderItemList.php?od_id='. $od_id;
    $result = array('success' => $file_upload_msg.$alert_msg,'url' => $url);
    exit(json_encode($result));
} else {
    // alert_opener($alert_msg, $url);
    $result = array('success' => $file_upload_msg.$alert_msg,'url' => $url);
    exit(json_encode($result));
}
?>