<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

// add_stylesheet('css 구문', 출력순서); 숫자가 작을 수록 먼저 출력됨
add_stylesheet('<link rel="stylesheet" href="'.G5_SHOP_SKIN_URL.'/style.css">', 0);
?>

<!-- 사용후기 쓰기 시작 { -->
<div id="sit_use_write" class="new_win">
    <h1 id="win_title">사용후기 쓰기</h1>

    <form name="fitemuse" method="post" action="<?php echo G5_SHOP_URL;?>/itemuseformupdate.php" onsubmit="return fitemuse_submit(this);" autocomplete="off">
    <input type="hidden" name="w" value="<?php echo $w; ?>">
    <input type="hidden" name="it_id" value="<?php echo $it_id; ?>">
    <input type="hidden" name="is_id" value="<?php echo $is_id; ?>">
	<input type="hidden" name="od_id" value="<?php echo $od_id; ?>">

    <div class="new_win_con form_01">
        <ul>
            <li>
                <label for="is_subject" class="sound_only">제목<strong> 필수</strong></label>
                <input type="text" name="is_subject" value="<?php echo get_text($use['is_subject']); ?>" id="is_subject" required class="required frm_input full_input"  maxlength="20" placeholder="제목">
            </li>
            <li>
                <strong  class="sound_only">내용</strong>
				<p><strong>* 리뷰 및 후기글은 30자 이상이 되어야 등록 가능 합니다.</strong></p>
                <?php echo $editor_html; ?>
				<span style="float:right; text-align:right;"><span id="inputCntSpan">0</span>자</span>
            </li>
            <li>
                <span class="sound_only">평점</span>
                <ul id="sit_use_write_star" class="chk_box">
                    <li>
                        <input type="radio" name="is_score" value="5" id="is_score5" <?php echo ($is_score==5)?'checked="checked"':''; ?>>
                        <label for="is_score5"><span></span>매우만족</label>
                        <img src="<?php echo G5_URL; ?>/shop/img/s_star5.png" alt="매우만족">
                    </li>
                    <li>
                        <input type="radio" name="is_score" value="4" id="is_score4" <?php echo ($is_score==4)?'checked="checked"':''; ?>>
                        <label for="is_score4"><span></span>만족</label>
                        <img src="<?php echo G5_URL; ?>/shop/img/s_star4.png" alt="만족">
                    </li>
                    <li>
                        <input type="radio" name="is_score" value="3" id="is_score3" <?php echo ($is_score==3)?'checked="checked"':''; ?>>
                        <label for="is_score3"><span></span>보통</label>
                        <img src="<?php echo G5_URL; ?>/shop/img/s_star3.png" alt="보통">
                    </li>
                    <li>
                        <input type="radio" name="is_score" value="2" id="is_score2" <?php echo ($is_score==2)?'checked="checked"':''; ?>>
                        <label for="is_score2"><span></span>불만</label>
                        <img src="<?php echo G5_URL; ?>/shop/img/s_star2.png" alt="불만">
                    </li>
                    <li>
                        <input type="radio" name="is_score" value="1" id="is_score1" <?php echo ($is_score==1)?'checked="checked"':''; ?>>
                        <label for="is_score1"><span></span>매우불만</label>
                        <img src="<?php echo G5_URL; ?>/shop/img/s_star1.png" alt="매우불만">
                    </li>
                </ul>
            </li>
        </ul>

        <div class="win_btn">
            <button type="submit" class="btn_submit">작성완료</button>
            <button type="button" onclick="self.close();" class="btn_close">닫기</button>
        </div>
    </div>
    </form>
</div>

<script type="text/javascript">
function fitemuse_submit(f)
{
    <?php echo $editor_js; ?>

	var text = is_content_editor_data.replace(/<br>/ig, "");
	text = text.replace(/&nbsp;/ig, "");
	text = text.replace(/<(\/)?([a-zA-Z]*)(\s[a-zA-Z]*=[^>]*)?(\s)*(\/)?>/ig, "");
	
	if (text.length < 30)
	{
		alert('[사용후기 등록 안내]\n30자 이상 리뷰만 등록할 수 있습니다. 상세하게 적어주세요.');
		return false;
	}

    return true;
}

function getTextLength() {
	if ($("#se2_iframe").context.readyState == "complete")
	{
		var is_content_editor_data = oEditors.getById['is_content'].getIR();
		oEditors.getById['is_content'].exec('UPDATE_CONTENTS_FIELD', []);

		var text = is_content_editor_data.replace(/<br>/ig, "");
		text = text.replace(/&nbsp;/ig, "");
		text = text.replace(/<(\/)?([a-zA-Z]*)(\s[a-zA-Z]*=[^>]*)?(\s)*(\/)?>/ig, "");
		return text.length;
	} else {
		return 0;
	}
}

var timerId = setInterval(function() {
	$("#inputCntSpan").html(getTextLength());
}, 300);

$(function(){
	$("#is_content").attr("placeholder", "텍스트 리뷰 30자 이상");
});
</script>
<!-- } 사용후기 쓰기 끝 -->