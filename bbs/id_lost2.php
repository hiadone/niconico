<?php
error_reporting(E_ALL);
ini_set('display_errors', '1');

include_once('./_common.php');
include_once(G5_CAPTCHA_PATH.'/captcha.lib.php');
include_once(G5_PATH.'/head.sub.php');

if ($is_member) {
    alert_close('이미 로그인중입니다.', G5_URL);
}

/*
if (!chk_captcha()) {
    alert('자동등록방지 숫자가 틀렸습니다.');
}
*/

$name = trim($_POST['mb_name']);
$email = get_email_address(trim($_POST['mb_email']));

if (!$name) {
	alert_close('이름을 입력해 주세요.');
}

if (!$email)
    alert_close('메일주소 오류입니다.');

$sql = " select count(*) as cnt from {$g5['member_table']} where mb_email = '$email' and mb_name = '". $name ."' ";
$row = sql_fetch($sql);
if ($row['cnt'] == 0)
    alert('회원 정보를 찾을 수 없습니다.');

$sql = " select mb_no, mb_id, mb_name, mb_nick, mb_email, mb_datetime, mb_leave_date from {$g5['member_table']} where mb_email = '$email' and mb_name = '". $name ."' ";
$mb = sql_fetch($sql);

if (!$mb['mb_id'] || $mb['mb_leave_date'])
    alert('존재하지 않는 회원입니다.');
else if (is_admin($mb['mb_id']))
    alert('관리자 아이디는 접근 불가합니다.');


include_once($member_skin_path.'/id_lost2.skin.php');
?>