<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가


$email = $mb['mb_email'];
$emailArr = explode("@", $email);
$emailTxt = mb_substr($emailArr[0] , 0, -3). '***' ."@". $emailArr[1];

$sms = str_replace("-", "", $mb['mb_hp']);
$sms2 = str_pad(substr($sms, 0, 2), strlen($sms)-5, '*'). substr($sms, -5);

$length = strlen($sms2);
switch($length){
  case 11 :
	  $smsTxt = substr($sms2, 0, 3) .'-'. substr($sms2, 3, 4) .'-'. substr($sms2, 7, 4);
	  break;
  case 10:
	  $smsTxt = substr($sms2, 0, 3) .'-'. substr($sms2, 3, 3) .'-'. substr($sms2, 6, 4);
	  break;
  default :
	  $smsTxt = $sms2;
	  break;
}

// add_stylesheet('css 구문', 출력순서); 숫자가 작을 수록 먼저 출력됨
add_stylesheet('<link rel="stylesheet" href="'.$member_skin_url.'/style.css">', 0);
?>
<style>
	body { padding:0; }
	input[type="radio"] { -webkit-appearance: radio !important;}
</style>
<!-- 회원정보 찾기 시작 { -->
<div id="find_info" class="new_win">
    <h1 id="win_title">인증수단 선택<br/></h1>
    <div class="new_win_con">
		<p style="font-weight:normal;color:#888;margin-bottom:20px;">본인인증 방법을 선택해 주세요.</p>
        <form name="fpasswordlost" action="<?php echo $action_url ?>" onsubmit="return fpasswordlost_submit(this);" method="post" autocomplete="off">
        <div id="info_fs" style="line-height:160%; padding:0px 20px 10px;">
			<input type="hidden" name="userNo" value="<?php echo $mb['mb_no']; ?>">
            
            <input type="radio" name="certType" id="certType_1" value="m">
			<label for="certType_1">이메일 인증 (<?php echo $emailTxt; ?>)<br>가입시 등록한 이메일로 임시비밀번호가 발송됩니다.</label>
	
			<br><br>

            <input type="radio" name="certType" id="certType_2" value="s">
			<label for="certType_2">카카오톡 인증 (<?php echo $smsTxt; ?>)</label>
			
        </div>

<style>
.win_btn { text-align:center; margin-top:40px; }
.win_btn .btn_submit { display: inline-block; width:30% !important; }
.win_btn .btn_close { display: inline-block; color:#fff !important;width:30% !important; border:1px solid #555 !important; padding:12px 0 !important; background-color:#555555 !important; font-size:14px;}
</style>

        <div class="win_btn">
            <button type="submit" class="btn_submit">다음</button>
            <button type="button" onclick="window.close();" class="btn_close">창닫기</button>  
        </div>
        </form>
    </div>
</div>

<script>
function fpasswordlost_submit(f)
{
	if ($("input[name='certType']:checked").length == 0)
	{
		alert("인증 방법을 선택해 주세요.");
		return false;
	}
    return true;
}

$(function() {
    var sw = screen.width;
    var sh = screen.height;
    var cw = document.body.clientWidth;
    var ch = document.body.clientHeight;
    var top  = sh / 2 - ch / 2 - 100;
    var left = sw / 2 - cw / 2;
    moveTo(left, top);
});
</script>
<!-- } 회원정보 찾기 끝 -->