<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

// add_stylesheet('css 구문', 출력순서); 숫자가 작을 수록 먼저 출력됨
add_stylesheet('<link rel="stylesheet" href="'.G5_MSHOP_SKIN_URL.'/style.css">', 0);
?>
<style>
body {
	padding-top:0px !important;
}
</style>
<!-- 사용후기 쓰기 시작 { -->
<div id="sit_use_write" class="new_win">
    <h1 id="win_title">사용후기 쓰기</h1>

    <form name="fitemuse" method="post" action="<?php echo G5_SHOP_URL;?>/itemuseformupdate.php" onsubmit="return fitemuse_submit(this);" autocomplete="off" enctype="multipart/form-data">
    <input type="hidden" name="w" value="<?php echo $w; ?>">
    <input type="hidden" name="it_id" value="<?php echo $it_id; ?>">
    <input type="hidden" name="is_id" value="<?php echo $is_id; ?>">
	<input type="hidden" name="od_id" value="<?php echo $od_id; ?>">
    <input type="hidden" name="is_mobile_shop" value="1">

    <div class="form_01 chk_box">
        <ul>
            <li>
                <label for="is_subject" class="sound_only">제목</label>
                <input type="text" name="is_subject" value="<?php echo get_text($use['is_subject']); ?>" id="is_subject" required class="required frm_input" minlength="2" maxlength="20" placeholder="제목">
            </li>
            <li>
                <span class="sound_only">내용</span>
                <?php echo $editor_html; ?>
            </li>
			<li style="text-align:right;">
				<span style="text-align:right;"><span id="inputCntSpan">0</span>/30자</span>
			</li>
			<li class="filebox">
				<input type="text" class="fileName" readonly="readonly" placeholder="리뷰이미지">
	            <label for="reviewImage" class="btn_file"><span class="sound_only">리뷰이미지</span>이미지선택</label>
	            <input type="file" name="reviewImage" id="reviewImage" class="uploadBtn">
	            <span class="frm_info">
	                gif, jpg, png파일만 가능하며 상품과 상관없는 사진을 첨부한 리뷰는 통보없이 삭제될 수 있습니다.
	            </span>
			</li>
            <li>
                <span class="sound_only">평가</span>
                <ul id="sit_use_write_star">
                    <li>
                        <input type="radio" name="is_score" value="5" id="is_score10" <?php echo ($is_score==5)?'checked="checked"':''; ?>>
                        <label for="is_score10"><span></span>매우만족</label>
                        <img src="<?php echo G5_SHOP_URL; ?>/img/s_star5.png" width="90">
                    </li>
                    <li>
                        <input type="radio" name="is_score" value="4" id="is_score8" <?php echo ($is_score==4)?'checked="checked"':''; ?>>
                        <label for="is_score8"><span></span>만족</label>
                        <img src="<?php echo G5_SHOP_URL; ?>/img/s_star4.png" width="90">
                    </li>
                    <li>
                        <input type="radio" name="is_score" value="3" id="is_score6" <?php echo ($is_score==3)?'checked="checked"':''; ?>>
                        <label for="is_score6"><span></span>보통</label>
                        <img src="<?php echo G5_SHOP_URL; ?>/img/s_star3.png" width="90">
                    </li>
                    <li>
                        <input type="radio" name="is_score" value="2" id="is_score4" <?php echo ($is_score==2)?'checked="checked"':''; ?>>
                        <label for="is_score4"><span></span>불만</label>
                        <img src="<?php echo G5_SHOP_URL; ?>/img/s_star2.png" width="90">
                    </li>
                    <li>
                        <input type="radio" name="is_score" value="1" id="is_score2" <?php echo ($is_score==1)?'checked="checked"':''; ?>>
                        <label for="is_score2"><span></span>매우불만</label>
                        <img src="<?php echo G5_SHOP_URL; ?>/img/s_star1.png" width="90">
                    </li>
				</ul>
            </li>
        </ul>
    </div>

    <div class="win_btn">
        <button type="submit" class="btn_submit">작성완료</button>
        <button type="button" onclick="self.close();" class="btn_close">닫기</button>
    </div>

    </form>
</div>

<script type="text/javascript">
function fitemuse_submit(f)
{
    <?php echo $editor_js; ?>

	var text = $("#is_content").val().replace(/<br>/ig, "");
	text = text.replace(/\n/ig, "");
	text = text.replace(/&nbsp;/ig, "");
	text = text.replace(/<(\/)?([a-zA-Z]*)(\s[a-zA-Z]*=[^>]*)?(\s)*(\/)?>/ig, "");
	
	if (text.length < 30)
	{
		alert('[사용후기 등록 안내]\n30자 이상 리뷰만 등록할 수 있습니다. 상세하게 적어주세요.');
		return false;
	}



    return true;
}

$(function(){
	$("#is_content").attr("placeholder", "텍스트 리뷰 30자 이상");
	var uploadFile = $('.filebox .uploadBtn');
	uploadFile.on('change', function(){
		if(window.FileReader){
			var filename = $(this)[0].files[0].name;
		} else {
			var filename = $(this).val().split('/').pop().split('\\').pop();
		}
		
		if(!/\.(gif|jpg|jpeg|png)$/i.test(filename)) {
			alert('gif, jpg, png 파일만 선택해 주세요.\n\n현재 파일 : ' + filename);
			return false;
		} 

		$(this).siblings('.fileName').val(filename);
	});

	$("#is_content").keyup(function(){
		var text = $(this).val().replace(/<br>/ig, "");
		text = text.replace(/\n/ig, "");
		text = text.replace(/&nbsp;/ig, "");
		text = text.replace(/<(\/)?([a-zA-Z]*)(\s[a-zA-Z]*=[^>]*)?(\s)*(\/)?>/ig, "");
		$("#inputCntSpan").html(text.length);
	});
});
</script>
<!-- } 사용후기 쓰기 끝 -->