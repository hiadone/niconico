<?php
include_once('./_common.php');

// 테마에 cart.php 있으면 include
if(defined('G5_THEME_MSHOP_PATH')) {
    $theme_cart_file = G5_THEME_MSHOP_PATH.'/cart.php';
    if(is_file($theme_cart_file)) {
        include_once($theme_cart_file);
        return;
        unset($theme_cart_file);
    }
}

$g5['title'] = '장바구니';
include_once(G5_MSHOP_PATH.'/_head.php');

// $s_cart_id 로 현재 장바구니 자료 쿼리
$sql = " select a.ct_id,
                a.it_id,
                a.it_name,
                a.ct_price,
                a.ct_point,
                a.ct_qty,
                a.ct_status,
                a.ct_send_cost,
                a.it_sc_type,
                b.ca_id,
				b.it_weight,
				b.it_cust_price,
				b.it_useEvent,
				b.it_use,
				b.it_eventEndDate
           from {$g5['g5_shop_cart_table']} a left join {$g5['g5_shop_item_table']} b on ( a.it_id = b.it_id )
          where a.od_id = '$s_cart_id' ";
$sql .= " group by a.it_id ";
//$sql .= " order by a.ct_id ";
$sql .= " order by b.it_id asc ";
$result = sql_query($sql);

$cart_count = sql_num_rows($result);
?>

<script src="<?php echo G5_JS_URL; ?>/shop.js"></script>
<script src="<?php echo G5_JS_URL; ?>/shop.override.js"></script>

<input type="hidden" id="cate40LimitCnt" value="<?php echo (int)$default['de_cate40LimitCnt']; ?>">

<div id="sod_bsk">

    <form name="frmcartlist" id="sod_bsk_list" class="2017_renewal_itemform" method="post" action="<?php echo $cart_action_url; ?>">

    <?php if($cart_count) { ?>
    <div id="sod_chk" class="chk_box">
        <input type="checkbox" name="ct_all" value="1" id="ct_all" class="selec_chk" checked>
        <label for="ct_all"><span></span>상품 전체</label>
    </div>
    <?php } ?>

    <ul class="sod_list">
        <?php
        $tot_point = 0;
        $tot_sell_price = 0;
        $it_send_cost = 0;
		$cate40Qty = 0;
		$totalQty = 0;
		$creteoPushData = "";
		$discountPrice = 0;
		$retakuPushData = "";

        for ($i=0; $row=sql_fetch_array($result); $i++)
        {
            // 합계금액 계산
            $sql = " select SUM(IF(io_type = 1, (io_price * ct_qty), ((ct_price + io_price) * ct_qty))) as price,
                            SUM(ct_point * ct_qty) as point,
                            SUM(ct_qty) as qty
                        from {$g5['g5_shop_cart_table']}
                        where it_id = '{$row['it_id']}'
                          and od_id = '$s_cart_id' ";
            $sum = sql_fetch($sql);

            if ($i==0) { // 계속쇼핑
                $continue_ca_id = $row['ca_id'];
				$firstItemName = stripslashes($row['it_name']);
				$firstItemCode = $row['it_id'];
            }

            $a1 = '<a href="'.shop_item_url($row['it_id']).'"><strong>';
            $a2 = '</strong></a>';
            $image_width = 65;
            $image_height = 65;
            $image = get_it_image($row['it_id'], $image_width, $image_height);

            $it_name = $a1 . stripslashes($row['it_name']) . $a2;
            $it_options = print_item_options($row['it_id'], $s_cart_id);
            if($it_options) {
                $mod_options = '<button type="button" id="mod_opt_'.$row['it_id'].'" class="mod_btn mod_options">선택사항수정</button>';
               // $it_name .= ;
            }

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

			// 의약품은 6개 넘으면 분할해서 보여준다
			if ($row['ca_id'] == 40) {
				$cate40Qty += $sum['qty'];
				$maxDeliveryDegree = ceil($cate40Qty / 6);
			}

            // 조건부무료
            if($row['it_sc_type'] == 2) {
                $sendcost = get_item_sendcost($row['it_id'], $sum['price'], $sum['qty'], $s_cart_id);

                if($sendcost == 0)
                    $ct_send_cost = '무료';
            }

            $point      = $sum['point'];
            $sell_price = $sum['price'];

			// 무게는 수량 * 개별무게
			$tWeight = $row['it_weight'] * $sum['qty'];
			$sumQty = $sum['qty'];
			$totalQty += $sum['qty'];

			$creteoPushData .= "{id: \"". $row['it_id'] ."\", price: ". $sell_price .", quantity: ". $sumQty ." },";
			if($retakuPushData  == "")
				$retakuPushData = '"'. $row['it_id'].'"';
			else $retakuPushData .= ',"'. $row['it_id'].'"';

			if ($row['it_useEvent'] == 1) {
				if ($row['it_eventEndDate'] < time()) {
					$trClass = "disable";
				}
				$discountPrice = $row['it_cust_price'] - $row['ct_price'];
			}
        ?>

<!-- /* 구매불가 상품 스타일 */ -->
<style>
	#sod_bsk_list .disable {
		text-decoration: line-through;
		background-color:#f2f2f2;
		opacity: 0.5;
	}
</style>
        <li class="sod_li <?php echo $trClass; ?>">
            <input type="hidden" name="it_id[<?php echo $i; ?>]"    value="<?php echo $row['it_id']; ?>">
            <input type="hidden" name="it_name[<?php echo $i; ?>]"  value="<?php echo get_text($row['it_name']); ?>">
			<input type="hidden" class="it_cate" value="<?php echo $row['ca_id']; ?>">
			<input type="hidden" class="it_qty" value="<?php echo $sumQty; ?>">
			<input type="hidden" class="it_price" value="<?php echo $sell_price; ?>">
			<input type="hidden" class="it_weight" value="<?php echo $tWeight; ?>">
			<input type="hidden" class="it_trClass" value="<?php echo $trClass; ?>">

            <div class="li_op_wr">
                <div class="li_chk chk_box">
                    <input type="checkbox" name="ct_chk[<?php echo $i; ?>]" value="1" id="ct_chk_<?php echo $i; ?>" class="selec_chk" checked>
                    <label for="ct_chk_<?php echo $i; ?>"><span></span><b class="sound_only">상품선택</b></label>
                </div> 
                <div class="li_name"><?php echo $it_name; ?></div>
                <div class="total_img"><?php echo $image; ?></div>
                <div class="li_mod"><?php echo $mod_options; ?></div>
            </div> 
            <div class="sod_opt"><?php echo $it_options; ?></div>
            <div class="li_prqty">
                <span class="prqty_price li_prqty_sp"><span class="prqty_price li_prqty_sp"><span>판매가 </span>
				<?php
					if ($row['it_useEvent'] == 1) {
						echo "<strike>". number_format($row['it_cust_price']) ."</strike> &nbsp; "; 
					}
					echo number_format($row['ct_price']); ?></span>
                <span class="prqty_qty li_prqty_sp"><span>수량 </span><?php echo number_format($sum['qty']); ?></span>
                <span class="prqty_sc li_prqty_sp"><span>배송비 </span><?php echo $ct_send_cost; ?></span>
                <span class="total_point li_prqty_sp"><span>적립포인트 </span><strong><?php echo number_format($sum['point']); ?></strong></span>
            </div>
             <div class="total_price total_span"><span>소계 </span><strong><?php echo number_format($sell_price); ?></strong>원</div>
        </li>

        <?php
            $tot_point      += $point;
            $tot_sell_price += $sell_price;
			$tot_weight		+= $tWeight;
        } // for 끝

        if ($i == 0) {
            echo '<li class="empty_list">장바구니에 담긴 상품이 없습니다.</li>';
        } else {
            // 배송비 계산
            //$send_cost = get_sendcost($s_cart_id, 0);
			$send_cost = getDeliveryCost($tot_weight);
        }
        ?>
    </ul>

    <div class="btn_del_wr">
        <button type="button" onclick="return form_check('seldelete');" class="btn01">선택삭제</button>
        <button type="button" onclick="return form_check('alldelete');" class="btn01">비우기</button>
    </div>

	<input type="hidden" id="cate40Qty" value="<?php echo $cate40Qty; ?>">

    <?php if ($i == 0) { ?>
    <div class="go_shopping"><a href="<?php echo G5_SHOP_URL; ?>/" class="btn01">쇼핑 계속하기</a></div>
    <?php } else { ?>
    <div class="sod_ta_wr">
    <?php
    $tot_price = $tot_sell_price + $send_cost; // 총계 = 주문상품금액합계 + 배송비
    if ($tot_price > 0 || $send_cost > 0) {
    ?>
    <dl id="m_sod_bsk_tot">
        
        <?php if ($tot_price > 0) { ?>
        <dt>제품 가격</dt>
        <dd><strong id="tot_sell_price"><?php echo number_format($tot_sell_price); ?> 원</strong></dd>
		<dt>총 무게</dt>
        <dd><strong id="tot_sell_weight"><?php echo number_format($tot_weight); ?> g</strong></dd>
        <dt class="sod_bsk_dvr">배송비</dt>
        <dd class="sod_bsk_dvr"><strong id="tot_sell_sendCost"><?php echo number_format($send_cost); ?> 원</strong></dd>
        <dt class="sod_bsk_cnt">총계</dt>
        <dd class="sod_bsk_cnt"><strong id="total_price"><?php echo number_format($tot_price); ?></strong> 원</dd>
        <?php } ?>
    </dl>
    <?php } ?>

    <div id="sod_bsk_act" class="btn_confirm">
        <div class="total">총계 <strong class="total_cnt" id="total_price2"><?php echo number_format($tot_price); ?>원</strong>
        </div>
        <input type="hidden" name="url" value="<?php echo G5_SHOP_URL; ?>/orderform.php">
        <input type="hidden" name="act" value="">
        <input type="hidden" name="records" value="<?php echo $i; ?>">
        <button type="button" onclick="return form_check('buy');" class="btn_submit">주문하기</button>
    </div>
    <?php } ?>
        <?php if ($naverpay_button_js) { ?>
        <div class="naverpay-cart"><?php echo $naverpay_request_js.$naverpay_button_js; ?></div>
        <?php } ?>
    </div>
    </form>
</div>

<!-- 팝업뜰때 배경 -->
<div id="mask"></div>

<!--Popup Start -->
<div id="layerbox" class="layerpop">
	<article class="layerpop_area">
		<div class="title">주문하기 안내</div>
		<a href="javascript:popupClose();" class="layerpop_close" id="layerbox_close"><i class="fa fa-times" aria-hidden="true"></i></a> <br>
		<div class="content">
			1회 통관 시 배송비 제외 상품금액 150$ (한화 17만원)이내에서 면세입니다.
			<br/><span class="txt_done" style="font-weight:bold;font-size:1.083em">※ 이를 초과할 시에는 추가 관세가 발생할 수 있습니다 ※</span>
            <br/>
            <br/>의약품은 관세법상 통관 기준인 1인당 6개까지 구매하실 수 있습니다.
            <br/>의약품 카테고리 상품을 6개 이상 주문한 경우에는
            <br/>니코니코몰 카톡 상당창 또는 고객센터로 알려주시면 처리해드립니다.
			<br/>
			<br/>
			<button id="goPaymentPageBtn" class="sec1">결제 계속하기</button>
			<button onclick="popupClose();" class="sec2">장바구니로 돌아가기</button>
		</div>
	</article>
</div>

<div id="layerbox3" class="layerpop">
    <article class="layerpop_area">
        <div class="title">주문하기 안내</div>
        <a href="javascript:popupClose3();" class="layerpop_close" id="layerbox_close"><i class="fa fa-times" aria-hidden="true"></i></a> <br>
        <div class="content">
            의약품은 관세법상 통관 기준인 1인당 6개까지 구매하실 수 있습니다.
            <br/>의약품 카테고리 상품을 6개 이상 주문한 경우에는
            <br/>니코니코몰 카톡 상당창 또는 고객센터로 알려주시면 처리해드립니다.
            <br/>
            <br/>
            <button id="goPaymentPageBtn3" class="sec1">결제 계속하기</button>
            <button onclick="popupClose3();" class="sec2">장바구니로 돌아가기</button>
        </div>
    </article>
</div>
<!--Popup End -->

<style>
/*-- POPUP common style S ======================================================================================================================== --*/
#mask {
    position: fixed;
    left: 0;
    top: 0;
	right:0;
	bottom:0;
	width:100%;
	height:100%;
    z-index: 999;
    background-color: #000000;
    display: none; }

.layerpop {
    display: none;
	width:100%;
	height:300px !important;
    z-index: 1000;
	position:absolute;
    cursor: move; 
	top:50%;
	left:50%;
	-webkit-transform:  translateY(-50%)  translateX(-50%) !important;
    -moz-transform:  translateY(-50%)  translateX(-50%) !important;
    -ms-transform:  translateY(-50%)  translateX(-50%) !important;
    -o-transform:  translateY(-50%)  translateX(-50%) !important;
	transform:  translateY(-50%)  translateX(-50%) !important;
	padding:10px;
}
.layerpop_area {
	background-color:#fff;
}
.layerpop_area .title {
    padding: 10px 10px 10px 10px;
    border: 0px solid #aaaaaa;
    background: #f1f1f1;
    color: #2954cf;
    font-size: 1.3em;
    font-weight: bold;
    line-height: 24px; }

.layerpop_area .layerpop_close {
    width: 25px;
    height: 25px;
    display: block;
    position: absolute;
	font-size:28px;
    top: 9px;
    right: 24px;
    /*background: transparent url('btn_exit_off.png') no-repeat;*/ }

.layerpop_area .layerpop_close:hover {
    /*background: transparent url('btn_exit_on.png') no-repeat;*/
    cursor: pointer; }

.layerpop_area .content {
    width: 96%;    
    color: #000; 
	font-size:14px;
	text-align:center;
	background-color:#fff;
	padding-bottom:20px;
}
.layerpop_area .content .sec1 {
	width:160px;
	border: 1px solid #06961e;
    background: #06961e;
    color: #fff;
    cursor: pointer;
    border-radius: 3px;
	padding: 7px;
}
.layerpop_area .content .sec2 {
	display: inline-block;
	width:160px;
    padding: 7px;
    border: 1px solid #bababa;
    border-radius: 3px;
    background: #fff;
    color: #717171;
    text-decoration: none;
    vertical-align: middle;
}
/*-- POPUP common style E --*/
/* 구매불가 상품 스타일 */
#sod_bsk_list .disable {
	text-decoration: line-through;
	background-color:#f2f2f2;
	opacity: 0.5;
}

</style>

<script>
$(function() {
    var close_btn_idx;

    // 선택사항수정
    $(".mod_options").click(function() {
        var it_id = $(this).attr("id").replace("mod_opt_", "");
        var $this = $(this);
        close_btn_idx = $(".mod_options").index($(this));

        $.post(
            "./cartoption.php",
            { it_id: it_id },
            function(data) {
                $("#mod_option_frm").remove();
                $this.after("<div id=\"mod_option_frm\"></div><div class=\"mod_option_bg\"></div>");
                $("#mod_option_frm").html(data);
                price_calculate();
            }
        );
    });

    // 모두선택
    $("input[name=ct_all]").click(function() {
        if($(this).is(":checked"))
            $("input[name^=ct_chk]").attr("checked", true);
        else
            $("input[name^=ct_chk]").attr("checked", false);
    });

    // 옵션수정 닫기
    $(document).on("click", "#mod_option_close", function() {
        $("#mod_option_frm, .mod_option_bg").remove();
        $("#win_mask, .window").hide();
        $(".mod_options").eq(close_btn_idx).focus();
    });
    $("#win_mask").click(function () {
        $("#mod_option_frm").remove();
        $("#win_mask").hide();
        $(".mod_options").eq(close_btn_idx).focus();
    });

	$("#goPaymentPageBtn").click(function(){
		var f = document.frmcartlist;
		f.act.value = 'buy';
		f.submit();
	});

    $("#goPaymentPageBtn3").click(function(){
        var f = document.frmcartlist;
        f.act.value = 'buy';
        f.submit();
    });

	var getDeliveryCost = function(w) {
		if (w == 0)
		{
			dc = 0;
		} else if (w > 0 && w <= 1) {
			dc = 500;
		} else if (w > 1 && w <= 500) {
			dc = 8500;
		} else if (w > 500 && w <= 1000) {
			dc = 11000;
		} else if (w > 1000 && w <= 1500) {
			dc = 12000;
		} else if (w > 1500 && w <= 2000) {
			dc = 13500;
		} else if (w > 2000 && w <= 2500) {
			dc = 15000;
		} else if (w > 2500 && w <= 3000) {
			dc = 17000;
		} else if (w > 3000 && w <= 3500) {
			dc = 18500;
		} else if (w > 3500 && w <= 4000) {
			dc = 21000;
		} else if (w > 4000 && w <= 4500) {
			dc = 22500;
		} else if (w > 4500 && w <= 5000) {
			dc = 25500;
		} else if (w > 5000 && w <= 5500) {
			dc = 26500;
		} else if (w > 5500 && w <= 6000) {
			dc = 28500;
		} else if (w > 6000 && w <= 6500) {
			dc = 31500;
		} else if (w > 6500 && w <= 7000) {
			dc = 32500;
		} else if (w > 7000 && w <= 7500) {
			dc = 33500;
		} else if (w > 7500 && w <= 8000) {
			dc = 35500;
		} else if (w > 8000 && w <= 8500) {
			dc = 37500;
		} else if (w > 8500 && w <= 9000) {
			dc = 39500;
		} else if (w > 9000 && w <= 9500) {
			dc = 41500;
		} else if (w > 9500 && w <= 10000) {
			dc = 43500;
		} else if (w > 10000 && w <= 11000) {
			dc = 47000;
		} else if (w > 11000 && w <= 12000) {
			dc = 51000;
		} else if (w > 12000 && w <= 13000) {
			dc = 54000;
		} else if (w > 13000 && w <= 14000) {
			dc = 58000;
		} else {
			dc = 58000;
		}
		return dc;
	};
	
	var calcTotalPrice = function(){
		var sellPrice = 0;
		var sellWeight = 0;
		$(".sod_list .selec_chk").each(function(idx){
			if ($(this).prop('checked') == true)
			{
				sellPrice += parseInt($(".it_price").eq(idx).val());
				sellWeight += parseInt($(".it_weight").eq(idx).val());
			}
		});	

		totalSendCost = getDeliveryCost(sellWeight);
		totalPrice = parseInt(parseInt(sellPrice) + parseInt(totalSendCost));

		$("#tot_sell_price").html(numberWithCommas(sellPrice) +" 원");
		$("#tot_sell_weight").html(numberWithCommas(sellWeight) +" g");
		$("#tot_sell_sendCost").html(numberWithCommas(totalSendCost) +" 원");
		$("#total_price").html(numberWithCommas(totalPrice));
		$("#total_price2").html(numberWithCommas(totalPrice)+"원");
	};
	
	$(".sod_list .selec_chk").click(function(){
		calcTotalPrice();
	});

});

function fsubmit_check(f) {
    if($("input[name^=ct_chk]:checked").length < 1) {
        alert("구매하실 상품을 하나이상 선택해 주십시오.");
        return false;
    }

    return true;
}

function form_check(act) {
    var f = document.frmcartlist;
    var cnt = f.records.value;

    if (act == "buy")
    {
		var buyFlag = true;
		$(".sod_list .selec_chk").each(function(idx){
			if ($(this).prop('checked') == true && $(".it_trClass").eq(idx).val() == 'disable')
			{
				buyFlag = false;
			}
		});

		if (buyFlag == false)
		{
			alert("이벤트 기간이 종료된 상품이 있습니다.");
			return false;
		}
		
		var cate40Qty = 0;
		$cateArr = $(".it_cate");
		$(".sod_list .selec_chk").each(function(idx){
			if ($(this).prop('checked') == true && $cateArr.eq(idx).val() == 40) {			
				cate40Qty += parseInt($(".it_qty").eq(idx).val());
			}
		});

		//console.log(cate40Qty);
		
		
		if ($("#cate40LimitCnt").val() > 0 && cate40Qty > $("#cate40LimitCnt").val())
		{
			alert("의약품은 통관 시 1회에 최대 "+ $("#cate40LimitCnt").val() +"개까지 통관이 가능합니다.\n의약품 구매 수량을 조정해주세요.");
			return false;

		} else {
			var sellPrice = 0;
			$(".sod_list .selec_chk").each(function(idx){
				if ($(this).prop('checked') == true)
				{
					sellPrice += parseInt($(".it_price").eq(idx).val());
				}
				
			});

			//console.log(sellPrice);

			if (sellPrice > 170000)
			{
				goDetail();
			} else {
                goDetail3();
				// f.act.value = act;
				// f.submit();
			}
		}
    }
    else if (act == "alldelete")
    {
        f.act.value = act;
        f.submit();
    }
    else if (act == "seldelete")
    {
        if($("input[name^=ct_chk]:checked").length < 1) {
            alert("삭제하실 상품을 하나이상 선택해 주십시오.");
            return false;
        }

        f.act.value = act;
        f.submit();
    }

    return true;
}

function wrapWindowByMask() {
	//화면의 높이와 너비를 구한다.
	var maskHeight = $(document).height(); 
	var maskWidth = $(window).width();

	//문서영역의 크기 
	console.log( "document 사이즈:"+ $(document).width() + "*" + $(document).height()); 
	//브라우저에서 문서가 보여지는 영역의 크기
	console.log( "window 사이즈:"+ $(window).width() + "*" + $(window).height());        

	//마스크의 높이와 너비를 화면 것으로 만들어 전체 화면을 채운다.
	$('#mask').css({
		'width' : maskWidth,
		'height' : maskHeight
	});

	//애니메이션 효과
	//$('#mask').fadeIn(1000);      
	$('#mask').fadeTo("slow", 0.5);
}

function popupOpen() {
	$('.layerpop').css("position", "absolute");
	//영역 가운에데 레이어를 뛰우기 위해 위치 계산 
	$('.layerpop').css("top",(($(window).height() - $('.layerpop').outerHeight())) + $(window).scrollTop());
    
	//$('.layerpop').draggable();
	$('#layerbox').show();
}

function popupClose() {
	$('#layerbox').hide();
	$('#mask').hide();
}

function goDetail() {

	/*팝업 오픈전 별도의 작업이 있을경우 구현*/ 

	popupOpen(); //레이어 팝업창 오픈 
	wrapWindowByMask(); //화면 마스크 효과 
}

function popupOpen3() {
    $('.layerpop').css("position", "absolute");
    //영역 가운에데 레이어를 뛰우기 위해 위치 계산 
    $('.layerpop').css("top",(($(window).height() - $('.layerpop').outerHeight())) + $(window).scrollTop());
    // $('.layerpop').css("left",(($(window).width() - $('.layerpop').outerWidth()) / 2) + $(window).scrollLeft());
    //$('.layerpop').draggable();
    $('#layerbox3').show();
}

function popupClose3() {
    $('#layerbox3').hide();
    $('#mask').hide();
}

function goDetail3() {

    /*팝업 오픈전 별도의 작업이 있을경우 구현*/ 

    popupOpen3(); //레이어 팝업창 오픈 
    wrapWindowByMask(); //화면 마스크 효과 
}

function numberWithCommas(x) {
	return x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
}

function removeComma(str) {
	str = String(str);
	return str.replace(/[^\d]+/g, '');
}
</script>

<?php
if (isset($firstItemCode)) {
?>

<!-- Enliple Shop Log Tracker v3.6 start -->
<script type="text/javascript">
	<!--
		function mobCart() {
		var sh = new EN();
		sh.setData("uid", "niconico");
		sh.setData("pcode", "<?php echo $firstItemCode; ?>"); // 옵션
		sh.setData("qty", "<?php echo $totalQty; ?>");
		sh.setData("price", "<?php echo number_format($tot_price); ?>");
		sh.setData("pnm", encodeURIComponent(encodeURIComponent("<?php echo $firstItemName; ?>")));
		sh.setSSL(true);
	}
	//-->
</script>
<script src="https://cdn.megadata.co.kr/js/en_script/3.6/enliple_min3.6.js" defer="defer" onload="mobCart()"></script>
<!-- Enliple Shop Log Tracker v3.6 end  -->

<?php
}
?>

<!-- Criteo 장바구니 태그 -->
<script type="text/javascript" src="//static.criteo.net/js/ld/ld.js" async="true"></script>
<script type="text/javascript">
window.criteo_q = window.criteo_q || [];
var deviceType = /iPad/.test(navigator.userAgent) ? "t" : /Mobile|iP(hone|od)|Android|BlackBerry|IEMobile|Silk/.test(navigator.userAgent) ? "m" : "d";
window.criteo_q.push(
 { event: "setAccount", account: 74645}, // 이 라인은 업데이트하면 안됩니다
 { event: "setEmail", email: "" }, // 유저가 로그인이 안되 있는 경우 빈 문자열을 전달
 { event: "setSiteType", type: deviceType},
 { event: "viewBasket", item: [
    <?php echo $creteoPushData; ?>
]}
);
</script>
<!-- END Criteo 장바구니 태그 -->
<script type="text/javascript">
    kakaoPixel('2246260085587358355').viewCart();
</script>

<!-- Retaku script Start 삭제시 주의하세요-->
<script type = "text/javascript" >
rtq ( "pixel" , "cart" ,{
"item_id" :window.rtk_item_id,
"value" : "<?php echo $tot_price; ?>" ,
"currency" : "KRW" ,
"content_ids" : [<?php echo $retakuPushData; ?>] ,
"content_type" : "product"
});
</script>
<!--Retaku script End-->



<?php
include_once(G5_MSHOP_PATH.'/_tail.php');
?>