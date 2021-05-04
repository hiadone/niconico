<?php
include_once('./_common.php');

if (!$is_member) {
	alert_close("사용후기는 회원만 작성 가능합니다.");
}

$od_id = isset($_GET['od_id']) ? $_GET['od_id'] : null;
if (!$od_id) {
	alert_close('상품정보가 존재하지 않습니다.');
}

$sql = " select * from {$g5['g5_shop_order_table']} where od_id = '$od_id' ";
$od = sql_fetch($sql);

include_once(G5_PATH.'/head.sub.php');
add_stylesheet('<link rel="stylesheet" href="'.G5_SHOP_SKIN_URL.'/style.css">', 0);
?>
<style>
.title {
	margin:10px 0px;
}
</style>
<div id="sit_use_write" class="new_win">
	<div class="tbl_head03 tbl_wrap">
		<h2 class="title">주문서 번호 : <?php echo $od_id; ?></h2>
		<table>
		<thead>
			<tr>
				<th colspan="2" scope="col">주문내역</th>
				<th scope="col" style="width:130px;">사용후기</th>
			</tr>
		</thead>
		<tbody>
			<?php
				$sql = " select it_id, it_name, ct_send_cost, it_sc_type
							from {$g5['g5_shop_cart_table']}
							where od_id = '$od_id'
							and ct_status = '완료' 
							group by it_id
							order by ct_id ";
				$result = sql_query($sql);

				for($i=0; $row=sql_fetch_array($result); $i++) {
					$image = get_it_image($row['it_id'], 70, 70);

					// 합계금액 계산
					$sql = " select SUM(IF(io_type = 1, (io_price * ct_qty), ((ct_price + io_price) * ct_qty))) as price,
									SUM(ct_qty) as qty
								from {$g5['g5_shop_cart_table']}
								where it_id = '{$row['it_id']}'
								  and od_id = '$od_id' ";
					$sum = sql_fetch($sql);
			?>
			<tr>
				<td class="td_imgsmall"><?php echo $image; ?></td>
				<td><?php echo $row['it_name']; ?><br><?php echo number_format($sum['price']); ?>원</td>
				<td style="text-align:center;">
				<?php
					

					/* 배송완료 일때만 사용후기 작성 버튼 노출 */
					if ($od['od_status'] == '완료') {

                        

						if ($od['od_finish_time']) {
							$writableDay = strtotime($od['od_finish_time']) + 60 * 60 * 24 * 60;  // 배송완료일로부터 60일
							$remainSecond = $writableDay - time();
							$remainDay = intval($remainSecond / (3600 * 24));
						} else {
							$remainDay = 60;
						}

						$isWriteUse = 'N';

                        $query = " SELECT count(*) as cnt FROM g5_shop_item_use WHERE it_id = '". $row['it_id'] ."' AND mb_id = '". $member['mb_id'] ."' AND od_id = '". $od_id ."' AND is_status = 1 ";
                        $res = sql_fetch($query);
                        
                        if ($res['cnt'] > 0) {
                            $isWriteUse = 'Y';

                            $query = " SELECT is_score as score, is_id, is_time, is_ip FROM g5_shop_item_use WHERE it_id = '". $row['it_id'] ."' AND mb_id = '". $member['mb_id'] ."' AND od_id = '". $od_id ."' order by is_id desc limit 1 ";
                            $res2 = sql_fetch($query);
                            $score = (int)$res2['score'];
                        }

						// 작성 가능일 때
						if ($remainDay > 0) {
							// 후기 작성 했는지 체크
							
							
							if ($isWriteUse == 'N') {
								echo "작성만료 D-". $remainDay;
								echo "<br><span><a href=\"/shop/itemuseform.php?it_id=". $row['it_id'] ."&od_id=". $od_id ."\" class=\"btn02 itemuse_form\">사용후기 쓰기</a></span>";
							} else {
								

								$hash = md5($res2['is_id'].$res2['is_time'].$res2['is_ip']);
								$itemuse_list = G5_SHOP_URL."/itemuselist.php";
								$itemuse_form = G5_SHOP_URL."/itemuseform.php?it_id=".$row['it_id'];
								$itemuse_formupdate = G5_SHOP_URL."/itemuseformupdate.php?it_id=".$row['it_id'];
								
								echo "<span class=\"review-star\">";
								/* 별점을 이미지로 하고 싶은 경우 */
								//echo "<img src=\"이미지경로_". $score .".gif\">";

								/* 텍스트 별표로 해놓은 거 *
								for ($i = 1; $i <= 5; $i++) {
									if ($i <= $score) {
										echo "★";
									} else {
										echo "☆";
									}
								}
								*/

								echo "<img src=\"". G5_URL ."/shop/img/s_star". $score .".png\">";
								echo "</span>";
								echo '<div class="sit_use_cmd" style="margin-top:10px;">
											<a href="'. $itemuse_form .'&amp;is_id='. $res2['is_id'] .'&amp;w=u&amp;od_id='. $od_id .'"  class="itemuse_form btn01">수정</a>
											<a data-href="'. $itemuse_formupdate .'&amp;is_id='. $res2['is_id'] .'&amp;w=dp&amp;hash='. $hash .'&amp;od_id='. $od_id .'" class="itemuse_delete btn01">삭제</a>
                                            
										</div>';
                                echo '<div class="sit_use_cmd" style="margin-top:10px;">
                                             <button type="button" onClick="opener.location.href=\''.shop_item_url($row['it_id'], "_=".get_token()."&tab_tit=sit_use").'\';self.close();"  class="itemuse_form btn01">후기보러가기</button>
                                        </div>';
								//echo "<span>작성완료</span>";
							}
							
						} else {

                            if ($isWriteUse == 'N') {
                                echo "<span>작성기간 만료</span>";
                            }elseif ($isWriteUse == 'Y') {
                                echo "<span class=\"review-star\">";
                                /* 별점을 이미지로 하고 싶은 경우 */
                                //echo "<img src=\"이미지경로_". $score .".gif\">";

                                /* 텍스트 별표로 해놓은 거 *
                                for ($i = 1; $i <= 5; $i++) {
                                    if ($i <= $score) {
                                        echo "★";
                                    } else {
                                        echo "☆";
                                    }
                                }
                                */

                                echo "<img src=\"". G5_URL ."/shop/img/s_star". $score .".png\">";
                                echo "</span>";
                                echo '<div class="sit_use_cmd" style="margin-top:10px;">
                                            <button type="button" onClick="opener.location.href=\''.shop_item_url($row['it_id'], "_=".get_token()."&tab_tit=sit_use").'\';self.close();"  class="itemuse_form btn01">후기보러가기</button>
                                        </div>';
                            }
                            
							
						}
					}
				?>
			</tr>
			<?php
				}
			?>
		</tbody>
		</table>
	</div>

</div>

<script>
$(function(){
	$("#hd_login_msg").hide();

	$(".itemuse_delete").click(function(){
        if (confirm("정말 삭제 하시겠습니까?\n\n삭제후에는 되돌릴수 없습니다.")) {

        	$.ajax({
        	    url : $(this).data('href'),
        	    type : 'GET',
        	    dataType : 'json',
        	    success : function(data) {                
        	        if (data.error) {
        	            alert(data.error);
        	            return false;
        	        } else if (data.success) {
        	            alert(data.success);
        	            if(data.url){
        	                // if(w)
        	                //     location.href=data.url;
        	                // else
        	                location.reload();
        	                opener.location.reload();
        	                
        	            }
        	            return false;
        	            // $('.' + class).text(number_format(String(data.count)));
        	            // $('#btn-' + class).effect('highlight', {color : '#f37f60'}, 500);
        	        }
        	    }
        	});

            return true;
        } else {
            return false;
        }
    });


});
</script>

<?php
include_once(G5_PATH.'/tail.sub.php');
?>

