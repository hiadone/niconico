<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

// add_stylesheet('css 구문', 출력순서); 숫자가 작을 수록 먼저 출력됨
add_stylesheet('<link rel="stylesheet" href="'.G5_MSHOP_SKIN_URL.'/style.css">', 0);

function replaceNameFunc($str) {
	$name_x ='*';
	$name_a = mb_substr($str,0,1,"UTF-8");
	$name_b = mb_substr($str,2,10,"UTF-8");
	$str = $name_a.$name_x.$name_b;
	return $str;
}
?>

<script src="<?php echo G5_JS_URL; ?>/viewimageresize.js"></script>

<style>
/* 평점박스 스타일 */
.sit_use_top { height:auto; }
.sit_use_top:after { content:"";display:table;clear:both; }
.stats-chart td { text-align:center; padding:0 10px; }
</style>
<div id="sit_use_wbtn">
<?php
/*
    <a href="<?php echo $itemuse_form; ?>" class="qa_wr itemuse_form " onclick="return false;">사용후기 쓰기<span class="sound_only"> 새 창</span></a>
    <a href="<?php echo $itemuse_list; ?>" id="itemuse_list" class="btn01">더보기</a>
*/
?>
	<div style="float:left;text-align:center;width:25%">
		<h4>평균 별점 <?php /*<span>(총 <strong><?php echo $total_count; </strong> 건 상품평 기준)</span>*/?></h4>
		<p style="margin-top:20px;"><img src="<?php echo G5_SHOP_URL; ?>/img/s_star<?php echo $star_score?>.png" alt="" class="sit_star" style="width:85px;"></p>
		<h4 style="margin-top:10px;font-size:40px;font-weight:bold;"><?php echo $star_score; ?></h4>
	</div>
	<div style="float:left; margin-left:20px;">
		<h4 style="text-align:center;">별점 비율</h4>
		<?php
			$scoreArr = [5 => 0, 4 => 0, 3 => 0, 2 => 0, 1 => 0];
			$result2 = sql_query($sql);
			for ($i=0; $row=sql_fetch_array($result2); $i++)
			{
				$scoreArr[$row['is_score']]++;
			}
		?>
		<table>
			<tr>
				<?php
					foreach($scoreArr as $s => $v) {
				?>
				<td><?php if ($total_count > 0) { echo round($v / $total_count * 100); } else { echo "0"; } ?>%</td>
				<?php
					}
				?>
			</tr>
			<tr>
				<?php
					foreach($scoreArr as $s => $v) {
				?>
				<td style="text-align:center;">
					<div style="position:relative;display:inline-block;width:10px;height:60px;background-color:#f2f2f2;border-radius:50px;">
						<div style="position:absolute; bottom:2px;left:2px;width:6px;height:<?php if ($total_count > 0) { echo round($v / $total_count * 100); } else { echo "0"; } ?>%;background-color:#ffd508;border-radius:50px;">
							
						</div>
					</div>
				</td>
				<?php
					}
				?>
			</tr>
			<tr>
				<?php
					foreach($scoreArr as $s => $v) {
				?>
				<td><?php echo $s; ?>점</td>
				<?php
					}
				?>
			</tr>
			
		</table>
	</div>

	<div style="float:right;">
		<select id="orderOption">
			<option value="">정렬기준</option>
			<option value="photo" <?php if ($orderOption == 'photo') { echo "selected"; } ?>>포토리뷰</option>
			<option value="scoreHigh" <?php if ($orderOption == 'scoreHigh') { echo "selected"; } ?>>평점 높은 순</option>
			<option value="scoreLow" <?php if ($orderOption == 'scoreLow') { echo "selected"; } ?>>평점 낮은 순</option>
		</select>
	</div>
	<div style="clear:both;"></div>
</div>


<!-- 상품 사용후기 시작 { -->
<div id="sit_use_list">

    <?php
    $thumbnail_width = 500;

    for ($i=0; $row=sql_fetch_array($result); $i++)
    {
        $is_num     = $total_count - ($page - 1) * $rows - $i;
        $is_star    = get_star($row['is_score']);
        $is_name    = replaceNameFunc(get_text($row['is_name']));
		$is_mb_id	= get_text($row['mb_id']);
        $is_subject = conv_subject($row['is_subject'],50,"…");
        //$is_content = ($row['wr_content']);
        $is_content = get_view_thumbnail(conv_content($row['is_content'], 1), $thumbnail_width);
        $is_reply_name = !empty($row['is_reply_name']) ? get_text($row['is_reply_name']) : '';
        $is_reply_subject = !empty($row['is_reply_subject']) ? conv_subject($row['is_reply_subject'],50,"…") : '';
        $is_reply_content = !empty($row['is_reply_content']) ? get_view_thumbnail(conv_content($row['is_reply_content'], 1), $thumbnail_width) : '';
        $is_time    = substr($row['is_time'], 2, 8);
        $is_href    = './itemuselist.php?bo_table=itemuse&amp;wr_id='.$row['wr_id'];

        $hash = md5($row['is_id'].$row['is_time'].$row['is_ip']);

        if ($i == 0) echo '<ol id="sit_use_ol">';
    ?>

        <li class="sit_use_li">
			<div class="sit_use_li_title2">
				<div>
					<dl class="sit_use_dl">
						<dt>선호도</dt>
						<dd class="sit_use_star"><img src="<?php echo G5_SHOP_URL; ?>/img/s_star<?php echo $is_star; ?>.png" alt="별<?php echo $is_star; ?>개"></dd>
						<dt>제목</dt>

						<?php
							$is_subject = trim(iconv_substr(str_replace("&nbsp;", "", strip_tags($is_subject)), 0, 20, 'utf-8'));
						?>
						<dd><span class="sit_use_li_title" style="display:inline-block;width:auto;color:#000;"><?php echo $is_subject; ?></span>
						<?php
							/* 재구매인지 체크 */
								$query = " SELECT count(*) as cnt FROM g5_shop_item_use WHERE it_id = '". $row['it_id'] ."' AND mb_id = '". $row['mb_id'] ."' AND od_id < '". $row['od_id'] ."' AND od_id != '' AND is_status = 1 ";
								$res = sql_fetch($query);
								if ($res['cnt'] > 0) {
							?>
							<span style="color: #fff;
    background-color: #ed7d31;
    display: inline-block;
    font-size: 12px;
    border-radius: 4px;
    padding: 0px 5px;
    vertical-align: middle;">재구매</span>
							<?php
								}
							?>
						</dd>
					</dl>
				</div>
				<div>
					<dl class="sit_use_dl">
						<dt>작성자</dt>
						<dd>
						<?php echo $is_name; ?>(<?php echo $is_mb_id; ?>)</dd>
						<dt>작성일</dt>
						<dd><i class="fa fa-clock-o" aria-hidden="true"></i> <?php echo $is_time; ?></dd>
					</dl>
				</div>
				<div>
					<?php echo trim(iconv_substr(str_replace("&nbsp;", "", strip_tags($is_content)), 0, 30, 'utf-8')); ?> ...
				</div>
			</div>

            <div id="sit_use_con_<?php echo $i; ?>" class="sit_use_con">
                <div class="sit_use_p">
                    <?php echo $is_content; // 사용후기 내용 ?>
                </div>

                <?php if ($is_admin || $row['mb_id'] == $member['mb_id']) { ?>
                <div class="sit_use_cmd">
                    <a href="<?php echo $itemuse_form."&amp;is_id={$row['is_id']}&amp;w=u"; ?>" class="itemuse_form btn01" onclick="return false;">수정</a>
                    <a href="<?php echo $itemuse_formupdate."&amp;is_id={$row['is_id']}&amp;w=d&amp;hash={$hash}"; ?>" class="itemuse_delete btn01">삭제</a>
                </div>
                <?php } ?>

                <?php if( $is_reply_subject ){  //  사용후기 답변 내용이 있다면 ?>
                <div class="sit_use_reply">
                    <div class="use_reply_icon">답변</div>
                    <div class="use_reply_tit">
                        <?php echo $is_reply_subject; // 답변 제목 ?>
                    </div>
                    <div class="use_reply_name">
                        <?php echo $is_reply_name; // 답변자 이름 ?>
                    </div>
                    <div class="use_reply_p">
                        <?php echo $is_reply_content; // 답변 내용 ?>
                    </div>
                </div>
                <?php } //end if ?>
            </div>
        </li>

    <?php }

    if ($i > 0) echo '</ol>';

    if (!$i) echo '<p class="sit_empty">사용후기가 없습니다.</p>';
    ?>
</div>
<input type="hidden" id="it_id" value="<?php echo $it_id; ?>">
<?php
echo itemuse_page($config['cf_mobile_pages'], $page, $total_page, G5_SHOP_URL."/itemuse.php?it_id=$it_id&amp;page=", "");
?>

<script>
$(function(){
    $(".itemuse_form").click(function(){
        window.open(this.href, "itemuse_form", "width=810,height=680,scrollbars=1");
        return false;
    });

    $(".itemuse_delete").click(function(){
        if (confirm("정말 삭제 하시겠습니까?\n\n삭제후에는 되돌릴수 없습니다.")) {
            return true;
        } else {
            return false;
        }
    });

    $(".sit_use_li_title2").click(function(){
        var $con = $(this).siblings(".sit_use_con");
        if($con.is(":visible")) {
            $con.slideUp();
        } else {
            $(".sit_use_con:visible").hide();
            $con.slideDown(
                function() {
                    // 이미지 리사이즈
                    $con.viewimageresize2();
                }
            );
        }
    });

    $(".pg_page").click(function(){
        $("#itemuse").load($(this).attr("href"));
        return false;
    });

    $("a#itemuse_list").on("click", function() {
        window.opener.location.href = this.href;
        self.close();
        return false;
    });

	$("#orderOption").change(function(){
		$.ajax({
			url			: '/shop/itemuse.php',
			type		: 'POST',
			dataType	: 'html',
			contentType	: 'application/x-www-form-urlencoded; charset=utf-8',
			data : {
				it_id		: $("#it_id").val(),
				orderOption	: $("#orderOption").val()
			},
			success: function (response) {
				$("#itemuse").html(response);
			},
			failure: function(msg) {
				alert(msg);
			}
		});
		
	});
});
</script>
<!-- } 상품 사용후기 끝 -->