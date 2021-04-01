<?php
include_once('./_common.php');

// 테마에 orderinquiryview.php 있으면 include
if(defined('G5_THEME_SHOP_PATH')) {
    $theme_inquiryview_file = G5_THEME_MSHOP_PATH.'/orderinquiryview.php';
    if(is_file($theme_inquiryview_file)) {
        include_once($theme_inquiryview_file);
        return;
        unset($theme_inquiryview_file);
    }
}

$g5['title'] = '주문상세내역';
include_once(G5_MSHOP_PATH.'/_head.php');

// LG 현금영수증 JS
if($od['od_pg'] == 'lg') {
    if($default['de_card_test']) {
    echo '<script language="JavaScript" src="http://pgweb.uplus.co.kr:7085/WEB_SERVER/js/receipt_link.js"></script>'.PHP_EOL;
    } else {
        echo '<script language="JavaScript" src="http://pgweb.uplus.co.kr/WEB_SERVER/js/receipt_link.js"></script>'.PHP_EOL;
    }
}
?>


<!--//
주문 => 주문 접수
입금 => 결제 완료
준비 => 상품 준비 중
배송 => 배송 진행 중
완료 => 배송 완료
//-->
<style>
	label.status_label { display:inline-block; text-align:center; color:#FFF; background-color:transparent; padding:2px 15px; }
	label.status_label.labelA { background-color:#fc538e; }
	label.status_label.labelB { background-color:#6bcfa9; }
	label.status_label.labelC { background-color:#b56bcd; }
	label.status_label.labelD { background-color:#fea52b; }
	label.status_label.labelE { background-color:#6892eb; }
	.sod_sts_explan_open { position:relative; cursor:pointer; }
	.sod_sts_explan_open .ic-helper { display:inline-block; width:18px;height:18px; color:#fff; background:#000; border-radius:100px; font-style:normal; margin-left:5px; font-size:12px; padding:1px 3px;}
	#sod_sts_wrap { left:90px; text-align:left; }
	#sod_sts_explan { border:1px solid #e9e9e9; padding:10px; background:#fff; }
	#sod_fin_legend { width:100%; padding:0; border:0; }
	#sod_fin_legend dt { width:90px; float:none; display:inline-block;margin:3px; }
	#sod_fin_legend dd { width:auto; float:none; display:inline-block;margin:3px; }
	#sod_fin_legend dd:after { content:""; display:table; width:100%; clear:both; }
	#sod_sts_wrap label.status_label { width:95px; }
	#sod_sts_explan_close { width:95px; height:30px; font-size:12px; }
</style>


<div id="sod_fin">

    <div id="sod_fin_no">주문번호 <strong><?php echo $od_id; ?></strong></div>

    <section class="sod_fin_list">
        <h2>주문하신 상품</h2>

        <?php
        $st_count1 = $st_count2 = 0;
        $custom_cancel = false;

        $sql = " select it_id, it_name, cp_price, ct_send_cost, it_sc_type
                    from {$g5['g5_shop_cart_table']}
                    where od_id = '$od_id'
                    group by it_id
                    order by ct_id ";
        $result = sql_query($sql);
        ?>
        <ul id="sod_list_inq" class="sod_list">
            <?php
			$totalQty = 0;
			$creteoPushData = "";
			$googlegtaData = "";
			$kakaoData = "";
			$retakuPushData = "";

            for($i=0; $row=sql_fetch_array($result); $i++) {
                $image_width = 65;
                $image_height = 65;
                $image = get_it_image($row['it_id'], 65, 65, '', '', $row['it_name']);

                // 옵션항목
                $sql = " select ct_id, it_name, ct_option, ct_qty, ct_price, ct_point, ct_status, io_type, io_price
                            from {$g5['g5_shop_cart_table']}
                            where od_id = '$od_id'
                              and it_id = '{$row['it_id']}'
                            order by io_type asc, ct_id asc ";
                $res = sql_query($sql);

                // 합계금액 계산
                $sql = " select SUM(IF(io_type = 1, (io_price * ct_qty), ((ct_price + io_price) * ct_qty))) as price,
                                SUM(ct_qty) as qty
                            from {$g5['g5_shop_cart_table']}
                            where it_id = '{$row['it_id']}'
                              and od_id = '$od_id' ";
                $sum = sql_fetch($sql);

                // 배송비
                switch($row['ct_send_cost'])
                {
                    case 1:
                        $ct_send_cost = '착불';
                        break;
                    case 2:
                        $ct_send_cost = '무료';
                        break;
                    default:
                        $ct_send_cost = '선불';
                        break;
                }

				$totalQty += $sum['qty'];
				$sumQty = $sum['qty'];

                // 조건부무료
                if($row['it_sc_type'] == 2) {
                    $sendcost = get_item_sendcost($row['it_id'], $sum['price'], $sum['qty'], $od_id);

                    if($sendcost == 0)
                        $ct_send_cost = '무료';
                }
            ?>
            <li class="sod_li">

                <?php
                    for($k=0; $opt=sql_fetch_array($res); $k++) {
                        if($opt['io_type'])
                            $opt_price = $opt['io_price'];
                        else
                            $opt_price = $opt['ct_price'] + $opt['io_price'];

                        $sell_price = $opt_price * $opt['ct_qty'];
                        $point = $opt['ct_point'] * $opt['ct_qty'];
                ?>

                <div class="li_op_wr">
                    <div class="li_name">
                        <a href="<?php echo shop_item_url($row['it_id']); ?>"><strong><?php echo $row['it_name']; ?></strong></a>
                    </div>
                    <a href="<?php echo shop_item_url($row['it_id']); ?>" class="total_img"><?php echo $image; ?></a>
                    <span class=""><span class="sound_only">상태</span>
					<?php
						switch ($opt['ct_status']) {
							case "주문" : $labelClassName = 'labelA';		$statusLabel = "주문 접수";	break;
							case "입금" : $labelClassName = 'labelB';		$statusLabel = "결제 완료";	break;
							case "준비" : $labelClassName = 'labelC';		$statusLabel = "상품 준비 중";	break;
							case "배송" : $labelClassName = 'labelD';		$statusLabel = "배송 진행 중";	break;
							case "완료" : $labelClassName = 'labelE';		$statusLabel = "배송 완료";	break;
						}
					?>
					<label class="status_label <?php echo $labelClassName; ?>"><?php echo $statusLabel; ?></label>
					</span>

					<div class="review-group">
					<?php
						/* 배송완료 일때만 사용후기 작성 버튼 노출 */
						if ($opt['ct_status'] == '완료') {
							if ($od['od_finish_time']) {
								$writableDay = strtotime($od['od_finish_time']) + 60 * 60 * 24 * 60;  // 배송완료일로부터 60일
								$remainSecond = $writableDay - time();
								$remainDay = intval($remainSecond / (3600 * 24));
							} else {
								$remainDay = 60;
							}

							$isWriteUse = 'N';

							// 작성 가능일 때
							if ($remainDay > 0) {
								// 후기 작성 했는지 체크
								$query = " SELECT count(*) as cnt FROM g5_shop_item_use WHERE it_id = '". $row['it_id'] ."' AND mb_id = '". $member['mb_id'] ."' AND od_id = '". $od_id ."' AND is_status = 1 ";
								$res = sql_fetch($query);
								
								if ($res['cnt'] > 0) {
									$isWriteUse = 'Y';
								}
								
								if ($isWriteUse == 'N') {
									echo "작성만료 D-". $remainDay;
									echo "<br><span><a href=\"/shop/itemuseform.php?it_id=". $row['it_id'] ."&od_id=". $od_id ."\" class=\"btn02 itemuse_form\">후기 쓰기</a></span>";
								} else {
									$query = " SELECT is_score as score, is_confirm FROM g5_shop_item_use WHERE it_id = '". $row['it_id'] ."' AND mb_id = '". $member['mb_id'] ."'  AND od_id = '". $od_id ."' AND is_status = 1 order by is_id desc limit 1 ";
									$res2 = sql_fetch($query);
									$score = (int)$res2['score'];

									if ($res2['is_confirm'] == 0) {
										echo "<span style=\"color:#fff;background-color:red;padding:0 10px;\">노출대기</span> 관리자 검수 후 노출될 예정입니다.";
									} else {
										echo "<span class=\"review-star\">";
										echo "<img src=\"". G5_URL ."/shop/img/s_star". $score .".png\">";
										echo "</span>";
									}
								/*	for ($i = 1; $i <= 5; $i++) {
										if ($i <= $score) {
											echo "★";
										} else {
											echo "☆";
										}
									}
									echo "</span>";
									*/
									//echo "<span>작성완료</span>";
								}
								
							} else {
								echo "<span>작성기간 만료</span>";
							}
						}
					?>
					</div>
                </div>
                <div class="sod_opt"><span class="opt_name"><?php echo get_text($opt['ct_option']); ?></span></div>
                <div class="li_prqty">
                    <span class="prqty_price li_prqty_sp"><span>판매가 </span><?php echo number_format($opt_price); ?></span>
                    <span class="prqty_qty li_prqty_sp"><span>수량 </span><?php echo number_format($opt['ct_qty']); ?></span>
                    <span class="prqty_sc li_prqty_sp"><span>배송비 </span><?php echo $ct_send_cost; ?></span>
                    <span class="total_point li_prqty_sp"><span>적립포인트 </span><?php echo number_format($point); ?></span>

                </div>
                <div class="li_total">
                    <span class="total_price total_span"><span>주문금액 </span><?php echo number_format($sell_price); ?></span>
                </div>
				<?php
					$creteoPushData .= "{id: \"". $row['it_id'] ."\", price: ". $sell_price .", quantity: ". $sumQty ." },";
					$googlegtaData .= "{ \"id\": \"". $row['it_id'] ."\", \"name\": \"".$row['it_name']."\", \"list_name\": \"\", \"brand\": \"니코니코몰\", \"category\":\"\", \"variant\": \"\", \"list_position\": 1, \"quantity\": ". $sumQty .", \"price\" :\"".$sell_price."\" },";
					$kakaoData .= "{name: \"". $row['it_name'] ."\", quantity: \"". $sumQty ."\", price: \"". $sell_price ."\" },";
					if($retakuPushData  == "")
						$retakuPushData = '"'. $row['it_id'].'"';
					else $retakuPushData .= ',"'. $row['it_id'].'"';
				?>
                <?php
                        $tot_point       += $point;

                        $st_count1++;
                        if($opt['ct_status'] == '주문')
                            $st_count2++;
                    }
                ?>

            </li>
            <?php
            }

            // 주문 상품의 상태가 모두 주문이면 고객 취소 가능
            if($st_count1 > 0 && $st_count1 == $st_count2)
                $custom_cancel = true;
            ?>
        </ul>

<style>
	a.dvr_link { color:#ff3061; text-decoration:underline;  }
</style>
		<div class="" style="border:1px solid #e3e5e8;margin:10px;">
		<table>
			<colgroup>
				<col width="100px"/>
				<col width=""/>
			</colgroup>
			<tbody>
				<th>배송조회</th>
				<td style="padding:10px;">
					<?php
						if ($od['od_invoice'] && $od['od_delivery_company']) {
							echo $od['od_delivery_company']; ?> <?php echo get_delivery_inquiry($od['od_delivery_company'], $od['od_invoice'], 'dvr_link');
						} else {
							echo "아직 배송하지 않았거나<br/> 배송정보가 없습니다.";
						}
					?>
				</td>
			</tbody>
		</table>
		</div>

        <div id="sod_sts_wrap">
            <span class="sound_only">상품 상태 설명</span>
            <div id="sod_sts_explan">
                <dl id="sod_fin_legend">
                    <dt><label class="status_label labelA">주문 접수</label></dt>
					<dd>주문이 접수되었습니다.</dd><br/>
					<dt><label class="status_label labelB">결제 완료</label></dt>
					<dd>입금(결제)이 완료 되었습니다.</dd><br/>
					<dt><label class="status_label labelC">상품 준비 중</label></dt>
					<dd>상품 준비 중입니다.</dd><br/>
					<dt><label class="status_label labelD">배송 진행 중</label></dt>
					<dd>상품 배송 중입니다.</dd><br/>
					<dt><label class="status_label labelE">배송 완료</label></dt>
					<dd>상품 배송이 완료 되었습니다.</dd>
                </dl>
            </div>
            <div class="btn_wr"><button type="button" id="sod_sts_explan_open">상태설명보기</button></div>

        </div>

        <?php
        // 총계 = 주문상품금액합계 + 배송비 - 상품할인 - 결제할인 - 배송비할인
        $tot_price = $od['od_cart_price'] + $od['od_send_cost'] + $od['od_send_cost2']
                        - $od['od_cart_coupon'] - $od['od_coupon'] - $od['od_send_coupon']
                        - $od['od_cancel_price'];
        ?>
        <div class="sod_ta_wr">
            <dl id="m_sod_bsk_tot">
                <dt class="sod_bsk_dvr">주문총액</dt>
                <dd class="sod_bsk_dvr"><strong><?php echo number_format($od['od_cart_price']); ?> 원</strong></dd>

                <?php if($od['od_cart_coupon'] > 0) { ?>
                <dt class="sod_bsk_dvr">상품할인</dt>
                <dd class="sod_bsk_dvr"><strong><?php echo number_format($od['od_cart_coupon']); ?> 원</strong></dd>
                <?php } ?>

                <?php if($od['od_coupon'] > 0) { ?>
                <dt class="sod_bsk_dvr">결제할인</dt>
                <dd class="sod_bsk_dvr"><strong><?php echo number_format($od['od_coupon']); ?> 원</strong></dd>
                <?php } ?>

                <?php if ($od['od_send_cost'] > 0) { ?>
                <dt class="sod_bsk_dvr">배송비</dt>
                <dd class="sod_bsk_dvr"><strong><?php echo number_format($od['od_send_cost']); ?> 원</strong></dd>
                <?php } ?>

                <?php if($od['od_send_coupon'] > 0) { ?>
                <dt class="sod_bsk_dvr">배송비할인</dt>
                <dd class="sod_bsk_dvr"><strong><?php echo number_format($od['od_send_coupon']); ?> 원</strong></dd>
                <?php } ?>

                <?php if ($od['od_send_cost2'] > 0) { ?>
                <dt class="sod_bsk_dvr">추가배송비</dt>
                <dd class="sod_bsk_dvr"><strong><?php echo number_format($od['od_send_cost2']); ?> 원</strong></dd>
                <?php } ?>

                <?php if ($od['od_cancel_price'] > 0) { ?>
                <dt class="sod_bsk_dvr">취소금액</dt>
                <dd class="sod_bsk_dvr"><strong><?php echo number_format($od['od_cancel_price']); ?> 원</strong></dd>
                <?php } ?>

                <dt class="sod_bsk_point">적립포인트</dt>
                <dd class="sod_bsk_point"><strong><?php echo number_format($tot_point); ?> 점</strong></dd>

                <dt class="sod_bsk_cnt">총계</dt>
                <dd class="sod_bsk_cnt"><strong><?php echo number_format($tot_price); ?> 원</strong></dd>

            </dl>
        </div>
    </section>

    <div id="sod_fin_view">
        <h2>결제/배송 정보</h2>
        <?php
        $receipt_price = $od['od_receipt_price']
                       + $od['od_receipt_point'];
        $cancel_price = $od['od_cancel_price'];

        $misu = true;
        $misu_price = $tot_price - $receipt_price;

        if ($misu_price == 0 && ($od['od_cart_price'] > $od['od_cancel_price'])) {
            $wanbul = " (완불)";
            $misu = false; // 미수금 없음
        }
        else
        {
            $wanbul = display_price($receipt_price);
        }

        // 결제정보처리
        if($od['od_receipt_price'] > 0)
            $od_receipt_price = display_price($od['od_receipt_price']);
        else
            $od_receipt_price = '아직 입금되지 않았거나 입금정보를 입력하지 못하였습니다.';

        $app_no_subj = '';
        $disp_bank = true;
        $disp_receipt = false;
        $easy_pay_name = '';
        if($od['od_settle_case'] == '신용카드' || $od['od_settle_case'] == 'KAKAOPAY' || is_inicis_order_pay($od['od_settle_case']) ) {
            $app_no_subj = '승인번호';
            $app_no = $od['od_app_no'];
            $disp_bank = false;
            $disp_receipt = true;
        } else if($od['od_settle_case'] == '간편결제') {
            $app_no_subj = '승인번호';
            $app_no = $od['od_app_no'];
            $disp_bank = false;
            switch($od['od_pg']) {
                case 'lg':
                    $easy_pay_name = 'PAYNOW';
                    break;
                case 'inicis':
                    $easy_pay_name = '네이버페이';
                    break;
                case 'kcp':
                    $easy_pay_name = 'PAYCO';
                    break;
                default:
                    break;
            }
        } else if($od['od_settle_case'] == '휴대폰') {
            $app_no_subj = '휴대폰번호';
            $app_no = $od['od_bank_account'];
            $disp_bank = false;
            $disp_receipt = true;
        } else if($od['od_settle_case'] == '가상계좌' || $od['od_settle_case'] == '계좌이체') {
            $app_no_subj = '거래번호';
            $app_no = $od['od_tno'];

			if( function_exists('shop_is_taxsave') && $misu_price == 0 && shop_is_taxsave($od, true) === 2 ){
				$disp_receipt = true;
			}
        }
        ?>

        <section id="sod_fin_pay">
            <h3>결제정보</h3>

            <div  class="odf_tbl">
                <table>
                <tbody>
                <tr>
                    <th scope="row">주문번호</th>
                    <td><?php echo $od_id; ?></td>
                </tr>
                <tr>
                    <th scope="row">주문일시</th>
                    <td><?php echo $od['od_time']; ?></td>
                </tr>
                <tr>
                    <th scope="row">결제방식</th>
                    <td><?php echo ($easy_pay_name ? $easy_pay_name.'('.$od['od_settle_case'].')' : check_pay_name_replace($od['od_settle_case'])); ?></td>
                </tr>
                <tr>
                    <th scope="row">결제금액</th>
                    <td><?php echo $od_receipt_price; ?></td>
                </tr>
                <?php
                if($od['od_receipt_price'] > 0)
                {
                ?>
                <tr>
                    <th scope="row">결제일시</th>
                    <td><?php echo $od['od_receipt_time']; ?></td>
                </tr>
                <?php
                }

                // 승인번호, 휴대폰번호, 거래번호
                if($app_no_subj)
                {
                ?>
                <tr>
                    <th scope="row"><?php echo $app_no_subj; ?></th>
                    <td><?php echo $app_no; ?></td>
                </tr>
                <?php
                }

                // 계좌정보
                if($disp_bank)
                {
                ?>
                <tr>
                    <th scope="row">입금자명</th>
                    <td><?php echo get_text($od['od_deposit_name']); ?></td>
                </tr>
                <tr>
                    <th scope="row">입금계좌</th>
                    <td><?php echo get_text($od['od_bank_account']); ?></td>
                </tr>
                <?php
                }

                if($disp_receipt) {
                ?>
                <tr>
                    <th scope="row">영수증</th>
                    <td>
                        <?php
                        if($od['od_settle_case'] == '휴대폰')
                        {
                            if($od['od_pg'] == 'lg') {
                                require_once G5_SHOP_PATH.'/settle_lg.inc.php';
                                $LGD_TID      = $od['od_tno'];
                                $LGD_MERTKEY  = $config['cf_lg_mert_key'];
                                $LGD_HASHDATA = md5($LGD_MID.$LGD_TID.$LGD_MERTKEY);

                                $hp_receipt_script = 'showReceiptByTID(\''.$LGD_MID.'\', \''.$LGD_TID.'\', \''.$LGD_HASHDATA.'\');';
                            } else if($od['od_pg'] == 'inicis') {
                                $hp_receipt_script = 'window.open(\'https://iniweb.inicis.com/DefaultWebApp/mall/cr/cm/mCmReceipt_head.jsp?noTid='.$od['od_tno'].'&noMethod=1\',\'receipt\',\'width=430,height=700\');';
                            } else {
                                $hp_receipt_script = 'window.open(\''.G5_BILL_RECEIPT_URL.'mcash_bill&tno='.$od['od_tno'].'&order_no='.$od['od_id'].'&trade_mony='.$od['od_receipt_price'].'\', \'winreceipt\', \'width=500,height=690,scrollbars=yes,resizable=yes\');';
                            }
                        ?>
                        <a href="javascript:;" onclick="<?php echo $hp_receipt_script; ?>">영수증 출력</a>
                        <?php
                        }

                        if($od['od_settle_case'] == '신용카드' || is_inicis_order_pay($od['od_settle_case']) || (shop_is_taxsave($od, true) && $misu_price == 0) )
                        {
                            if($od['od_pg'] == 'lg') {
                                require_once G5_SHOP_PATH.'/settle_lg.inc.php';
                                $LGD_TID      = $od['od_tno'];
                                $LGD_MERTKEY  = $config['cf_lg_mert_key'];
                                $LGD_HASHDATA = md5($LGD_MID.$LGD_TID.$LGD_MERTKEY);

                                $card_receipt_script = 'showReceiptByTID(\''.$LGD_MID.'\', \''.$LGD_TID.'\', \''.$LGD_HASHDATA.'\');';
                            } else if($od['od_pg'] == 'inicis') {
                                $card_receipt_script = 'window.open(\'https://iniweb.inicis.com/DefaultWebApp/mall/cr/cm/mCmReceipt_head.jsp?noTid='.$od['od_tno'].'&noMethod=1\',\'receipt\',\'width=430,height=700\');';
                            } else {
                                $card_receipt_script = 'window.open(\''.G5_BILL_RECEIPT_URL.'card_bill&tno='.$od['od_tno'].'&order_no='.$od['od_id'].'&trade_mony='.$od['od_receipt_price'].'\', \'winreceipt\', \'width=470,height=815,scrollbars=yes,resizable=yes\');';
                            }
                        ?>
                        <a href="javascript:;" onclick="<?php echo $card_receipt_script; ?>">영수증 출력</a>
                        <?php
                        }

                        if($od['od_settle_case'] == 'KAKAOPAY')
                        {
                            $card_receipt_script = 'window.open(\'https://mms.cnspay.co.kr/trans/retrieveIssueLoader.do?TID='.$od['od_tno'].'&type=0\', \'popupIssue\', \'toolbar=no,location=no,directories=no,status=yes,menubar=no,scrollbars=yes,resizable=yes,width=420,height=540\');';
                        ?>
                        <a href="javascript:;" onclick="<?php echo $card_receipt_script; ?>">영수증 출력</a>
                        <?php
                        }
                        ?>
                    </td>
                </tr>
                <?php
                }

                if ($od['od_receipt_point'] > 0)
                {
                ?>
                <tr>
                    <th scope="row">포인트사용</th>
                    <td><?php echo display_point($od['od_receipt_point']); ?></td>
                </tr>

                <?php
                }

                if ($od['od_refund_price'] > 0)
                {
                ?>
                <tr>
                    <th scope="row">환불 금액</th>
                    <td><?php echo display_price($od['od_refund_price']); ?></td>
                </tr>
                <?php
                }

                // 현금영수증 발급을 사용하는 경우에만
                if (function_exists('shop_is_taxsave') && shop_is_taxsave($od)) {
                    // 미수금이 없고 현금일 경우에만 현금영수증을 발급 할 수 있습니다.
                    if ($misu_price == 0 && $od['od_receipt_price'] && ($od['od_settle_case'] == '무통장' || $od['od_settle_case'] == '계좌이체' || $od['od_settle_case'] == '가상계좌')) {
                ?>
                <tr>
                    <th scope="row">현금영수증</th>
                    <td>
                    <?php
                    if ($od['od_cash'])
                    {
                        if($od['od_pg'] == 'lg') {
                            require_once G5_SHOP_PATH.'/settle_lg.inc.php';

                            switch($od['od_settle_case']) {
                                case '계좌이체':
                                    $trade_type = 'BANK';
                                    break;
                                case '가상계좌':
                                    $trade_type = 'CAS';
                                    break;
                                default:
                                    $trade_type = 'CR';
                                    break;
                            }
                            $cash_receipt_script = 'javascript:showCashReceipts(\''.$LGD_MID.'\',\''.$od['od_id'].'\',\''.$od['od_casseqno'].'\',\''.$trade_type.'\',\''.$CST_PLATFORM.'\');';
                        } else if($od['od_pg'] == 'inicis') {
                            $cash = unserialize($od['od_cash_info']);
                            $cash_receipt_script = 'window.open(\'https://iniweb.inicis.com/DefaultWebApp/mall/cr/cm/Cash_mCmReceipt.jsp?noTid='.$cash['TID'].'&clpaymethod=22\',\'showreceipt\',\'width=380,height=540,scrollbars=no,resizable=no\');';
                        } else {
                            require_once G5_SHOP_PATH.'/settle_kcp.inc.php';

                            $cash = unserialize($od['od_cash_info']);
                            $cash_receipt_script = 'window.open(\''.G5_CASH_RECEIPT_URL.$default['de_kcp_mid'].'&orderid='.$od_id.'&bill_yn=Y&authno='.$cash['receipt_no'].'\', \'taxsave_receipt\', \'width=360,height=647,scrollbars=0,menus=0\');';
                        }
                    ?>
                        <a href="javascript:;" onclick="<?php echo $cash_receipt_script; ?>">현금영수증 확인하기</a>
                    <?php
                    }
                    else
                    {
                    ?>
                        <a href="javascript:;" onclick="window.open('<?php echo G5_SHOP_URL; ?>/taxsave.php?od_id=<?php echo $od_id; ?>', 'taxsave', 'width=550,height=400,scrollbars=1,menus=0');">현금영수증을 발급하시려면 클릭하십시오.</a>
                    <?php } ?>
                    </td>
                </tr>
                <?php
                    }
                }
                ?>
                </tbody>
                </table>
            </div>
        </section>

        <section id="sod_fin_orderer">
            <h3>주문하신 분</h3>

            <div  class="odf_tbl">
                <table>
           
                <tbody>
                <tr>
                    <th scope="row">이 름</th>
                    <td><?php echo get_text($od['od_name']); ?></td>
                </tr>
                <tr>
                    <th scope="row">전화번호</th>
                    <td><?php echo get_text($od['od_tel']); ?></td>
                </tr>
                <tr>
                    <th scope="row">핸드폰</th>
                    <td><?php echo get_text($od['od_hp']); ?></td>
                </tr>
                <tr>
                    <th scope="row">주 소</th>
                    <td><?php echo get_text(sprintf("(%s%s)", $od['od_zip1'], $od['od_zip2']).' '.print_address($od['od_addr1'], $od['od_addr2'], $od['od_addr3'], $od['od_addr_jibeon'])); ?></td>
                </tr>
                <tr>
                    <th scope="row">E-mail</th>
                    <td><?php echo get_text($od['od_email']); ?></td>
                </tr>
                </tbody>
                </table>
            </div>

        </section>

        <section id="sod_fin_receiver">
            <h3>받으시는 분</h3>

            <div  class="odf_tbl">
                <table>
   
                <tbody>
                <tr>
                    <th scope="row">이 름</th>
                    <td><?php echo get_text($od['od_b_name']); ?></td>
                </tr>
                <tr>
                    <th scope="row">전화번호</th>
                    <td><?php echo get_text($od['od_b_tel']); ?></td>
                </tr>
                <tr>
                    <th scope="row">핸드폰</th>
                    <td><?php echo get_text($od['od_b_hp']); ?></td>
                </tr>
                <tr>
                    <th scope="row">주 소</th>
                    <td><?php echo get_text(sprintf("(%s%s)", $od['od_b_zip1'], $od['od_b_zip2']).' '.print_address($od['od_b_addr1'], $od['od_b_addr2'], $od['od_b_addr3'], $od['od_b_addr_jibeon'])); ?></td>
                </tr>
                <?php
                // 희망배송일을 사용한다면
                if ($default['de_hope_date_use'])
                {
                ?>
                <tr>
                    <th scope="row">희망배송일</th>
                    <td><?php echo substr($od['od_hope_date'],0,10).' ('.get_yoil($od['od_hope_date']).')' ;?></td>
                </tr>
                <?php }
                if ($od['od_memo'])
                {
                ?>
                <tr>
                    <th scope="row">전하실 말씀</th>
                    <td><?php echo conv_content($od['od_memo'], 0); ?></td>
                </tr>
                <?php } ?>
                </tbody>
                </table>
            </div>
        </section>

        <section id="sod_fin_dvr">
            <h3>배송정보</h3>

            <div  class="odf_tbl">
                <table>

                <tbody>
                <?php
                if ($od['od_invoice'] && $od['od_delivery_company'])
                {
                ?>
                <tr>
                    <th scope="row">배송회사</th>
                    <td><?php echo $od['od_delivery_company']; ?> <?php echo get_delivery_inquiry($od['od_delivery_company'], $od['od_invoice'], 'dvr_link'); ?></td>
                </tr>
                <tr>
                    <th scope="row">운송장번호</th>
                    <td><?php echo $od['od_invoice']; ?></td>
                </tr>
                <tr>
                    <th scope="row">배송일시</th>
                    <td><?php echo $od['od_invoice_time']; ?></td>
                </tr>
               <tr>
                    <th scope="row">배송상태</th>
                    <td>
						<?php
							if ($od['od_status'] == '배송') {
						?>
							<label class="status_label labelD">배송 진행 중</label> <!--/* 송장 등록 후 상태값 배송으로 변경시 */-->
						<?php 
							} elseif ($od['od_status'] == '완료') {
						?>
							<label class="status_label labelE">배송 완료</label> <!--/* 상태값 배송 완료로 변경시 */-->
						<?php
							}
						?>
						
						<p style="padding-top:10px;">* 국내 배송 조회는 통관이 정상적으로 진행 된 이후에 조회 가능합니다.</p>
					</td>
                </tr>
                <?php
                }
                else
                {
                ?>
                <tr>
                    <td class="empty_table">아직 배송하지 않았거나 배송정보를 입력하지 못하였습니다.</td>
                </tr>
                <?php
                }
                ?>
                </tbody>
                </table>
            </div>
        </section>
    </div>

    <section id="sod_fin_tot">
        <h2>결제합계</h2>

        <ul>
            <li>
                총 구매액
                <strong><?php echo display_price($tot_price); ?></strong>
            </li>
            <?php
            if ($misu_price > 0) {
            echo '<li>';
            echo '미결제액'.PHP_EOL;
            echo '<strong>'.display_price($misu_price).'</strong>';
            echo '</li>';
            }
            ?>
            <li id="alrdy">
                결제액
                <strong><?php echo $wanbul; ?></strong>
                <?php if( $od['od_receipt_point'] ){    //포인트로 결제한 내용이 있으면 ?>
                <div class="right">
                    <p><span class="title"><i class="fa fa-angle-right" aria-hidden="true"></i> 포인트 결제</span><?php echo number_format($od['od_receipt_point']); ?> 점</p>
                    <p><span class="title"><i class="fa fa-angle-right" aria-hidden="true"></i> 실결제</span><?php echo number_format($od['od_receipt_price']); ?> 원</p>
                </div>
                <?php } ?>
            </li>
        </ul>
    </section>

	<section style="border:1px solid #ddd; padding:10px;margin:0 10px;margin-bottom:10px;">
			취소 문의는 고객센터 전화번호 혹은 카카오톡 채널 [니코니코몰] 1:1 채팅을 통해 문의해 주시기 바랍니다. <br/>(니코니코몰 고객 센터: ☏ 070-4283-6537)
	</section>

    <section id="sod_fin_cancel">
        <h2>주문취소</h2>
        <?php
        // 취소한 내역이 없다면
        if ($cancel_price == 0) {
            if ($custom_cancel) {
        ?>
        <button type="button" onclick="document.getElementById('sod_fin_cancelfrm').style.display='block';">주문 취소하기</button>

        <div id="sod_fin_cancelfrm">
            <form method="post" action="<?php echo G5_SHOP_URL; ?>/orderinquirycancel.php" onsubmit="return fcancel_check(this);">
            <input type="hidden" name="od_id"  value="<?php echo $od['od_id']; ?>">
            <input type="hidden" name="token"  value="<?php echo $token; ?>">

            <label for="cancel_memo" class="sound_only">취소사유</label>
            <input type="text" name="cancel_memo" id="cancel_memo" required class="frm_input required" maxlength="100" placeholder="취소사유">
            <input type="submit" value="확인" class="btn_frmline">

            </form>
        </div>
        <?php
            }
        } else {
        ?>
        <p>주문 취소, 반품, 품절된 내역이 있습니다.</p>
        <?php } ?>
    </section>

     <?php if ($od['od_settle_case'] == '가상계좌' && $od['od_misu'] > 0 && $default['de_card_test'] && $is_admin && $od['od_pg'] == 'kcp') {
    preg_match("/\s{1}([^\s]+)\s?/", $od['od_bank_account'], $matchs);
    $deposit_no = trim($matchs[1]);
    ?>
    <p>관리자가 가상계좌 테스트를 한 경우에만 보입니다.</p>
    <div id="kcp_acc_test" class="odf_tbl">
        <form method="post" action="http://devadmin.kcp.co.kr/Modules/Noti/TEST_Vcnt_Noti_Proc.jsp" target="_blank">
        <table>
        <caption>모의입금처리</caption>

        <tbody>
        <tr>
            <th scope="col"><label for="e_trade_no">KCP 거래번호</label></th>
            <td><input type="text" name="e_trade_no" value="<?php echo $od['od_tno']; ?>"></td>
        </tr>
        <tr>
            <th scope="col"><label for="deposit_no">입금계좌</label></th>
            <td><input type="text" name="deposit_no" value="<?php echo $deposit_no; ?>"></td>
        </tr>
        <tr>
            <th scope="col"><label for="req_name">입금자명</label></th>
            <td><input type="text" name="req_name" value="<?php echo $od['od_deposit_name']; ?>"></td>
        </tr>
        <tr>
            <th scope="col"><label for="noti_url">입금통보 URL</label></th>
            <td><input type="text" name="noti_url" value="<?php echo G5_SHOP_URL; ?>/settle_kcp_common.php"></td>
        </tr>
        </tbody>
        </table>
        <div id="sod_fin_test" class="btn_confirm">
            <input type="submit" value="입금통보 테스트" class="btn_submit">
        </div>
        </form>
    </div>
    <?php } ?>

</div>

<script>
$(function() {
    $("#sod_sts_explan_open").on("click", function() {
        var $explan = $("#sod_sts_explan");
        if($explan.is(":animated"))
            return false;

        if($explan.is(":visible")) {
            $explan.slideUp(200);
            $("#sod_sts_explan_open").text("상태설명보기");
        } else {
            $explan.slideDown(200);
            $("#sod_sts_explan_open").text("상태설명닫기");
        }
    });

    $("#sod_sts_explan_close").on("click", function() {
        var $explan = $("#sod_sts_explan");
        if($explan.is(":animated"))
            return false;

        $explan.slideUp(200);
        $("#sod_sts_explan_open").text("상태설명보기");
    });
});

function fcancel_check(f)
{
    if(!confirm("주문을 정말 취소하시겠습니까?"))
        return false;

    var memo = f.cancel_memo.value;
    if(memo == "") {
        alert("취소사유를 입력해 주십시오.");
        return false;
    }

    return true;
}
</script>


<?php
$fpage = isset($_GET['fpage']) ? $_GET['fpage'] : null;
if ($fpage == 'order') {
?>
<!-- Enliple Tracker v3.6 [결제전환] start -->
<script type="text/javascript">
<!--
function mobConv() {
    var cn = new EN();
    cn.setData("uid", "niconico");
	cn.setData("ordcode", "<?php echo $od_id; ?>"); //옵션(태그 미삽입 시 모비온에서 발급되는 임의의 주문번호가 생성)
    cn.setData("pcode", ""); //옵션
    cn.setData("qty", "<?php echo $totalQty; ?>"); //필수
    cn.setData("price", "<?php echo number_format($tot_price); ?>"); //필수
    cn.setData("pnm", encodeURIComponent(encodeURIComponent(""))); //옵션
    cn.setSSL(true);
    cn.sendConv();
}
//-->
</script>
<script src="https://cdn.megadata.co.kr/js/en_script/3.6/enliple_min3.6.js" defer="defer" onload="mobConv()"></script>
<!-- Enliple Tracker v3.6 [결제전환] end -->
<!-- Criteo 세일즈 태그 -->
<script type="text/javascript" src="//static.criteo.net/js/ld/ld.js" async="true"></script>
<script type="text/javascript">
window.criteo_q = window.criteo_q || [];
var deviceType = /iPad/.test(navigator.userAgent) ? "t" : /Mobile|iP(hone|od)|Android|BlackBerry|IEMobile|Silk/.test(navigator.userAgent) ? "m" : "d";
window.criteo_q.push(
 { event: "setAccount", account: 74645}, // 이 라인은 업데이트하면 안됩니다
 { event: "setEmail", email: "" }, // 유저가 로그인이 안되 있는 경우 빈 문자열을 전달
 { event: "setSiteType", type: deviceType},
 { event: "trackTransaction", id: <?php echo $od_id; ?>, item: [
    <?php echo $creteoPushData; ?>
]}
);
</script>
<!-- END Criteo 세일즈 태그 -->
<!--/ google gtag /-->
<script>
gtag('event', 'purchase', {
	"transaction_id": "<?php echo $od_id; ?>",
	"affiliation": "niconicomall",
	"value": <?php echo $tot_price; ?>,
	"currency": "KRW",
	"tax": 0,
	"shipping": 0,
	"items": [
		<?php echo $googlegtaData; ?>
	]
});
</script>
<script type="text/javascript">
      kakaoPixel('2246260085587358355').purchase({
        total_quantity: "<?php echo $totalQty; ?>", // 주문 내 상품 개수(optional)
        total_price: "<?php echo number_format($tot_price); ?>",  // 주문 총 가격(optional)
        currency: "KRW",     // 주문 가격의 화폐 단위(optional, 기본 값은 KRW)
        products: [         
            <?php echo $kakaoData; ?>
        ]
    });
</script>
<!-- Event snippet for 니코니코몰 구매 conversion page -->
<script>  
	gtag('event', 'conversion', {      
		'send_to': 'AW-617109738/bE2JCIbVw90BEOqxoaYC',      
		'value': <?php echo $tot_price; ?>,      
		'currency': 'KRW',      
		'transaction_id': '<?php echo $od_id; ?>'  
	});
</script>

<!-- Retaku script Start 삭제시 주의하세요-->
<script type = "text/javascript" >
rtq ( "pixel" , "ordered" ,{
"item_id" :window.rtk_item_id,
"value" : "<?php echo $tot_price; ?>" ,
"currency" : "KRW" ,
"content_ids" : [<?php echo $retakuPushData; ?>] ,
"order_number":"<?php echo $od_id; ?>",
"content_type" : "product"
});
</script>
<!--Retaku script End-->

<?php
}
?>

<?php
include_once(G5_MSHOP_PATH.'/_tail.php');
?>