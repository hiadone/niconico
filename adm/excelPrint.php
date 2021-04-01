<?php
$sub_menu = '500120';
include_once('./_common.php');


include_once(G5_LIB_PATH.'/Excel/php_writeexcel/class.writeexcel_workbook.inc.php');
include_once(G5_LIB_PATH.'/Excel/php_writeexcel/class.writeexcel_worksheet.inc.php');

$action = isset($_POST['action']) ? $_POST['action'] : null;
if ($action == "memberList") {

	$fname = tempnam(G5_DATA_PATH, "tmp-memberlist.xls");
    $workbook = new writeexcel_workbook($fname);
    $worksheet = $workbook->addworksheet();

	$data = array('아이디', '이름', '영문명', '생년월일', '성별', '본인확인', '메일인증', 'SMS수신', '메일수신', '메일주소', '정보공개', '성인인증', '회원등급', '누적 주문건수', '총 결제액', '배송비 제외 결제금액', '포인트', '휴대폰', '전화번호', '최종접속', '가입일', '우편번호', '기본주소', '상세주소', '참고항목', '영문주소');
    $data = array_map('iconv_euckr', $data);

	$col = 0;
    foreach($data as $cell) {
        $worksheet->write(0, $col++, $cell);
    }

	$sql  = " select * from {$g5['member_table']} where mb_leave_date = '' ";
	$result = sql_query($sql);

	for ($i=1; $row=sql_fetch_array($result); $i++){
		$row = array_map('iconv_euckr', $row);

		// 성별
		$gender = $row['mb_2'] == 'f' ? '여' : '남';
		
		// 본인확인방법
		switch($row['mb_certify']) {
			case 'hp':
				$mb_certify_case = '휴대폰';
				$mb_certify_val = 'hp';
				break;
			case 'ipin':
				$mb_certify_case = '아이핀';
				$mb_certify_val = 'ipin';
				break;
			case 'admin':
				$mb_certify_case = '관리자 수정';
				$mb_certify_val = 'admin';
				break;
			default:
				$mb_certify_case = '';
				$mb_certify_val = 'admin';
				break;
		}

		// 메일인증
		$mb_email_certify = preg_match('/[1-9]/', $row['mb_email_certify'])?'Yes':'No';

		$mb_sms = $row['mb_sms'] ? '동의' : '비동의';
		$mb_mailling = $row['mb_mailling'] ? '동의' : '비동의';
		$mb_open = $row['mb_open'] ? '예' : '아니오';
		$mb_adult = $row['mb_adult'] ? '예' : '아니오';
		
		// 주문관련정보
		$sql = " SELECT * FROM {$g5['g5_shop_order_table']} WHERE mb_id = '". $row['mb_id'] ."' ";
		$result2 = sql_query($sql);
		$odCnt = sql_num_rows($result2);
		$totalPayPrice = 0;
		$totalExceptDeliveryPrice = 0;
		$totalUsePoint = 0;
		for ($j=0; $row2=sql_fetch_array($result2); $j++) {
			$totalPayPrice += $row2['od_receipt_price'];
			$realPayPrice = $row2['od_receipt_price'] - $row2['od_send_cost'];
			$totalExceptDeliveryPrice += $realPayPrice;
			$totalUsePoint = $row2['od_receipt_point'];
		}

		$col = 0;
		$worksheet->write($i, $col++, $row['mb_id']);
		$worksheet->write($i, $col++, $row['mb_name']);
		$worksheet->write($i, $col++, $row['mb_name_en']);
		$worksheet->write($i, $col++, $row['mb_1']);
		$worksheet->write($i, $col++, iconv_euckr($gender));
		$worksheet->write($i, $col++, iconv_euckr($mb_certify_case));
		$worksheet->write($i, $col++, $mb_email_certify);
		$worksheet->write($i, $col++, iconv_euckr($mb_sms));
		$worksheet->write($i, $col++, iconv_euckr($mb_mailling));
		$worksheet->write($i, $col++, $row['mb_email']);
		$worksheet->write($i, $col++, iconv_euckr($mb_open));
		$worksheet->write($i, $col++, iconv_euckr($mb_adult));
		$worksheet->write($i, $col++, $memberLevel[$row['mb_level']]);
		$worksheet->write($i, $col++, $odCnt);
		$worksheet->write($i, $col++, $totalPayPrice);
		$worksheet->write($i, $col++, $totalExceptDeliveryPrice);
		$worksheet->write($i, $col++, $totalUsePoint);
		$worksheet->write($i, $col++, $row['mb_hp']);
		$worksheet->write($i, $col++, $row['mb_tel']);
		$worksheet->write($i, $col++, $row['mb_today_login']);
		$worksheet->write($i, $col++, $row['mb_datetime']);
		$worksheet->write($i, $col++, $row['mb_zip1'] . $row['mb_zip2']);
		$worksheet->write($i, $col++, $row['mb_addr1']);
		$worksheet->write($i, $col++, $row['mb_addr2']);
		$worksheet->write($i, $col++, $row['mb_addr3']);
		$worksheet->write($i, $col++, $row['mb_addr_eng'] . $row['mb_addr_eng2']);

	}

	$workbook->close();

	header("Content-Type: application/x-msexcel; name=\"memberlist-". date("YmdHis", time()) .".xls\"");
    header("Content-Disposition: inline; filename=\"memberlist-". date("YmdHis", time()) .".xls\"");
    $fh=fopen($fname, "rb");
    fpassthru($fh);
    unlink($fname);

    exit;

}
?>