<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

// add_stylesheet('css 구문', 출력순서); 숫자가 작을 수록 먼저 출력됨
add_stylesheet('<link rel="stylesheet" href="'.$member_skin_url.'/style.css">', 0);
?>

<!-- 회원정보 찾기 시작 { -->
<div id="find_info" class="new_win">
    <h1 id="win_title">아이디 찾기</h1>
    <div class="new_win_con">
        <form name="fidlost" method="post" autocomplete="off">
        <div id="info_fs" style="text-align:center;padding:0 0 20px 0; border-bottom:1px solid #ddd; margin-bottom:20px;">
            <p>
                <?php echo $name; ?>님의 아이디는<br>
				<b><?php echo $mb['mb_id']; ?></b> 입니다.
            </p>
        </div>

<style>
.win_btn { text-align:center; margin-top:30px; }
.win_btn .btns { display: inline-block; color:#000 !important;width:48% !important; border:1px solid #ddd !important; padding:12px 0 !important; font-size:14px;cursor:pointer;}
.win_btn .btn_close { display: inline-block; color:#fff !important;width:48% !important; border:1px solid #555 !important; padding:12px 0 !important; background-color:#555555 !important; font-size:14px;}
</style>
        <div class="win_btn">
            <button type="button" class="btns goFindPasswordBtn" onclick="location.href='<?php echo G5_BBS_URL ?>/password_lost.php';">비밀번호 찾기</button>
            <button type="button" onclick="window.close();" class="btn_close">로그인 하기</button>  
        </div>
        </form>
    </div>
</div>

<script>
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