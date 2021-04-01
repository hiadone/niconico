<?php
include_once('./_common.php');
include_once(G5_CAPTCHA_PATH.'/captcha.lib.php');
include_once(G5_LIB_PATH.'/mailer.lib.php');
include_once(G5_LIB_PATH.'/etc.lib.php');

if ($is_member) {
    alert_close('이미 로그인중입니다.', G5_URL);
}

$certType = trim($_POST['certType']);
$userNo = trim($_POST['userNo']);


if (!$certType)
    alert_close('인증방법을 선택하여 주세요.');

if (!$userNo)
    alert_close('회원 정보를 입력하여 주세요.');


$sql = " select count(*) as cnt from {$g5['member_table']} where mb_no = '". $userNo ."' ";
$row = sql_fetch($sql);
if ($row['cnt'] > 1)
    alert('동일한 계정이 2개 이상 존재합니다.\\n\\n관리자에게 문의하여 주십시오.');

$sql = " select mb_no, mb_id, mb_name, mb_nick, mb_hp, mb_email, mb_datetime, mb_leave_date from {$g5['member_table']} where mb_no = '". $userNo ."' ";

$mb = sql_fetch($sql);
if (!$mb['mb_id'] || $mb['mb_leave_date'])
    alert('존재하지 않는 회원입니다.');
else if (is_admin($mb['mb_id']))
    alert('관리자 아이디는 접근 불가합니다.');


if ($certType == "m") {

	// 임시비밀번호 발급
	$change_password = rand(100000, 999999);
	$mb_lost_certify = get_encrypt_string($change_password);

	// 어떠한 회원정보도 포함되지 않은 일회용 난수를 생성하여 인증에 사용
	$mb_nonce = md5(pack('V*', rand(), rand(), rand(), rand()));

	// 임시비밀번호와 난수를 mb_lost_certify 필드에 저장
	$sql = " update {$g5['member_table']} set mb_lost_certify = '$mb_nonce $mb_lost_certify', mb_password = '". $mb_lost_certify ."' where mb_id = '{$mb['mb_id']}' ";
	sql_query($sql);

	// 인증 링크 생성
	//$href = G5_BBS_URL.'/password_lost_certify.php?mb_no='.$mb['mb_no'].'&amp;mb_nonce='.$mb_nonce;
	$href = G5_BBS_URL.'/login.php';

	$subject = "[".$config['cf_title']."] 요청하신 비밀번호 찾기 안내 메일입니다.";

	$content = "";

	$content .= '<div style="margin:30px auto;width:600px;border:10px solid #f7f7f7">';
	$content .= '<div style="border:1px solid #dedede">';
	$content .= '<h1 style="padding:30px 30px 0;background:#f7f7f7;color:#555;font-size:1.4em;margin:0;">';
	$content .= '비밀번호 찾기 안내';
	$content .= '</h1>';
	$content .= '<span style="display:block;padding:10px 30px 30px;background:#f7f7f7;text-align:right">';
	$content .= '<a href="'.G5_URL.'" target="_blank">'.$config['cf_title'].'</a>';
	$content .= '</span>';
	$content .= '<p style="margin:20px 0 0;padding:30px 30px 30px;border-bottom:1px solid #eee;line-height:1.7em">';
	$content .= addslashes($mb['mb_name'])." (".addslashes($mb['mb_id']).")"." 회원님은 ".G5_TIME_YMDHIS." 에 회원정보 찾기 요청을 하셨습니다.<br>";
	$content .= '니코니코몰은 개인정보 보호법에 의해 관리자도 회원님의 비밀번호를 알 수 없어, 임시 비밀번호를 생성하여 보내드립니다.<br>';
	//$content .= '아래 임시 비밀번호를 확인하시고, <span style="color:#ff3061"><strong>[임시 비밀번호 로그인]</strong></span> 버튼을 클릭 하세요.<br>';
	$content .= '</p>';
	$content .= '<p style="margin:0;padding:30px 30px 30px;border-bottom:1px solid #eee;line-height:1.7em">';
	$content .= '<span style="display:inline-block;width:100px">회원아이디</span> '.$mb['mb_id'].'<br>';
	$content .= '<span style="display:inline-block;width:100px">임시 비밀번호</span> <strong style="color:#ff3061">'.$change_password.'</strong>';
	$content .= '</p>';
	$content .= '<div style="font-size:12px;padding:30px 30px 30px;">';
	$content .= '<p style="margin:0;">1. 임시 비밀번호 로그인 버튼을 클릭하면 패스워드가 변경되었다는 인증 메시지가 출력됩니다.</p>';
	$content .= '<p style="margin:0;">2. 홈페이지에 회원 아이디와 위에 적힌 임시 비밀번호로 로그인 하세요.</p>';
	$content .= '<p style="margin:0;">3. 로그인 후에는 마이페이지>회원정보수정 에서 비밀번호를 변경해주세요.</p>';
	//$content .= '<p style="margin:0;">4. 아래 <임시 비밀번호 로그인>을 누르면 임시 비밀번호로 즉시 변경되며 두 번 클릭 시 오류 메시지가 출력됩니다.</p>';
	$content .= '</div>';
	$content .= '<a href="'.$href.'" target="_blank" style="font-size:18px;display:block;padding:30px 0;background:#c00000;color:#fff;text-decoration:none;text-align:center">임시 비밀번호 로그인</a>';
	$content .= '</div>';
	$content .= '</div>';

	mailer($config['cf_admin_email_name'], $config['cf_admin_email'], $mb['mb_email'], $subject, $content, 1);

	run_event('password_lost2_after', $mb, $mb_nonce, $mb_lost_certify);

	alert_close($email.' 메일로 회원아이디와 비밀번호를 인증할 수 있는 메일이 발송 되었습니다.\\n\\n메일을 확인하여 주십시오.');

} elseif ($certType == "s") {

	/* 인증번호 6자리 */
	$randNo = rand(100000, 999999);

	$sql = " update {$g5['member_table']} set mb_7 = '". $randNo ."' where mb_id = '{$mb['mb_id']}' ";
	sql_query($sql);

	
	
	/* 뿌리오 알림톡 보내기 */
	if ($mb['mb_hp']) {
		$content = getTemplate('pw_certificatecode_2');
		$content = replaceStrPPurio($content);

		$content = str_replace("#{mbr_name}", $mb['mb_name'], $content);
		$content = str_replace("#{rc_certificationCode}", $randNo, $content);

		sendPPurio(str_replace("-", "", $mb['mb_hp']), $content, 'pw_certificatecode_2', 5);
	}

	$g5['title'] = '인증번호 입력';
	include_once(G5_PATH.'/head.sub.php');

	$action_url = G5_HTTPS_BBS_URL."/certNoProc.php";
	include_once($member_skin_path.'/certNoInput.skin.php');

	include_once(G5_PATH.'/tail.sub.php');
}
?>
