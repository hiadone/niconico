<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

// add_stylesheet('css 구문', 출력순서); 숫자가 작을 수록 먼저 출력됨
add_stylesheet('<link rel="stylesheet" href="'.$member_skin_url.'/style.css">', 0);
?>

<style>
	body { padding:0; }
</style>
<!-- 회원정보 찾기 시작 { -->
<div id="find_info" class="new_win">
    <h1 id="win_title">비밀번호 변경</h1>
    <div class="new_win_con">
        <form name="fpasswordlost" action="<?php echo $action_url ?>" onsubmit="return fpasswordlost_submit(this);" method="post" autocomplete="off">
        <fieldset id="info_fs">
			<input type="hidden" name="userNo" value="<?php echo $mb['mb_no']; ?>">
            <p style="margin-bottom:20px;">새로운 비밀번호를 등록해 주세요.</p>
            
            <label for="password1" class="sound_only">비밀번호<strong class="sound_only">필수</strong></label>
            <input type="password" name="password1" id="password1" required class="required frm_input full_input" size="30" placeholder="영문자, 숫자, 특수문자 중 2가지 이상 조합하여 입력하세요." style="margin-bottom:10px;">
				
			<label for="password2" class="sound_only">비밀번호 확인<strong class="sound_only">필수</strong></label>
            <input type="password" name="password2" id="password2" required class="required frm_input full_input" size="30" placeholder="새 비밀번호 확인">
			
        </fieldset>

        <div class="win_btn" style="margin-top:20px;">
			<button type="submit" class="btn_submit" style="width:130px;">확인</button>
        </div>
        </form>
    </div>
</div>

<script>
function fpasswordlost_submit(f)
{
	if ($("#password1").val() == "")
	{
		alert("비밀번호를 입력해 주세요.");
		return false;
	}
	if ($("#password2").val() == "")
	{
		alert("비밀번호 확인란을 입력해 주세요.");
		return false;
	}
	if ($("#password1").val() != $("#password2").val())
	{
		alert("비밀번호가 다릅니다. 다시 확인해 주세요.");
		return false;
	}
    return true;
}

$(function() {
	alert('인증되었습니다');

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