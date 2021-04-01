<?php
$sub_menu = '500120';
include_once('./_common.php');

auth_check($auth[$sub_menu], "r");

include_once(G5_LIB_PATH.'/Excel/php_writeexcel/class.writeexcel_workbook.inc.php');
include_once(G5_LIB_PATH.'/Excel/php_writeexcel/class.writeexcel_worksheet.inc.php');

$action = isset($_POST['action']) ? $_POST['action'] : null;
if ($action == "sale1today") {

	$date = preg_replace('/[^0-9]/i', '', $date);
	$date = preg_replace("/([0-9]{4})([0-9]{2})([0-9]{2})/", "\\1-\\2-\\3", $date);

	
	$sql = " select od_id,
					mb_id,
					od_name,
					od_settle_case,
					od_cart_price,
					od_receipt_price,
					od_receipt_point,
					od_cancel_price,
					od_misu,
					(od_cart_price + od_send_cost + od_send_cost2) as orderprice,
					(od_cart_coupon + od_coupon + od_send_coupon) as couponprice
			   from {$g5['g5_shop_order_table']}
			  where SUBSTRING(od_time,1,10) = '$date'
			  order by od_id desc ";
	$result = sql_query($sql);
	
	
	$fname = tempnam(G5_DATA_PATH, "tmp-orderlist.xls");
    $workbook = new writeexcel_workbook($fname);
    $worksheet = $workbook->addworksheet();

	$data = array('주문번호', '주문자', '주문합계', '쿠폰', '무통장', '가상계좌', '계좌이체', '카드입금', '휴대폰', '포인트입금', '주문취소', '미수금');
    $data = array_map('iconv_euckr', $data);

	$col = 0;
    foreach($data as $cell) {
        $worksheet->write(0, $col++, $cell);
    }

	unset($tot);

	for ($i=1; $row=sql_fetch_array($result); $i++)
    {
        if ($row['mb_id'] == '') { // 비회원일 경우는 주문자로 링크
            $href = '<a href="./orderlist.php?sel_field=od_name&amp;search='.$row['od_name'].'">';
        } else { // 회원일 경우는 회원아이디로 링크
            $href = '<a href="./orderlist.php?sel_field=mb_id&amp;search='.$row['mb_id'].'">';
        }

        $receipt_bank = $receipt_card = $receipt_vbank = $receipt_iche = $receipt_hp = 0;
        if($row['od_settle_case'] == '무통장')
            $receipt_bank = $row['od_receipt_price'];
        if($row['od_settle_case'] == '가상계좌')
            $receipt_vbank = $row['od_receipt_price'];
        if($row['od_settle_case'] == '계좌이체')
            $receipt_iche = $row['od_receipt_price'];
        if($row['od_settle_case'] == '휴대폰')
            $receipt_hp = $row['od_receipt_price'];
        if($row['od_settle_case'] == '신용카드')
            $receipt_card = $row['od_receipt_price'];


		$row = array_map('iconv_euckr', $row);

        $worksheet->write($i, 0, $row['od_id']);
        $worksheet->write($i, 1, $row['od_name']);
        $worksheet->write($i, 2, number_format($row['orderprice']));
        $worksheet->write($i, 3, number_format($row['couponprice']));
        $worksheet->write($i, 4, number_format($receipt_bank));
        $worksheet->write($i, 5, number_format($receipt_vbank));
		$worksheet->write($i, 6, number_format($receipt_iche));
        $worksheet->write($i, 7, number_format($receipt_card));
        $worksheet->write($i, 8, number_format($receipt_hp));
        $worksheet->write($i, 9, number_format($row['od_receipt_point']));
        $worksheet->write($i, 10, number_format($row['od_cancel_price']));
        $worksheet->write($i, 11, number_format($row['od_misu']));

		$tot['orderprice']    += $row['orderprice'];
        $tot['ordercancel']   += $row['od_cancel_price'];
        $tot['coupon']        += $row['couponprice'] ;
        $tot['receipt_bank']  += $receipt_bank;
        $tot['receipt_vbank'] += $receipt_vbank;
        $tot['receipt_iche']  += $receipt_iche;
        $tot['receipt_card']  += $receipt_card;
        $tot['receipt_hp']    += $receipt_hp;
        $tot['receipt_point'] += $row['od_receipt_point'];
        $tot['misu']          += $row['od_misu'];
	}

	$worksheet->merge_cells($i, 0, $i, 1);
	$worksheet->write($i, 0, "Sum");
	$worksheet->write($i, 2, number_format($tot['orderprice']));
	$worksheet->write($i, 3, number_format($tot['coupon']));
	$worksheet->write($i, 4, number_format($tot['receipt_bank']));
	$worksheet->write($i, 5, number_format($tot['receipt_vbank']));
	$worksheet->write($i, 6, number_format($tot['receipt_iche']));
	$worksheet->write($i, 7, number_format($tot['receipt_card']));
	$worksheet->write($i, 8, number_format($tot['receipt_hp']));
	$worksheet->write($i, 9, number_format($tot['receipt_point']));
	$worksheet->write($i, 10, number_format($tot['ordercancel']));
	$worksheet->write($i, 11, number_format($tot['misu']));

	$workbook->close();

    header("Content-Type: application/x-msexcel; name=\"orderlist-".date("ymd", time()).".xls\"");
    header("Content-Disposition: inline; filename=\"orderlist-".date("ymd", time()).".xls\"");
    $fh=fopen($fname, "rb");
    fpassthru($fh);
    unlink($fname);

    exit;
}

elseif ($action == "sale1date") {
	$fr_date = $_POST['fr_date'];
	$to_date = $_POST['to_date'];

	$fr_date = preg_replace('/[^0-9]/i', '', $fr_date);
	$to_date = preg_replace('/[^0-9]/i', '', $to_date);

	$fr_date = preg_replace("/([0-9]{4})([0-9]{2})([0-9]{2})/", "\\1-\\2-\\3", $fr_date);
	$to_date = preg_replace("/([0-9]{4})([0-9]{2})([0-9]{2})/", "\\1-\\2-\\3", $to_date);

	$sql = " select od_id,
				SUBSTRING(od_time,1,10) as od_date,
				od_settle_case,
				od_receipt_price,
				od_receipt_point,
				od_cart_price,
				od_cancel_price,
				od_misu,
				(od_cart_price + od_send_cost + od_send_cost2) as orderprice,
				(od_cart_coupon + od_coupon + od_send_coupon) as couponprice
		   from {$g5['g5_shop_order_table']}
		  where SUBSTRING(od_time,1,10) between '$fr_date' and '$to_date'
		  order by od_time desc ";
	$result = sql_query($sql);

	$fname = tempnam(G5_DATA_PATH, "tmp-orderlist.xls");
    $workbook = new writeexcel_workbook($fname);
    $worksheet = $workbook->addworksheet();

	$data = array('주문일', '주문수', '주문합계', '쿠폰', '무통장', '가상계좌', '계좌이체', '카드입금', '휴대폰', '포인트입금', '주문취소', '미수금');
    $data = array_map('iconv_euckr', $data);

	$col = 0;
    foreach($data as $cell) {
        $worksheet->write(0, $col++, $cell);
    }

	unset($tot);
	unset($save);
	$line = 1;

	for ($i=1; $row=sql_fetch_array($result); $i++)
    {
        if ($i == 1)
            $save['od_date'] = $row['od_date'];

        if ($save['od_date'] != $row['od_date']) {
            print_line($save, $line);
			$line++;
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
        $tot['orderprice']     += $row['orderprice'];
        $tot['ordercancel']    += $row['od_cancel_price'];
        $tot['ordercoupon']    += $row['couponprice'];
        if($row['od_settle_case'] == '무통장')
            $tot['receiptbank']    += $row['od_receipt_price'];
        if($row['od_settle_case'] == '가상계좌')
            $tot['receiptvbank']    += $row['od_receipt_price'];
        if($row['od_settle_case'] == '계좌이체')
            $tot['receiptiche']    += $row['od_receipt_price'];
        if($row['od_settle_case'] == '휴대폰')
            $tot['receipthp']    += $row['od_receipt_price'];
        if($row['od_settle_case'] == '신용카드')
            $tot['receiptcard']    += $row['od_receipt_price'];
        $tot['receiptpoint']  += $row['od_receipt_point'];
        $tot['misu']           += $row['od_misu'];
    }

	print_line($save, $line);
	$line++;

	$worksheet->write($line, 0, "Sum");
	$worksheet->write($line, 1, number_format($tot['ordercount']));
	$worksheet->write($line, 2, number_format($tot['orderprice']));
	$worksheet->write($line, 3, number_format($tot['ordercoupon']));
	$worksheet->write($line, 4, number_format($tot['receiptbank']));
	$worksheet->write($line, 5, number_format($tot['receiptvbank']));
	$worksheet->write($line, 6, number_format($tot['receiptiche']));
	$worksheet->write($line, 7, number_format($tot['receiptcard']));
	$worksheet->write($line, 8, number_format($tot['receipthp']));
	$worksheet->write($line, 9, number_format($tot['receiptpoint']));
	$worksheet->write($line, 10, number_format($tot['ordercancel']));
	$worksheet->write($line, 11, number_format($tot['misu']));

	$workbook->close();

    header("Content-Type: application/x-msexcel; name=\"orderlist-".$fr_date."-".$to_date.".xls\"");
    header("Content-Disposition: inline; filename=\"orderlist-".$fr_date."-".$to_date.".xls\"");
    $fh=fopen($fname, "rb");
    fpassthru($fh);
    unlink($fname);
}

elseif ($action == "sale1month") {
	$fr_month = $_POST['fr_month'];
	$to_month = $_POST['to_month'];

	$fr_month = preg_replace('/[^0-9]/i', '', $fr_month);
	$to_month = preg_replace('/[^0-9]/i', '', $to_month);

	$fr_month = preg_replace("/([0-9]{4})([0-9]{2})/", "\\1-\\2", $fr_month);
	$to_month = preg_replace("/([0-9]{4})([0-9]{2})/", "\\1-\\2", $to_month);

	$sql = " select od_id,
				SUBSTRING(od_time,1,7) as od_date,
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
		  where SUBSTRING(od_time,1,7) between '$fr_month' and '$to_month'
		  order by od_time desc ";
	$result = sql_query($sql);

	$fname = tempnam(G5_DATA_PATH, "tmp-orderlist.xls");
    $workbook = new writeexcel_workbook($fname);
    $worksheet = $workbook->addworksheet();

	$data = array('주문월', '주문수', '주문합계', '쿠폰', '무통장', '가상계좌', '계좌이체', '카드입금', '휴대폰', '포인트입금', '주문취소', '미수금');
    $data = array_map('iconv_euckr', $data);

	$col = 0;
    foreach($data as $cell) {
        $worksheet->write(0, $col++, $cell);
    }

	unset($tot);
	unset($save);
	$line = 1;

	for ($i=1; $row=sql_fetch_array($result); $i++)
    {
        if ($i == 1)
            $save['od_date'] = $row['od_date'];

        if ($save['od_date'] != $row['od_date']) {
            print_line($save, $line);
			$line++;
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
        $tot['orderprice']     += $row['orderprice'];
        $tot['ordercancel']    += $row['od_cancel_price'];
        $tot['ordercoupon']    += $row['couponprice'];
        if($row['od_settle_case'] == '무통장')
            $tot['receiptbank']    += $row['od_receipt_price'];
        if($row['od_settle_case'] == '가상계좌')
            $tot['receiptvbank']    += $row['od_receipt_price'];
        if($row['od_settle_case'] == '계좌이체')
            $tot['receiptiche']    += $row['od_receipt_price'];
        if($row['od_settle_case'] == '휴대폰')
            $tot['receipthp']    += $row['od_receipt_price'];
        if($row['od_settle_case'] == '신용카드')
            $tot['receiptcard']    += $row['od_receipt_price'];
        $tot['receiptpoint']  += $row['od_receipt_point'];
        $tot['misu']           += $row['od_misu'];
    }

	print_line($save, $line);
	$line++;

	$worksheet->write($line, 0, "Sum");
	$worksheet->write($line, 1, number_format($tot['ordercount']));
	$worksheet->write($line, 2, number_format($tot['orderprice']));
	$worksheet->write($line, 3, number_format($tot['ordercoupon']));
	$worksheet->write($line, 4, number_format($tot['receiptbank']));
	$worksheet->write($line, 5, number_format($tot['receiptvbank']));
	$worksheet->write($line, 6, number_format($tot['receiptiche']));
	$worksheet->write($line, 7, number_format($tot['receiptcard']));
	$worksheet->write($line, 8, number_format($tot['receipthp']));
	$worksheet->write($line, 9, number_format($tot['receiptpoint']));
	$worksheet->write($line, 10, number_format($tot['ordercancel']));
	$worksheet->write($line, 11, number_format($tot['misu']));

	$workbook->close();

    header("Content-Type: application/x-msexcel; name=\"orderlist-".$fr_month."-".$to_month.".xls\"");
    header("Content-Disposition: inline; filename=\"orderlist-".$fr_month."-".$to_month.".xls\"");
    $fh=fopen($fname, "rb");
    fpassthru($fh);
    unlink($fname);
}

elseif ($action == "sale1year") {
	$fr_year = $_POST['fr_year'];
	$to_year = $_POST['to_year'];

	$fr_year = preg_replace('/[^0-9]/i', '', $fr_year);
	$to_year = preg_replace('/[^0-9]/i', '', $to_year);

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

	$fname = tempnam(G5_DATA_PATH, "tmp-orderlist.xls");
    $workbook = new writeexcel_workbook($fname);
    $worksheet = $workbook->addworksheet();

	$data = array('주문년도', '주문수', '주문합계', '쿠폰', '무통장', '가상계좌', '계좌이체', '카드입금', '휴대폰', '포인트입금', '주문취소', '미수금');
    $data = array_map('iconv_euckr', $data);

	$col = 0;
    foreach($data as $cell) {
        $worksheet->write(0, $col++, $cell);
    }

	unset($tot);
	unset($save);
	$line = 1;

	for ($i=1; $row=sql_fetch_array($result); $i++)
    {
        if ($i == 1)
            $save['od_date'] = $row['od_date'];

        if ($save['od_date'] != $row['od_date']) {
            print_line($save, $line);
			$line++;
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
        $tot['orderprice']     += $row['orderprice'];
        $tot['ordercancel']    += $row['od_cancel_price'];
        $tot['ordercoupon']    += $row['couponprice'];
        if($row['od_settle_case'] == '무통장')
            $tot['receiptbank']    += $row['od_receipt_price'];
        if($row['od_settle_case'] == '가상계좌')
            $tot['receiptvbank']    += $row['od_receipt_price'];
        if($row['od_settle_case'] == '계좌이체')
            $tot['receiptiche']    += $row['od_receipt_price'];
        if($row['od_settle_case'] == '휴대폰')
            $tot['receipthp']    += $row['od_receipt_price'];
        if($row['od_settle_case'] == '신용카드')
            $tot['receiptcard']    += $row['od_receipt_price'];
        $tot['receiptpoint']  += $row['od_receipt_point'];
        $tot['misu']           += $row['od_misu'];
    }

	print_line($save, $line);
	$line++;

	$worksheet->write($line, 0, "Sum");
	$worksheet->write($line, 1, number_format($tot['ordercount']));
	$worksheet->write($line, 2, number_format($tot['orderprice']));
	$worksheet->write($line, 3, number_format($tot['ordercoupon']));
	$worksheet->write($line, 4, number_format($tot['receiptbank']));
	$worksheet->write($line, 5, number_format($tot['receiptvbank']));
	$worksheet->write($line, 6, number_format($tot['receiptiche']));
	$worksheet->write($line, 7, number_format($tot['receiptcard']));
	$worksheet->write($line, 8, number_format($tot['receipthp']));
	$worksheet->write($line, 9, number_format($tot['receiptpoint']));
	$worksheet->write($line, 10, number_format($tot['ordercancel']));
	$worksheet->write($line, 11, number_format($tot['misu']));

	$workbook->close();

    header("Content-Type: application/x-msexcel; name=\"orderlist-".$fr_year."-".$to_year.".xls\"");
    header("Content-Disposition: inline; filename=\"orderlist-".$fr_year."-".$to_year.".xls\"");
    $fh=fopen($fname, "rb");
    fpassthru($fh);
    unlink($fname);
} 

elseif ($action == "itemsellrank") {
	$fr_date = $_POST['fr_date'];
	$to_date = $_POST['to_date'];

	if (!$to_date) $to_date = date("Ymd", time());

	if ($sort1 == "") $sort1 = "ct_status_sum";
	if (!in_array($sort1, array('ct_status_1', 'ct_status_2', 'ct_status_3', 'ct_status_4', 'ct_status_5', 'ct_status_6', 'ct_status_7', 'ct_status_8', 'ct_status_9', 'ct_status_sum'))) $sort1 = "ct_status_sum";
	if ($sort2 == "" || $sort2 != "asc") $sort2 = "desc";

	$doc = strip_tags($doc);
	$sort1 = strip_tags($sort1);

	if( preg_match("/[^0-9]/", $fr_date) ) $fr_date = '';
	if( preg_match("/[^0-9]/", $to_date) ) $to_date = '';

	$sql  = " select a.it_id,
					 b.*,
					 SUM(IF(ct_status = '쇼핑',ct_qty, 0)) as ct_status_1,
					 SUM(IF(ct_status = '주문',ct_qty, 0)) as ct_status_2,
					 SUM(IF(ct_status = '입금',ct_qty, 0)) as ct_status_3,
					 SUM(IF(ct_status = '준비',ct_qty, 0)) as ct_status_4,
					 SUM(IF(ct_status = '배송',ct_qty, 0)) as ct_status_5,
					 SUM(IF(ct_status = '완료',ct_qty, 0)) as ct_status_6,
					 SUM(IF(ct_status = '취소',ct_qty, 0)) as ct_status_7,
					 SUM(IF(ct_status = '반품',ct_qty, 0)) as ct_status_8,
					 SUM(IF(ct_status = '품절',ct_qty, 0)) as ct_status_9,
					 SUM(ct_qty) as ct_status_sum
				from {$g5['g5_shop_cart_table']} a, {$g5['g5_shop_item_table']} b ";
	$sql .= " where a.it_id = b.it_id ";
	if ($fr_date && $to_date)
	{
		$fr = preg_replace("/([0-9]{4})([0-9]{2})([0-9]{2})/", "\\1-\\2-\\3", $fr_date);
		$to = preg_replace("/([0-9]{4})([0-9]{2})([0-9]{2})/", "\\1-\\2-\\3", $to_date);
		$sql .= " and ct_time between '$fr 00:00:00' and '$to 23:59:59' ";
	}
	if ($sel_ca_id)
	{
		$sql .= " and b.ca_id like '$sel_ca_id%' ";
	}
	$sql .= " group by a.it_id
			  order by $sort1 $sort2 ";
	$result = sql_query($sql);
	$total_count = sql_num_rows($result);

	$rows = 99999999;
	$total_page  = ceil($total_count / $rows);  // 전체 페이지 계산
	if ($page < 1) { $page = 1; } // 페이지가 없으면 첫 페이지 (1 페이지)
	//$from_record = ($page - 1) * $rows; // 시작 열을 구함

	$rank = ($page - 1) * $rows;

	//$sql = $sql . " limit $from_record, $rows ";
	$result = sql_query($sql);

	//$qstr = 'page='.$page.'&amp;sort1='.$sort1.'&amp;sort2='.$sort2;
	$qstr1 = $qstr.'&amp;fr_date='.$fr_date.'&amp;to_date='.$to_date.'&amp;sel_ca_id='.$sel_ca_id;

	$fname = tempnam(G5_DATA_PATH, "tmp-orderlist.xls");
    $workbook = new writeexcel_workbook($fname);
    $worksheet = $workbook->addworksheet();

	$data = array('순위', '상품명', '쇼핑', '주문', '입금', '준비', '배송', '완료', '취소', '반품', '품절', '합계');
    $data = array_map('iconv_euckr', $data);

	$col = 0;
    foreach($data as $cell) {
        $worksheet->write(0, $col++, $cell);
    }

	for ($i=1; $row=sql_fetch_array($result); $i++)
    {
        $num = $rank + 1;

		$row = array_map('iconv_euckr', $row);

        $worksheet->write($i, 0, $num);
        $worksheet->write($i, 1, $row['it_name']);
        $worksheet->write($i, 2, $row['ct_status_1']);
        $worksheet->write($i, 3, $row['ct_status_2']);
        $worksheet->write($i, 4, $row['ct_status_3']);
        $worksheet->write($i, 5, $row['ct_status_4']);
		$worksheet->write($i, 6, $row['ct_status_5']);
        $worksheet->write($i, 7, $row['ct_status_6']);
        $worksheet->write($i, 8, $row['ct_status_7']);
        $worksheet->write($i, 9, $row['ct_status_8']);
        $worksheet->write($i, 10, $row['ct_status_9']);
        $worksheet->write($i, 11, $row['ct_status_sum']);
    }

	$workbook->close();

	header("Content-Type: application/x-msexcel; name=\"itemsellrank-".$fr_date."-".$to_date.".xls\"");
    header("Content-Disposition: inline; filename=\"itemsellrank-".$fr_date."-".$to_date.".xls\"");
    $fh=fopen($fname, "rb");
    fpassthru($fh);
    unlink($fname);

    exit;
}

elseif ($action == "orderList") {
	$fr_date = $_POST['fr_date'];
	$to_date = $_POST['to_date'];
	$sel_field = $_POST['sel_field'];
	$od_status = $_POST['od_status'];
	$search = $_POST['search'];
	$od_settle_case = $_POST['od_settle_case'];

	//print_r($_POST);
	$od_status = urldecode($od_status);
	$od_settle_case = urldecode($od_settle_case);

	$where = array();

	$doc = strip_tags($doc);
	$sort1 = in_array($sort1, array('od_id', 'od_cart_price', 'od_receipt_price', 'od_cancel_price', 'od_misu', 'od_cash')) ? $sort1 : '';
	$sort2 = in_array($sort2, array('desc', 'asc')) ? $sort2 : 'desc';
	$sel_field = get_search_string($sel_field);
	if( !in_array($sel_field, array('od_id', 'mb_id', 'od_name', 'od_tel', 'od_hp', 'od_b_name', 'od_b_tel', 'od_b_hp', 'od_deposit_name', 'od_invoice')) ){   //검색할 필드 대상이 아니면 값을 제거
		$sel_field = '';
	}
	$od_status = get_search_string($od_status);


	$search = get_search_string($search);
	if(! preg_match("/^[0-9]{4}-(0[1-9]|1[0-2])-(0[1-9]|[1-2][0-9]|3[0-1])$/", $fr_date) ) $fr_date = '';
	if(! preg_match("/^[0-9]{4}-(0[1-9]|1[0-2])-(0[1-9]|[1-2][0-9]|3[0-1])$/", $to_date) ) $to_date = '';

	$od_misu = preg_replace('/[^0-9a-z]/i', '', $od_misu);
	$od_cancel_price = preg_replace('/[^0-9a-z]/i', '', $od_cancel_price);
	$od_refund_price = preg_replace('/[^0-9a-z]/i', '', $od_refund_price);
	$od_receipt_point = preg_replace('/[^0-9a-z]/i', '', $od_receipt_point);
	$od_coupon = preg_replace('/[^0-9a-z]/i', '', $od_coupon); 

	$sql_search = "";
	if ($search != "") {
		if ($sel_field != "") {
			$where[] = " $sel_field like '%$search%' ";
		}

		if ($save_search != $search) {
			$page = 1;
		}
	}

	if ($od_status) {
		switch($od_status) {
			case '전체취소':
				$where[] = " od_status = '취소' ";
				break;
			case '부분취소':
				$where[] = " od_status IN('주문', '입금', '준비', '배송', '완료') and od_cancel_price > 0 ";
				break;
			default:
				$where[] = " od_status = '$od_status' ";
				break;
		}

		switch ($od_status) {
			case '주문' :
				$sort1 = "od_id";
				$sort2 = "desc";
				break;
			case '입금' :   // 결제완료
				$sort1 = "od_receipt_time";
				$sort2 = "desc";
				break;
			case '배송' :   // 배송중
				$sort1 = "od_invoice_time";
				$sort2 = "desc";
				break;
		}
	}

	if ($od_settle_case) {
		$where[] = " od_settle_case = '$od_settle_case' ";
	}

	if ($od_misu) {
		$where[] = " od_misu != 0 ";
	}

	if ($od_cancel_price) {
		$where[] = " od_cancel_price != 0 ";
	}

	if ($od_refund_price) {
		$where[] = " od_refund_price != 0 ";
	}

	if ($od_receipt_point) {
		$where[] = " od_receipt_point != 0 ";
	}

	if ($od_coupon) {
		$where[] = " ( od_cart_coupon > 0 or od_coupon > 0 or od_send_coupon > 0 ) ";
	}

	if ($od_escrow) {
		$where[] = " od_escrow = 1 ";
	}

	if ($fr_date && $to_date) {
		$where[] = " od_time between '$fr_date 00:00:00' and '$to_date 23:59:59' ";
	}

	if ($where) {
		$sql_search = ' where '.implode(' and ', $where);
	}

	if ($sel_field == "")  $sel_field = "od_id";
	if ($sort1 == "") $sort1 = "od_id";
	if ($sort2 == "") $sort2 = "desc";

	$sql_common = " from {$g5['g5_shop_order_table']} $sql_search ";

	$sql = " select count(od_id) as cnt " . $sql_common;
	$row = sql_fetch($sql);
	$total_count = $row['cnt'];

	$rows = $config['cf_page_rows'];
	$total_page  = ceil($total_count / $rows);  // 전체 페이지 계산
	if ($page < 1) { $page = 1; } // 페이지가 없으면 첫 페이지 (1 페이지)
	$from_record = ($page - 1) * $rows; // 시작 열을 구함

	$sql  = " select *,
				(od_cart_coupon + od_coupon + od_send_coupon) as couponprice
			   $sql_common
			   order by $sort1 $sort2";
	$result = sql_query($sql);

	$fname = tempnam(G5_DATA_PATH, "tmp-orderlist.xls");
    $workbook = new writeexcel_workbook($fname);
    $worksheet = $workbook->addworksheet();

	$data = array('주문번호', '주문자', '주문자전화', '받는분', '회원ID', '주문상품수', '누적주문수', '주문합계', '배송비', '입금합계', '주문취소', '쿠폰', '미수금', '주문상태', '결제수단', '포인트사용금액', '운송장번호', '배송일시');
    $data = array_map('iconv_euckr', $data);

	$col = 0;
    foreach($data as $cell) {
        $worksheet->write(0, $col++, $cell);
    }

	for ($i=1; $row=sql_fetch_array($result); $i++)
    {
		$row = array_map('iconv_euckr', $row);

        // 결제 수단
        $s_receipt_way = $s_br = "";
        if ($row['od_settle_case'])
        {
            $s_receipt_way = $row['od_settle_case'];

            // 간편결제
            if($row['od_settle_case'] == '간편결제') {
                switch($row['od_pg']) {
                    case 'lg':
                        $s_receipt_way = 'PAYNOW';
                        break;
                    case 'inicis':
                        $s_receipt_way = iconv_euckr('네이버페이');
                        break;
                    case 'kcp':
                        $s_receipt_way = 'PAYCO';
                        break;
                    default:
                        $s_receipt_way = $row['od_settle_case'];
                        break;
                }
            }
        }
        else
        {
            $s_receipt_way = iconv_euckr('결제수단없음');
        }

        if ($row['od_receipt_point'] > 0)
            $s_receipt_way .= iconv_euckr("포인트");

        $mb_nick = get_text($row['od_name']);

        $od_cnt = 0;
        if ($row['mb_id'])
        {
            $sql2 = " select count(*) as cnt from {$g5['g5_shop_order_table']} where mb_id = '{$row['mb_id']}' ";
            $row2 = sql_fetch($sql2);
            $od_cnt = $row2['cnt'];
        }

        // 주문 번호에 device 표시
        $od_mobile = '';
        if($row['od_mobile'])
            $od_mobile = '(M)';

        // 주문번호에 - 추가
        switch(strlen($row['od_id'])) {
            case 16:
                $disp_od_id = substr($row['od_id'],0,8).'-'.substr($row['od_id'],8);
                break;
            default:
                $disp_od_id = substr($row['od_id'],0,6).'-'.substr($row['od_id'],6);
                break;
        }

        // 주문 번호에 에스크로 표시
        $od_paytype = '';
        if($row['od_test'])
            $od_paytype .= '테스트';

        if($default['de_escrow_use'] && $row['od_escrow'])
            $od_paytype .= '에스크로';

        $uid = md5($row['od_id'].$row['od_time'].$row['od_ip']);

        $invoice_time = is_null_time($row['od_invoice_time']) ? G5_TIME_YMDHIS : $row['od_invoice_time'];
        $delivery_company = $row['od_delivery_company'] ? $row['od_delivery_company'] : $default['de_delivery_company'];

        $bg = 'bg'.($i%2);
        $td_color = 0;
        if($row['od_cancel_price'] > 0) {
            $bg .= 'cancel';
            $td_color = 1;
        }

		if ($row['mb_id']) {
            $mb_id = $row['mb_id'];
        } else {
            $mb_id = "비회원";
        }

        $worksheet->write($i, 0, iconv_euckr($disp_od_id . $od_mobile . $od_paytype));
        $worksheet->write($i, 1, $mb_nick);
        $worksheet->write($i, 2, get_text($row['od_tel']));
        $worksheet->write($i, 3, iconv_euckr(get_text($row['od_b_name'])));
        $worksheet->write($i, 4, iconv_euckr($mb_id));
        $worksheet->write($i, 5, $row['od_cart_count'] .iconv_euckr("건"));
		$worksheet->write($i, 6, $od_cnt .iconv_euckr("건"));
        $worksheet->write($i, 7, number_format($row['od_cart_price'] + $row['od_send_cost'] + $row['od_send_cost2']));
		$worksheet->write($i, 8, number_format($row['od_send_cost']));
        $worksheet->write($i, 8, number_format($row['od_receipt_price']));
        $worksheet->write($i, 9, number_format($row['od_cancel_price']));
        $worksheet->write($i, 10, number_format($row['couponprice']));
        $worksheet->write($i, 11, number_format($row['od_misu']));
		$worksheet->write($i, 12, $row['od_status']);
		$worksheet->write($i, 13, $s_receipt_way);
		$worksheet->write($i, 14, number_format($row['od_receipt_point']));
		$worksheet->write($i, 15, $row['od_invoice']);
		$worksheet->write($i, 16, $row['od_invoice_time']);
    }

	$workbook->close();

	header("Content-Type: application/x-msexcel; name=\"orderlist-". date("YmdHis", time()) .".xls\"");
    header("Content-Disposition: inline; filename=\"orderlist-". date("YmdHis", time()) .".xls\"");
    $fh=fopen($fname, "rb");
    fpassthru($fh);
    unlink($fname);

    exit;

}

elseif ($action == "itemUseList") {
	$sca = $_POST['sca'];
	$sfl = $_POST['sfl'];
	$stx = $_POST['stx'];

	$where = " where is_status = 1 ";
	$sql_search = " ";
	if ($stx != "") {
		if ($sfl != "") {
			$sql_search .= " $where $sfl like '%$stx%' ";
			$where = " and ";
		}
		if ($save_stx != $stx)
			$page = 1;
	}

	if ($sca != "") {
		$sql_search .= " and ca_id like '$sca%' ";
	}

	if ($sfl == "")  $sfl = "a.it_name";
	$sst = "is_id";
    $sod = "desc";

	$sql_common = "  from {$g5['g5_shop_item_use_table']} a
                 left join {$g5['g5_shop_item_table']} b on (a.it_id = b.it_id)
                 left join {$g5['member_table']} c on (a.mb_id = c.mb_id) ";
	$sql_common .= $sql_search;

	// 테이블의 전체 레코드수만 얻음
	$sql = " select count(*) as cnt " . $sql_common;
	$row = sql_fetch($sql);
	$total_count = $row['cnt'];

	$rows = $config['cf_page_rows'];
	$total_page  = ceil($total_count / $rows);  // 전체 페이지 계산
	if ($page < 1) { $page = 1; } // 페이지가 없으면 첫 페이지 (1 페이지)
	$from_record = ($page - 1) * $rows; // 시작 열을 구함

	$sql  = " select *
			  $sql_common
			  order by $sst $sod, is_id desc
			";
	$result = sql_query($sql);

	$fname = tempnam(G5_DATA_PATH, "tmp-itemuselist.xls");
    $workbook = new writeexcel_workbook($fname);
    $worksheet = $workbook->addworksheet();

	$data = array('상품명', '아이디', '이름', '제목', '평점', '확인', '작성일시');
    $data = array_map('iconv_euckr', $data);

	$col = 0;
    foreach($data as $cell) {
        $worksheet->write(0, $col++, $cell);
    }

	
	for ($i=1; $row=sql_fetch_array($result); $i++)
    {
		$col = 0;
		$row = array_map('iconv_euckr', $row);


		$isConfirm = $row['is_confirm'] ? 'Y' : '';

		$worksheet->write($i, $col++, $row['it_name']);
        $worksheet->write($i, $col++, $row['mb_id']);
		$worksheet->write($i, $col++, $row['is_name']);
		$worksheet->write($i, $col++, $row['is_subject']);
		$worksheet->write($i, $col++, $row['is_score']);
		$worksheet->write($i, $col++, $isConfirm);
		$worksheet->write($i, $col++, $row['is_time']);
	}

	$workbook->close();

	header("Content-Type: application/x-msexcel; name=\"itemuselist-". date("YmdHis", time()) .".xls\"");
    header("Content-Disposition: inline; filename=\"itemuselist-". date("YmdHis", time()) .".xls\"");
    $fh=fopen($fname, "rb");
    fpassthru($fh);
    unlink($fname);

    exit;
}

function print_line($save, $i)
{
	global $worksheet;

	$worksheet->write($i, 0, $save['od_date']);
	$worksheet->write($i, 1, number_format($save['ordercount']));
	$worksheet->write($i, 2, number_format($save['orderprice']));
	$worksheet->write($i, 3, number_format($save['ordercoupon']));
	$worksheet->write($i, 4, number_format($save['receiptbank']));
	$worksheet->write($i, 5, number_format($save['receiptvbank']));
	$worksheet->write($i, 6, number_format($save['receiptiche']));
	$worksheet->write($i, 7, number_format($save['receiptcard']));
	$worksheet->write($i, 8, number_format($save['receipthp']));
	$worksheet->write($i, 9, number_format($save['receiptpoint']));
	$worksheet->write($i, 10, number_format($save['ordercancel']));
	$worksheet->write($i, 11, number_format($save['misu']));
}