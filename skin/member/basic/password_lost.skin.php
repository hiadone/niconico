<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

// add_stylesheet('css 구문', 출력순서); 숫자가 작을 수록 먼저 출력됨
add_stylesheet('<link rel="stylesheet" href="'.$member_skin_url.'/style.css">', 0);
?>

<!-- 회원정보 찾기 시작 { -->
<div id="find_info" class="new_win">
    <h1 id="win_title">회원 비밀번호 찾기</h1>
    <div class="new_win_con">
        <form name="fpasswordlost" action="<?php echo $action_url ?>" onsubmit="return fpasswordlost_submit(this);" method="post" autocomplete="off">
        <fieldset id="info_fs">
            <p style="margin-bottom:20px;">비밀번호를 찾고자 하는 아이디를 입력해 주세요.</p>
            <label for="mb_name" class="sound_only">이름<strong class="sound_only">필수</strong></label>
            <input type="text" name="mb_name" id="mb_name" required class="required frm_input full_input" size="30" placeholder="이름" style="margin-bottom:10px;">
			<label for="mb_userId" class="sound_only">아이디<strong class="sound_only">필수</strong></label>
            <input type="text" name="mb_userId" id="mb_userId" required class="required frm_input full_input" size="30" placeholder="아이디">
			<p style="margin:15px 0;">
                아이디를 모르시나요? <a href="/bbs/id_lost.php" style="color:#2d99f6;"><u>아이디 찾기</u></a>
            </p>
        </fieldset>
        <?php //echo captcha_html();  ?>

        <div class="win_btn">
            <button type="submit" class="btn_submit">확인</button>
            <button type="button" onclick="window.close();" class="btn_close">창닫기</button>  
        </div>
        </form>
    </div>
</div>

<script>
function fpasswordlost_submit(f)
{
   

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