<?php
include_once('./_common.php');
include_once(G5_CAPTCHA_PATH.'/captcha.lib.php');
include_once(G5_LIB_PATH.'/mailer.lib.php');
include_once(G5_LIB_PATH.'/etc.lib.php');

if ($is_member) {
    alert_close('이미 로그인중입니다.', G5_URL);
}

/*
if (!chk_captcha()) {
    alert('자동등록방지 숫자가 틀렸습니다.');
}
*/

//$email = get_email_address(trim($_POST['mb_email']));
$mb_id = trim($_POST['mb_userId']);
$mb_name = trim($_POST['mb_name']);

if (!$mb_id)
    alert_close('아이디를 입력하여 주세요.');

if (!$mb_name)
    alert_close('이름을 입력하여 주세요.');


$sql = " select count(*) as cnt from {$g5['member_table']} where mb_id = '". $mb_id ."' and mb_name = '". $mb_name ."' ";
$row = sql_fetch($sql);
if ($row['cnt'] > 1)
    alert('동일한 계정이 2개 이상 존재합니다.\\n\\n관리자에게 문의하여 주십시오.');

$sql = " select mb_no, mb_id, mb_name, mb_nick, mb_email, mb_datetime, mb_leave_date, mb_hp, mb_tel from {$g5['member_table']} where mb_id = '". $mb_id ."' and mb_name = '". $mb_name ."' ";

$mb = sql_fetch($sql);
if (!$mb['mb_id'] || $mb['mb_leave_date'])
    alert('존재하지 않는 회원입니다.');
else if (is_admin($mb['mb_id']))
    alert('관리자 아이디는 접근 불가합니다.');



$g5['title'] = '회원정보 찾기';
include_once(G5_PATH.'/head.sub.php');

$action_url = G5_HTTPS_BBS_URL."/password_lost_new.php";
include_once($member_skin_path.'/password_lost_method.skin.php');

include_once(G5_PATH.'/tail.sub.php');
?>