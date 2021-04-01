<?php
include_once('./_common.php');
include_once(G5_CAPTCHA_PATH.'/captcha.lib.php');

if ($is_member) {
    alert("이미 로그인중입니다.");
}

$userNo = trim($_POST['userNo']);
$password = trim($_POST['password1']);

if (!$password)
    alert_close('비밀번호을 입력하여 alert("이미 로그인중입니다.");주세요.');

if (!$userNo)
    alert_close('회원 정보를 입력하여 주세요.');


$sql = " UPDATE {$g5['member_table']} SET mb_password = '". get_encrypt_string($password) ."', mb_7 = '' WHERE mb_no = ". $userNo;
sql_query($sql);

alert_close("비밀번호 변경이 완료되었습니다. 다시 로그인 하세요.");
?>