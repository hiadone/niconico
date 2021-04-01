<?php
include_once('./_common.php');
include_once(G5_LIB_PATH.'/etc.lib.php');

if ($is_member) {
    alert_close('이미 로그인중입니다.', G5_URL);
}

$certNo = trim($_POST['certNo']);
$userNo = trim($_POST['userNo']);

if (!$certNo)
    alert_close('인증번호을 선택하여 주세요.');

if (!$userNo)
    alert_close('회원 정보를 입력하여 주세요.');


$sql = " select mb_7 from {$g5['member_table']} where mb_no = '". $userNo ."' ";
$row = sql_fetch($sql);

if ($row['mb_7'] == $certNo) {

	$sql = " select mb_no, mb_id, mb_name, mb_nick, mb_hp, mb_email, mb_datetime, mb_leave_date from {$g5['member_table']} where mb_no = '". $userNo ."' ";
	$mb = sql_fetch($sql);

	
	$g5['title'] = '인증번호 입력';
	include_once(G5_PATH.'/head.sub.php');

	$action_url = G5_HTTPS_BBS_URL."/changePasswordProc.php";
	include_once($member_skin_path.'/changePassword.skin.php');

	include_once(G5_PATH.'/tail.sub.php');
} else {
	alert_close('인증번호를 잘못 입력하셨습니다.');
}
?>