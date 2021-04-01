<?php
if (!defined("_GNUBOARD_")) exit; // 개별 페이지 접근 불가

if (!defined("_ORDERINQUIRY_")) exit; // 개별 페이지 접근 불가

// 테마에 orderinquiry.sub.php 있으면 include
if(defined('G5_THEME_SHOP_PATH')) {
    $theme_inquiry_file = G5_THEME_SHOP_PATH.'/orderinquiry.sub.php';
    if(is_file($theme_inquiry_file)) {
        include_once($theme_inquiry_file);
        return;
        unset($theme_inquiry_file);
    }
}
?>

<!-- 주문 내역 목록 시작 { -->
<?php if (!$limit) { ?>총 <?php echo $cnt; ?> 건<?php } ?>

<div class="tbl_head03 tbl_wrap">
    <table>
    <thead>
    <tr>
        <th scope="col">주문서번호</th>
        <th scope="col">주문일시</th>
        <th scope="col">상품수</th>
        <th scope="col">주문금액</th>
        <th scope="col">입금액</th>
        <th scope="col">미입금액</th>
        <th scope="col">상태</th>
		<th scope="col">사용후기</th>
    </tr>
    </thead>
    <tbody>
    <?php
    $sql = " select *
               from {$g5['g5_shop_order_table']}
              where mb_id = '{$member['mb_id']}'
              order by od_id desc
              $limit ";
    $result = sql_query($sql);
    for ($i=0; $row=sql_fetch_array($result); $i++)
    {
        $uid = md5($row['od_id'].$row['od_time'].$row['od_ip']);

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
    ?>

    <tr>
        <td>
            <input type="hidden" name="ct_id[<?php echo $i; ?>]" value="<?php echo $row['ct_id']; ?>">
            <a href="<?php echo G5_SHOP_URL; ?>/orderinquiryview.php?od_id=<?php echo $row['od_id']; ?>&amp;uid=<?php echo $uid; ?>"><?php echo $row['od_id']; ?></a>
        </td>
        <td><?php echo substr($row['od_time'],2,14); ?> (<?php echo get_yoil($row['od_time']); ?>)</td>
        <td class="td_numbig"><?php echo $row['od_cart_count']; ?></td>
        <td class="td_numbig text_right"><?php echo display_price($row['od_cart_price'] + $row['od_send_cost'] + $row['od_send_cost2']); ?></td>
        <td class="td_numbig text_right"><?php echo display_price($row['od_receipt_price']); ?></td>
        <td class="td_numbig text_right"><?php echo display_price($row['od_misu']); ?></td>
        <td><?php echo $od_status; ?></td>
		<td>
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
						$query = " SELECT * FROM g5_shop_cart WHERE od_id = '". $row['od_id'] ."' AND ct_status = '완료' ";
						$res = sql_query($query);
						for ($rr = 0; $rrow=sql_fetch_array($res); $rr++) {
							$query = " SELECT count(*) as cnt FROM g5_shop_item_use WHERE it_id = '". $rrow['it_id'] ."' AND mb_id = '". $member['mb_id'] ."' AND od_id = '". $row['od_id'] ."' AND is_status = 1";
							$res2 = sql_fetch($query);
							$it_id = $rrow['it_id'];
							if ($res2['cnt'] == 0) {
								$isWritable = 'Y';
							}
						}
					
						if ($isWritable == 'Y') {
							echo "작성만료 D-". $remainDay;
							echo "<br><span><a href=\"/shop/orderItemList.php?od_id=". $row['od_id'] ."\" class=\"btn02 itemuse_form\">사용후기 쓰기</a></span>";
						} else {
							echo "<span class=\"review-label complet\"><a href=\"/shop/orderItemList.php?od_id=". $row['od_id'] ."\" class=\"itemuse_form\">작성리뷰 보기</a></span>";
						}
						
					} else {
						echo "<span class=\"review-label expira\">작성기간 만료</span>";
					}
				} elseif ($row['od_status'] == '입금' || $row['od_status'] == '준비' || $row['od_status'] == '배송') {
					echo '배송완료 후 <br>작성 가능합니다.';
				}
			?>
		</td>
    </tr>

    <?php
    }

    if ($i == 0)
        echo '<tr><td colspan="7" class="empty_table">주문 내역이 없습니다.</td></tr>';
    ?>
    </tbody>
    </table>
</div>
<!-- } 주문 내역 목록 끝 -->

<script>
$(function(){
	$(".itemuse_form").click(function(){
        window.open(this.href, "itemuse_form", "width=810,height=680,scrollbars=1");
        return false;
    });
});
</script>