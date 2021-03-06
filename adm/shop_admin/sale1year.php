<?php
$sub_menu = '500110';
include_once('./_common.php');

auth_check($auth[$sub_menu], "r");

$fr_year = preg_replace('/[^0-9]/i', '', $fr_year);
$to_year = preg_replace('/[^0-9]/i', '', $to_year);

$g5['title'] = $fr_year.' ~ '.$to_year.' 연간 매출현황';
include_once (G5_ADMIN_PATH.'/admin.head.php');

function print_line($save)
{
    ?>
    <tr>
        <td class="td_alignc"><a href="./sale1month.php?fr_month=<?php echo $save['od_date']; ?>01&amp;to_month=<?php echo $save['od_date']; ?>12"><?php echo $save['od_date']; ?></a></td>
        <td class="td_num"><?php echo number_format($save['ordercount']); ?></td>
        <td class="td_numsum"><?php echo number_format($save['orderprice']); ?></td>
        <td class="td_numcoupon"><?php echo number_format($save['ordercoupon']); ?></td>
        <td class="td_numincome"><?php echo number_format($save['receiptbank']); ?></td>
        <td class="td_numincome"><?php echo number_format($save['receiptvbank']); ?></td>
        <td class="td_numincome"><?php echo number_format($save['receiptiche']); ?></td>
        <td class="td_numincome"><?php echo number_format($save['receiptcard']); ?></td>
        <td class="td_numincome"><?php echo number_format($save['receipthp']); ?></td>
        <td class="td_numincome"><?php echo number_format($save['receiptpoint']); ?></td>
        <td class="td_numcancel1"><?php echo number_format($save['ordercancel']); ?></td>
        <td class="td_numrdy"><?php echo number_format($save['misu']); ?></td>
    </tr>
    <?php
}

$sql = " select od_id,
                SUBSTRING(od_time,1,4) as od_date,
                od_send_cost,
                od_settle_case,
                od_receipt_price,
                od_receipt_point,
                od_cart_price,
                od_cancel_price,
                od_misu,
                (od_cart_price + od_send_cost + od_send_cost2) as orderprice,
                (od_cart_coupon + od_coupon + od_send_coupon) as couponprice
           from {$g5['g5_shop_order_table']}
          where SUBSTRING(od_time,1,4) between '$fr_year' and '$to_year'
          order by od_time desc ";
$result = sql_query($sql);
?>

<div class="tbl_head01 tbl_wrap">
    <table>
    <caption><?php echo $g5['title']; ?></caption>
    <thead>
    <tr>
        <th scope="col">주문년도</th>
        <th scope="col">주문수</th>
        <th scope="col">주문합계</th>
        <th scope="col">쿠폰</th>
        <th scope="col">무통장</th>
        <th scope="col">가상계좌</th>
        <th scope="col">계좌이체</th>
        <th scope="col">카드입금</th>
        <th scope="col">휴대폰</th>
        <th scope="col">포인트입금</th>
        <th scope="col">주문취소</th>
        <th scope="col">미수금</th>
    </tr>
    </thead>
    <tbody>
    <?php
    unset($save);
    unset($tot);
    for ($i=0; $row=sql_fetch_array($result); $i++)
    {
        if ($i == 0)
            $save['od_date'] = $row['od_date'];

        if ($save['od_date'] != $row['od_date']) {
            print_line($save);
            unset($save);
            $save['od_date'] = $row['od_date'];
        }

        $save['ordercount']++;
        $save['orderprice']    += $row['orderprice'];
        $save['ordercancel']   += $row['od_cancel_price'];
        $save['ordercoupon']   += $row['couponprice'];
        if($row['od_settle_case'] == '무통장')
            $save['receiptbank']   += $row['od_receipt_price'];
        if($row['od_settle_case'] == '가상계좌')
            $save['receiptvbank']   += $row['od_receipt_price'];
        if($row['od_settle_case'] == '계좌이체')
            $save['receiptiche']   += $row['od_receipt_price'];
        if($row['od_settle_case'] == '휴대폰')
            $save['receipthp']   += $row['od_receipt_price'];
        if($row['od_settle_case'] == '신용카드')
            $save['receiptcard']   += $row['od_receipt_price'];
        $save['receiptpoint']  += $row['od_receipt_point'];
        $save['misu']          += $row['od_misu'];

        $tot['ordercount']++;
        $tot['orderprice']    += $row['orderprice'];
        $tot['ordercancel']   += $row['od_cancel_price'];
        $tot['ordercoupon']   += $row['couponprice'];
        if($row['od_settle_case'] == '무통장')
            $tot['receiptbank']   += $row['od_receipt_price'];
        if($row['od_settle_case'] == '가상계좌')
            $tot['receiptvbank']   += $row['od_receipt_price'];
        if($row['od_settle_case'] == '계좌이체')
            $tot['receiptiche']   += $row['od_receipt_price'];
        if($row['od_settle_case'] == '휴대폰')
            $tot['receipthp']   += $row['od_receipt_price'];
        if($row['od_settle_case'] == '신용카드')
            $tot['receiptcard']   += $row['od_receipt_price'];
        $tot['receiptpoint']  += $row['od_receipt_point'];
        $tot['misu']          += $row['od_misu'];
    }

    if ($i == 0) {
        echo '<tr><td colspan="12" class="empty_table">자료가 없습니다.</td></tr>';
    } else {
        print_line($save);
    }
    ?>
    </tbody>
    <tfoot>
    <tr>
        <td>합 계</td>
        <td class="td_num_right"><?php echo number_format($tot['ordercount']); ?></td>
        <td class="td_num_right"><?php echo number_format($tot['orderprice']); ?></td>
        <td class="td_num_right"><?php echo number_format($tot['ordercoupon']); ?></td>
        <td class="td_num_right"><?php echo number_format($tot['receiptbank']); ?></td>
        <td class="td_num_right"><?php echo number_format($tot['receiptvbank']); ?></td>
        <td class="td_num_right"><?php echo number_format($tot['receiptiche']); ?></td>
        <td class="td_num_right"><?php echo number_format($tot['receiptcard']); ?></td>
        <td class="td_num_right"><?php echo number_format($tot['receipthp']); ?></td>
        <td class="td_num_right"><?php echo number_format($tot['receiptpoint']); ?></td>
        <td class="td_num_right"><?php echo number_format($tot['ordercancel']); ?></td>
        <td class="td_num_right"><?php echo number_format($tot['misu']); ?></td>
    </tr>
    </tfoot>
    </table>

	<button id="excelDownloadBtn" style="background-color:#288440;border:0;border-radius:4px;color:#fff;padding:8px 10px;">엑셀다운로드</button>
</div>

<script>
// Ajax 파일 다운로드
jQuery.download = function(url, data, method){
    // url과 data를 입력받음
    if( url && data ){
        // data 는  string 또는 array/object 를 파라미터로 받는다.
        data = typeof data == 'string' ? data : jQuery.param(data);
        // 파라미터를 form의  input으로 만든다.
        var inputs = '';
        jQuery.each(data.split('&'), function(){
            var pair = this.split('=');
            inputs+='<input type="hidden" name="'+ pair[0] +'" value="'+ pair[1] +'" />';
        });
        // request를 보낸다.
        jQuery('<form action="'+ url +'" method="'+ (method||'post') +'">'+inputs+'</form>')
        .appendTo('body').submit().remove();
    };
};

$(function(){
	$("#excelDownloadBtn").click(function(){
		$.download('excelPrint.php', 'action=sale1year&fr_year=<?php echo $fr_year; ?>&to_year=<?php echo $to_year; ?>', 'post');
	});

});
</script>

<?php
include_once (G5_ADMIN_PATH.'/admin.tail.php');
?>
