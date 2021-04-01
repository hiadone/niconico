<?php
if (!defined("_GNUBOARD_")) exit; // 개별 페이지 접근 불가

if (!defined("_ORDERINQUIRY_")) exit; // 개별 페이지 접근 불가

// 테마에 orderinquiry.sub.php 있으면 include
if(defined('G5_THEME_SHOP_PATH')) {
    $theme_inquiry_file = G5_THEME_MSHOP_PATH.'/orderinquiry.sub.php';
    if(is_file($theme_inquiry_file)) {
        include_once($theme_inquiry_file);
        return;
        unset($theme_inquiry_file);
    }
}
?>

<?php if (!$limit) { ?>총 <?php echo $cnt; ?> 건<?php } ?>


<div id="sod_inquiry">
    <ul>
        <?php
        $sql = " select *,
                    (od_cart_coupon + od_coupon + od_send_coupon) as couponprice
                   from {$g5['g5_shop_order_table']}
                  where mb_id = '{$member['mb_id']}'
                  order by od_id desc
                  $limit ";
        $result = sql_query($sql);
        for ($i=0; $row=sql_fetch_array($result); $i++)
        {
            // 주문상품
            $sql = " select it_name, ct_option
                        from {$g5['g5_shop_cart_table']}
                        where od_id = '{$row['od_id']}'
                        order by io_type, ct_id
                        limit 1 ";
            $ct = sql_fetch($sql);
            $ct_name = get_text($ct['it_name']).' '.get_text($ct['ct_option']);

            $sql = " select count(*) as cnt
                        from {$g5['g5_shop_cart_table']}
                        where od_id = '{$row['od_id']}' ";
            $ct2 = sql_fetch($sql);
            if($ct2['cnt'] > 1)
                $ct_name .= ' 외 '.($ct2['cnt'] - 1).'건';

            switch($row['od_status']) {
                case '주문':
                    $od_status = '<span class="status_01">입금확인중</span>';
                    break;
                case '입금':
                    $od_status = '<span class="status_02">입금완료</span>';
                    break;
                case '준비':
                    $od_status = '<span class="status_03">상품준비중</span>';
                    break;
                case '배송':
                    $od_status = '<span class="status_04">상품배송</span>';
                    break;
                case '완료':
                    $od_status = '<span class="status_05">배송완료</span>';
                    break;
                default:
                    $od_status = '<span class="status_06">주문취소</span>';
                    break;
            }

            $od_invoice = '';
            if($row['od_delivery_company'] && $row['od_invoice'])
                $od_invoice = '<span class="inv_inv"><i class="fa fa-truck" aria-hidden="true"></i> <strong>'.get_text($row['od_delivery_company']).'</strong> '.get_text($row['od_invoice']).'</span>';

            $uid = md5($row['od_id'].$row['od_time'].$row['od_ip']);
        ?>

        <li onclick="location.href='<?php echo G5_SHOP_URL; ?>/orderinquiryview.php?od_id=<?php echo $row['od_id']; ?>&amp;uid=<?php echo $uid; ?>';">
            <div class="inquiry_idtime">
                <a href="<?php echo G5_SHOP_URL; ?>/orderinquiryview.php?od_id=<?php echo $row['od_id']; ?>&amp;uid=<?php echo $uid; ?>" class="idtime_link"><?php echo $row['od_id']; ?></a>
                <span class="idtime_time"><?php echo substr($row['od_time'],2,25); ?></span>
            </div>
            <div class="inquiry_name">
                <?php echo $ct_name; ?>
            </div>
            <div class="inq_wr">
                <div class="inquiry_price">
                    <?php echo display_price($row['od_receipt_price']); ?>
                </div>
                <div class="inv_itemuse" style="float:right;text-align:center;margin-left:5px;">
					<?php
						/* 배송완료 일때만 사용후기 작성 버튼 노출 */
						if ($row['od_status'] == '완료') {
							if ($row['od_finish_time']) {
								$writableDay = strtotime($row['od_finish_time']) + 60 * 60 * 24 * 60;  // 배송완료일로부터 60일
								$remainSecond = $writableDay - time();
								$remainDay = intval($remainSecond / (3600 * 24));
							} else {
								$remainDay = 60;
							}

							$isWritable = 'N';

							// 작성 가능일 때
							if ($remainDay > 0) {
								// 후기 작성 했는지 체크
								$query = " SELECT * FROM g5_shop_cart WHERE od_id = '". $row['od_id'] ."' ";
								$res = sql_query($query);
								for ($rr = 0; $rrow=sql_fetch_array($res); $rr++) {
									$query = " SELECT count(*) as cnt FROM g5_shop_item_use WHERE it_id = '". $rrow['it_id'] ."' AND mb_id = '". $member['mb_id'] ."' AND od_id = '". $row['od_id'] ."' AND is_status = 1 ";
									$res2 = sql_fetch($query);
									$it_id = $rrow['it_id'];
									if ($res2['cnt'] == 0) {
										$isWritable = 'Y';
									}
								}
							
								if ($isWritable == 'Y') {
									
									echo "<span class=\"review-btn\"><a href=\"/shop/orderItemList.php?od_id=". $row['od_id'] ."\" class=\"btn02 itemuse_form\">사용후기 쓰기</a></span><br>";
									echo "작성만료 D-". $remainDay;

								} else {
									echo "<span class=\"review-label complet\"><a href=\"/shop/orderItemList.php?od_id=". $row['od_id'] ."\" class=\"itemuse_form\">작성리뷰 보기</a></span>";
								}
								
							} else {
								echo "<span class=\"review-label expira\">작성기간 만료</span>";
							}
						}
					?>
				</div>
				<div class="inv_status"><?php echo $od_status; ?></div>
				
            </div>
            <div class="inquiry_inv">
                <?php echo $od_invoice; ?>
            </div>
        </li>

        <?php
        }

        if ($i == 0)
            echo '<li class="empty_list">주문 내역이 없습니다.</li>';
        ?>
    </ul>
</div>
<script>
$(function(){
	$(".itemuse_form").click(function(){
        window.open(this.href, "itemuse_form", "width=810,height=680,scrollbars=1");
        return false;
    });
});
</script>