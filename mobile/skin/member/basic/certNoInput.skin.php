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
    <h1 id="win_title">인증번호 입력</h1>
    <div class="new_win_con">
        <form name="fpasswordlost" action="<?php echo $action_url ?>" onsubmit="return fpasswordlost_submit(this);" method="post" autocomplete="off">
        <fieldset id="info_fs">
			<input type="hidden" name="userNo" value="<?php echo $mb['mb_no']; ?>">
            <p style="margin-bottom:20px;color:#888;">
                카카오톡으로 발송된 &lt;니코니코몰 알림톡&gt; 의 인증번호를 입력해 주세요.
            </p>
            
            <label for="certNo" class="sound_only">인증번호<strong class="sound_only">필수</strong></label>
            <input type="text" name="certNo" id="certNo" required class="required frm_input full_input" size="30" placeholder="인증번호">
		
        </fieldset>

        <div class="win_btn" style="margin-top:20px;">
            <button type="button" onclick="history.back(-1);" class="btn_close">이전</button>  
			<button type="submit" class="btn_submit">다음</button>
        </div>
        </form>
    </div>
</div>

<script>
function fpasswordlost_submit(f)
{
	if ($("#certNo").val() == "")
	{
		alert("인증 번호를 입력해 주세요.");
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