<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

// add_stylesheet('css 구문', 출력순서); 숫자가 작을 수록 먼저 출력됨
add_stylesheet('<link rel="stylesheet" href="'.G5_SHOP_CSS_URL.'/style.css">', 0);
?>
<div id="sit_ov_from">
	<form name="fitem" method="post" action="<?php echo $action_url; ?>" onsubmit="return fitem_submit(this);" target="_HIDDEN_FRAME">
	<input type="hidden" name="it_id[]" value="<?php echo $it_id; ?>">
	<input type="hidden" name="sw_direct">
	<input type="hidden" name="url">
	<input type="hidden" name="windowMode" value="0">
	<input type="hidden" id="cate40LimitCnt" value="<?php echo (int)$default['de_cate40LimitCnt']; ?>">
	<input type="hidden" name="orderableLevel" value="<?php echo $it['it_isOnlyAdmin']; ?>">
	<input type="hidden" name="isMember" value="<?php echo $is_member; ?>">
	<input type="hidden" name="isAdmin" value="<?php echo $is_admin; ?>">
	
	<div id="sit_ov_wrap">
	    <!-- 상품이미지 미리보기 시작 { -->
	    <div id="sit_pvi">
	        <div id="sit_pvi_big">
	        <?php
	        $big_img_count = 0;
	        $thumbnails = array();
			$thumbImgSrc = '';
	        for($i=1; $i<=10; $i++) {
	            if(!$it['it_img'.$i])
	                continue;
	
	            $img = get_it_thumbnail($it['it_img'.$i], $default['de_mimg_width'], $default['de_mimg_height']);
	
	            if($img) {
	                // 썸네일
	                $thumb = get_it_thumbnail($it['it_img'.$i], 70, 70);
					$thumb2 = get_it_thumbnail($it['it_img'.$i], 500, 500);
	                $thumbnails[] = $thumb;
	                $big_img_count++;
	
	                echo '<a href="'.G5_SHOP_URL.'/largeimage.php?it_id='.$it['it_id'].'&amp;no='.$i.'" target="_blank" class="popup_item_image">'.$img.'</a>';

					if (!$thumbImgSrc) {
						preg_match_all("/<img[^>]*src=[\"']?([^>\"']+)[\"']?[^>]*>/i", $thumb2, $matches);
						$thumbImgSrc = $matches[1][0];
					}
	            }
	        }
	
	        if($big_img_count == 0) {
	            echo '<img src="'.G5_SHOP_URL.'/img/no_image.gif" alt="">';
	        }
	        ?>
	        <a href="<?php echo G5_SHOP_URL; ?>/largeimage.php?it_id=<?php echo $it['it_id']; ?>&amp;no=1" target="_blank" id="popup_item_image" class="popup_item_image"><i class="fa fa-search-plus" aria-hidden="true"></i><span class="sound_only">확대보기</span></a>
	        </div>
	        <?php
	        // 썸네일
	        $thumb1 = true;
	        $thumb_count = 0;
	        $total_count = count($thumbnails);
	        if($total_count > 0) {
	            echo '<ul id="sit_pvi_thumb">';
	            foreach($thumbnails as $val) {
	                $thumb_count++;
	                $sit_pvi_last ='';
	                if ($thumb_count % 5 == 0) $sit_pvi_last = 'class="li_last"';
	                    echo '<li '.$sit_pvi_last.'>';
	                    echo '<a href="'.G5_SHOP_URL.'/largeimage.php?it_id='.$it['it_id'].'&amp;no='.$thumb_count.'" target="_blank" class="popup_item_image img_thumb">'.$val.'<span class="sound_only"> '.$thumb_count.'번째 이미지 새창</span></a>';
	                    echo '</li>';
	            }
	            echo '</ul>';
	        }
	        ?>
	    </div>
	    <!-- } 상품이미지 미리보기 끝 -->
	
	    <!-- 상품 요약정보 및 구매 시작 { -->
	    <section id="sit_ov" class="2017_renewal_itemform">
			<input type="hidden" id="it_eventEndDate" value="<?php echo $it['it_eventEndDate']; ?>">
			<input type="hidden" id="enableOrder" value="1">
			<?php
				if ($it['it_useEvent'] == 1 && $it['it_eventStartDate'] <= time() && $it['it_eventEndDate'] > time()) {
			?>
			<div id="timeSaleDiv">
				<h2 style="margin-bottom:5px;">판매 남은 시간</h2>
				<div id="remainTimeDiv" style="text-align:center;background-color:red; padding:7px 0;"><span id="remainTimeTxt" style="color:#fff;font-size:22px;font-weight:400;"></span></div>
			</div>
			<script>
				function startTimer() {
					var endTime = new Date($("#it_eventEndDate").val() * 1000);
					var min = "";
					var sec = "";

					var x = setInterval(function() {
						var now = new Date();
						var time = parseInt(parseInt(endTime.getTime() - now.getTime()) / 1000);

						sec = time;
						day = parseInt(sec/60/60/24);
						sec = (sec - (day*60*60*24));
						hour = parseInt(sec/60/60);
						sec = (sec - (hour*60*60));
						min = parseInt(sec/60);
						sec = parseInt(sec-(min*60));

						document.getElementById("remainTimeTxt").innerHTML = day +"일 "+ hour +"시간 "+ min +"분  "+ sec +"초";

						if (sec < 0)
						{
							clearInterval(x);
							document.getElementById("remainTimeTxt").innerHTML = '이벤트 기간이 종료되었습니다.';
							document.getElementById("enableOrder").value = "0";
						}
					}, 1000);
				}
				startTimer();
			</script>
			<?php
				}
			?>

	        <h2 id="sit_title"><?php echo stripslashes($it['it_name']); ?> <span class="sound_only">요약정보 및 구매</span></h2>
	        <p id="sit_desc"><?php echo $it['it_basic']; ?></p>
	        <?php if($is_orderable) { ?>
	        <p id="sit_opt_info">
	            상품 선택옵션 <?php echo $option_count; ?> 개, 추가옵션 <?php echo $supply_count; ?> 개
	        </p>
	        <?php } ?>
	        
	        <div id="sit_star_sns">
	            <?php if ($star_score) { ?>
	            <span class="sound_only">고객평점</span> 
	            <img src="<?php echo G5_SHOP_URL; ?>/img/s_star<?php echo $star_score?>.png" alt="" class="sit_star" width="100">
	            <span class="sound_only">별<?php echo $star_score?>개</span> 
	            <?php } ?>
	            
	            <span class="">사용후기 <?php echo $it['it_use_cnt']; ?> 개</span>
	            
	            <div id="sit_btn_opt">
	            	<span id="btn_wish"><i class="fa fa-heart-o" aria-hidden="true"></i><span class="sound_only">위시리스트</span><span class="btn_wish_num"><?php echo get_wishlist_count_by_item($it['it_id']); ?></span></span>
	            	<button type="button" class="btn_sns_share"><i class="fa fa-share-alt" aria-hidden="true"></i><span class="sound_only">sns 공유</span></button>
	            	<div class="sns_area">
	            		<?php echo $sns_share_links; ?>
	            		<!--a href="javascript:popup_item_recommend('<?php echo $it['it_id']; ?>');" id="sit_btn_rec"><i class="fa fa-envelope-o" aria-hidden="true"></i><span class="sound_only">추천하기</span></a-->
						<input type="hidden" value="http://<?php echo $_SERVER['HTTP_HOST']; ?><?php echo $_SERVER['REQUEST_URI']; ?>">
						<a id="myUrl" data-clipboard-text="http://<?php echo $_SERVER['HTTP_HOST']; ?><?php echo $_SERVER['REQUEST_URI']; ?>">URL 복사</a>
	            	</div>
	        	</div>

	        </div>

			<script src="<?php echo G5_JS_URL; ?>/clipboard.min.js"></script>
			<script> 
			var btn = document.getElementById('myUrl'); 
			var clipboard = new ClipboardJS(btn); 

			clipboard.on('success', function(e) { 
				alert('현재 상품 URL이 복사되었습니다.');
				console.log(e); 
			}); 

			clipboard.on('error', function(e) { 
				console.log(e); 
			}); 
			</script>

	        <script>
	        $(".btn_sns_share").click(function(){
	            $(".sns_area").show();
	        });
	        $(document).mouseup(function (e){
	            var container = $(".sns_area");
	            if( container.has(e.target).length === 0)
	            container.hide();
	        });
	        </script>
	        
	        <div class="sit_info">
	            <table class="sit_ov_tbl">
	            <colgroup>
	                <col class="grid_3">
	                <col>
	            </colgroup>
	            <tbody>
	            
	            <?php if (!$it['it_use']) { // 판매가능이 아닐 경우 ?>
	            <tr>
	                <th scope="row">판매가격</th>
	                <td>판매중지</td>
	            </tr>
	            <?php } else if ($it['it_tel_inq']) { // 전화문의일 경우 ?>
	            <tr>
	                <th scope="row">판매가격</th>
	                <td>전화문의</td>
	            </tr>
	            <?php } else { // 전화문의가 아닐 경우?>
	            <?php if ($it['it_cust_price']) { ?>
	            <tr>
	                <th scope="row">시중가격</th>
	                <td><strike><?php echo display_price($it['it_cust_price']); ?></strike></td>
	            </tr>
	            <?php } // 시중가격 끝 ?>
	
	            <tr>
	                <th scope="row">판매가격</th>
	                <td>
	                    <strong><?php echo display_price(get_price($it)); ?></strong>
	                    <input type="hidden" id="it_price" value="<?php echo get_price($it); ?>">
	                </td>
	            </tr>
				<tr class="tr_price">
					<th scope="row">무게</th>
					<td><?php echo $it['it_weight']; ?>g</td>
				</tr>
	            <?php } ?>
	            	
	            <?php if ($it['it_maker']) { ?>
	            <tr>
	                <th scope="row">제조사</th>
	                <td><?php echo $it['it_maker']; ?></td>
	            </tr>
	            <?php } ?>
	
	            <?php if ($it['it_origin']) { ?>
	            <tr>
	                <th scope="row">원산지</th>
	                <td><?php echo $it['it_origin']; ?></td>
	            </tr>
	            <?php } ?>
	
	            <?php if ($it['it_brand']) { ?>
	            <tr>
	                <th scope="row">브랜드</th>
	                <td><?php echo $it['it_brand']; ?></td>
	            </tr>
	            <?php } ?>
	
	            <?php if ($it['it_model']) { ?>
	            <tr>
	                <th scope="row">모델</th>
	                <td><?php echo $it['it_model']; ?></td>
	            </tr>
	            <?php } ?>

	            <?php
	            /* 재고 표시하는 경우 주석 해제
	            <tr>
	                <th scope="row">재고수량</th>
	                <td><?php echo number_format(get_it_stock_qty($it_id)); ?> 개</td>
	            </tr>
	            */
	            ?>
	
	            <?php if ($config['cf_use_point']) { // 포인트 사용한다면 ?>
	            <tr>
	                <th scope="row">포인트</th>
	                <td>
	                    <?php
	                    if($it['it_point_type'] == 2) {
	                        echo '구매금액(추가옵션 제외)의 '.$it['it_point'].'%';
	                    } else {
	                        $it_point = get_item_point($it);
	                        echo number_format($it_point).'점';
	                    }
	                    ?>
	                </td>
	            </tr>
	            <?php } ?>
	            <?php
	            $ct_send_cost_label = '배송비결제';
	
	            if($it['it_sc_type'] == 1)
	                $sc_method = '무료배송';
	            else {
	                if($it['it_sc_method'] == 1)
	                    $sc_method = '수령후 지불';
	                else if($it['it_sc_method'] == 2) {
	                    $ct_send_cost_label = '<label for="ct_send_cost">배송비결제</label>';
	                    $sc_method = '<select name="ct_send_cost" id="ct_send_cost">
	                                      <option value="0">주문시 결제</option>
	                                      <option value="1">수령후 지불</option>
	                                  </select>';
	                }
	                else
	                    $sc_method = '주문시 결제';
	            }
	            ?>
	            <tr>
	                <th><?php echo $ct_send_cost_label; ?></th>
	                <td><?php echo $sc_method; ?></td>
	            </tr>
	            <?php if($it['it_buy_min_qty']) { ?>
	            <tr>
	                <th>최소구매수량</th>
	                <td><?php echo number_format($it['it_buy_min_qty']); ?> 개</td>
	            </tr>
	            <?php } ?>
	            <?php if($it['it_buy_max_qty']) { ?>
	            <tr>
	                <th>최대구매수량</th>
	                <td><?php echo number_format($it['it_buy_max_qty']); ?> 개</td>
	            </tr>
	            <?php } ?>
	            </tbody>
	            </table>
	        </div>
	        <?php
	        if($option_item) {
	        ?>
	        <!-- 선택옵션 시작 { -->
	        <section class="sit_option">
	            <h3>선택옵션</h3>
	 
	            <?php // 선택옵션
	            echo $option_item;
	            ?>
	        </section>
	        <!-- } 선택옵션 끝 -->
	        <?php
	        }
	        ?>
	
	        <?php
	        if($supply_item) {
	        ?>
	        <!-- 추가옵션 시작 { -->
	        <section  class="sit_option">
	            <h3>추가옵션</h3>
	            <?php // 추가옵션
	            echo $supply_item;
	            ?>
	        </section>
	        <!-- } 추가옵션 끝 -->
	        <?php
	        }
	        ?>
	
	        <?php if ($is_orderable) { ?>
	        <!-- 선택된 옵션 시작 { -->
	        <section id="sit_sel_option">
	            <h3>선택된 옵션</h3>
	            <?php
	            if(!$option_item) {
	                if(!$it['it_buy_min_qty'])
	                    $it['it_buy_min_qty'] = 1;
	            ?>
	            <ul id="sit_opt_added">
	                <li class="sit_opt_list">
	                    <input type="hidden" name="io_type[<?php echo $it_id; ?>][]" value="0">
	                    <input type="hidden" name="io_id[<?php echo $it_id; ?>][]" value="">
	                    <input type="hidden" name="io_value[<?php echo $it_id; ?>][]" value="<?php echo $it['it_name']; ?>">
						<input type="hidden" name="io_cate[<?php echo $it_id; ?>][]" value="<?php echo $it['ca_id']; ?>">
	                    <input type="hidden" class="io_price" value="0">
	                    <input type="hidden" class="io_stock" value="<?php echo $it['it_stock_qty']; ?>">
	                    <div class="opt_name">
	                        <span class="sit_opt_subj"><?php echo $it['it_name']; ?></span>
	                    </div>
	                    <div class="opt_count">
	                        <label for="ct_qty_<?php echo $i; ?>" class="sound_only">수량</label>
							<button type="button" class="sit_qty_minus"><i class="fa fa-minus" aria-hidden="true"></i><span class="sound_only">감소</span></button>
	                        <input type="text" name="ct_qty[<?php echo $it_id; ?>][]" value="<?php echo $it['it_buy_min_qty']; ?>" id="ct_qty_<?php echo $i; ?>" class="num_input" size="5">
	                        <button type="button" class="sit_qty_plus"><i class="fa fa-plus" aria-hidden="true"></i><span class="sound_only">증가</span></button>
	                        <!-- <span class="sit_opt_prc">+0원</span> -->
	                    </div>
	                </li>
	            </ul>
	            <script>
	            $(function() {
	                price_calculate();
	            });
	            </script>
	            <?php } ?>
	        </section>
	        <!-- } 선택된 옵션 끝 -->
	
	        <!-- 총 구매액 -->
	        <div id="sit_tot_price"></div>
	        <?php } ?>
	
	        <?php if($is_soldout) { ?>
	        <p id="sit_ov_soldout">상품의 재고가 부족하여 구매할 수 없습니다.</p>
	        <?php } ?>
	
	        <div id="sit_ov_btn">
	            <?php if ($is_orderable) { ?>
	            <button type="submit" onclick="document.pressed=this.value;" value="장바구니" class="sit_btn_cart" id="cartBtn">장바구니</button>
	            <button type="submit" onclick="document.pressed=this.value;" value="바로구매" class="sit_btn_buy">바로구매</button>
	            <?php } ?>
	            <a id="wishBtn" href="javascript:item_wish(document.fitem, '<?php echo $it['it_id']; ?>');" class="sit_btn_wish"><i class="fa fa-heart-o" aria-hidden="true"></i><span class="sound_only">위시리스트</span></a>
	            	
	            <?php if(!$is_orderable && $it['it_soldout'] && $it['it_stock_sms']) { ?>
	            <a href="javascript:popup_stocksms('<?php echo $it['it_id']; ?>');" id="sit_btn_alm">재입고알림</a>
	            <?php } ?>
	            <?php if ($naverpay_button_js) { ?>
	            <div class="itemform-naverpay"><?php echo $naverpay_request_js.$naverpay_button_js; ?></div>
	            <?php } ?>
	        </div>
	
	        <script>
	        // 상품보관
	        function item_wish(f, it_id)
	        {
	            f.url.value = "<?php echo G5_SHOP_URL; ?>/wishupdate.php?it_id="+it_id;
	            f.action = "<?php echo G5_SHOP_URL; ?>/wishupdate.php";
	            f.submit();
	        }
	
	        // 추천메일
	        function popup_item_recommend(it_id)
	        {
	            if (!g5_is_member)
	            {
	                if (confirm("회원만 추천하실 수 있습니다."))
	                    document.location.href = "<?php echo G5_BBS_URL; ?>/login.php?url=<?php echo urlencode(shop_item_url($it_id)); ?>";
	            }
	            else
	            {
	                url = "./itemrecommend.php?it_id=" + it_id;
	                opt = "scrollbars=yes,width=616,height=420,top=10,left=10";
	                popup_window(url, "itemrecommend", opt);
	            }
	        }
	
	        // 재입고SMS 알림
	        function popup_stocksms(it_id)
	        {
	            url = "<?php echo G5_SHOP_URL; ?>/itemstocksms.php?it_id=" + it_id;
	            opt = "scrollbars=yes,width=616,height=420,top=10,left=10";
	            popup_window(url, "itemstocksms", opt);
	        }
	        </script>
	    </section>
	    <!-- } 상품 요약정보 및 구매 끝 -->
	</div>

<!-- 에임드 시작 -->
<div id="aed_view_p"></div>
<!-- 에임드 끝 -->


	<!-- 다른 상품 보기 시작 { -->
    <div id="sit_siblings">
	    <?php
	    if ($prev_href || $next_href) {
	        echo $prev_href.$prev_title.$prev_href2;
	        echo $next_href.$next_title.$next_href2;
	    } else {
	        echo '<span class="sound_only">이 분류에 등록된 다른 상품이 없습니다.</span>';
	    }
	    ?>
	</div>   
    <!-- } 다른 상품 보기 끝 -->
	</form>
</div>

<!-- 팝업뜰때 배경 -->
<div id="mask"></div>

<!--Popup Start -->
<div id="layerbox" class="layerpop"
	style="width: 700px; height: 350px;">
	<article class="layerpop_area">
	<div class="title">주문하기 안내</div>
	<a href="javascript:popupClose();" class="layerpop_close"
		id="layerbox_close">X</a> <br>
	<div class="content">
		1회 통관 시 배송비 제외 상품금액 150$ (한화 17만원)이내에서 면세입니다.
		<br><span class="txt_done" style="font-weight:bold;font-size:1.083em">※ 이를 초과할 시에는 추가 관세가 발생할 수 있습니다 ※</span>
		<br/>
		<br/>의약품은 관세법상 통관 기준인 1인당 6개까지 구매하실 수 있습니다.
		<br/>의약품 카테고리 상품을 6개 이상 주문한 경우에는
		<br/>니코니코몰 카톡 상당창 또는 고객센터로 알려주시면 처리해드립니다.
		<br/>
		<br/>
		<br/>
		<button id="goPaymentPageBtn" class="sec1">결제 계속하기</button>
		<button onclick="popupClose();" class="sec2">상품보기 돌아가기</button>
	</div>
	</article>
</div>
<!--Popup End -->


<!--Popup Start -->
<div id="layerbox2" class="layerpop2"
	style="width: 700px; height: 350px;">
	<article class="layerpop_area">
	<div class="title">주문하기 안내</div>
	<a href="javascript:popupClose2();" class="layerpop_close"
		id="layerbox_close">X</a> <br>
	<div class="content">
		<h3>장바구니에 상품을 담았습니다.</h3>
		<br/>
		<br/>
		<button onclick="popupClose2();" class="sec sec2">계속 쇼핑</button>
		<button id="goCartPageBtn" class="sec sec1">장바구니로</button>
	</div>
	</article>
</div>
<!--Popup End -->

<!--Popup Start -->
<div id="layerbox3" class="layerpop"
	style="width: 700px; height: 300px;">
	<article class="layerpop_area">
	<div class="title">주문하기 안내</div>
	<a href="javascript:popupClose3();" class="layerpop_close"
		id="layerbox_close">X</a> <br>
	<div class="content">		
		의약품은 관세법상 통관 기준인 1인당 6개까지 구매하실 수 있습니다.
		<br/>의약품 카테고리 상품을 6개 이상 주문한 경우에는
		<br/>니코니코몰 카톡 상당창 또는 고객센터로 알려주시면 처리해드립니다.
		<br/>
		<br/>
		<br/>
		<button id="goPaymentPageBtn3" class="sec1">결제 계속하기</button>
		<button onclick="popupClose3();" class="sec2">상품보기 돌아가기</button>
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
	/*height:300px !important;*/
    z-index: 1000;
	position:fixed !important;
    border: 2px solid #ccc;
    background: #fff;
    cursor: move; 
	top:50%;
	left:50%;
	-webkit-transform:  translateY(-50%)  translateX(-50%) !important;
    -moz-transform:  translateY(-50%)  translateX(-50%) !important;
    -ms-transform:  translateY(-50%)  translateX(-50%) !important;
    -o-transform:  translateY(-50%)  translateX(-50%) !important;
	transform:  translateY(-50%)  translateX(-50%) !important;
}

.layerpop2 {
    display: none;
	height:300px !important;
    z-index: 1000;
	position:fixed !important;
    border: 2px solid #ccc;
    background: #fff;
    cursor: move; 
	top:50%;
	left:50%;
	-webkit-transform:  translateY(-50%)  translateX(-50%) !important;
    -moz-transform:  translateY(-50%)  translateX(-50%) !important;
    -ms-transform:  translateY(-50%)  translateX(-50%) !important;
    -o-transform:  translateY(-50%)  translateX(-50%) !important;
	transform:  translateY(-50%)  translateX(-50%) !important;
}
.layerpop2 h3 { font-size:24px; }

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
    top: 10px;
    right: 10px;
    /*background: transparent url('btn_exit_off.png') no-repeat;*/ }

.layerpop_area .layerpop_close:hover {
    /*background: transparent url('btn_exit_on.png') no-repeat;*/
    cursor: pointer; }

.layerpop_area .content {
    width: 96%;    
    margin: 2%;
    color: #000; 
	font-size:16px;
	text-align:center;
}
.layerpop_area .content .sec1 {
	width:160px;
	border: 1px solid #3a8afd;
    background: #3a8afd;
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

</style>

<script>
$(function(){
    // 상품이미지 첫번째 링크
    $("#sit_pvi_big a:first").addClass("visible");

    // 상품이미지 미리보기 (썸네일에 마우스 오버시)
    $("#sit_pvi .img_thumb").bind("mouseover focus", function(){
        var idx = $("#sit_pvi .img_thumb").index($(this));
        $("#sit_pvi_big a.visible").removeClass("visible");
        $("#sit_pvi_big a:eq("+idx+")").addClass("visible");
    });

    // 상품이미지 크게보기
    $(".popup_item_image").click(function() {
        var url = $(this).attr("href");
        var top = 10;
        var left = 10;
        var opt = 'scrollbars=yes,top='+top+',left='+left;
        popup_window(url, "largeimage", opt);

        return false;
    });

	$("#goPaymentPageBtn").click(function(){
		popupClose();
		var f = document.fitem;
		f.submit();
	});

	$("#goPaymentPageBtn3").click(function(){
		popupClose3();
		var f = document.fitem;
		f.submit();
	});

	$("#goCartPageBtn").click(function(){
		
		location.href = '/shop/cart.php';
		popupClose2();
	});
});

function fsubmit_check(f)
{
    // 판매가격이 0 보다 작다면
    if (document.getElementById("it_price").value < 0) {
        alert("전화로 문의해 주시면 감사하겠습니다.");
        return false;
    }

    if($(".sit_opt_list").size() < 1) {
        alert("상품의 선택옵션을 선택해 주십시오.");
        return false;
    }

    var val, io_type, result = true;
    var sum_qty = 0;
    var min_qty = parseInt(<?php echo $it['it_buy_min_qty']; ?>);
    var max_qty = parseInt(<?php echo $it['it_buy_max_qty']; ?>);
    var $el_type = $("input[name^=io_type]");

    $("input[name^=ct_qty]").each(function(index) {
        val = $(this).val();

        if(val.length < 1) {
            alert("수량을 입력해 주십시오.");
            result = false;
            return false;
        }

        if(val.replace(/[0-9]/g, "").length > 0) {
            alert("수량은 숫자로 입력해 주십시오.");
            result = false;
            return false;
        }

        if(parseInt(val.replace(/[^0-9]/g, "")) < 1) {
            alert("수량은 1이상 입력해 주십시오.");
            result = false;
            return false;
        }

        io_type = $el_type.eq(index).val();
        if(io_type == "0")
            sum_qty += parseInt(val);
    });

    if(!result) {
        return false;
    }

    if(min_qty > 0 && sum_qty < min_qty) {
        alert("선택옵션 개수 총합 "+number_format(String(min_qty))+"개 이상 주문해 주십시오.");
        return false;
    }

    if(max_qty > 0 && sum_qty > max_qty) {
        alert("선택옵션 개수 총합 "+number_format(String(max_qty))+"개 이하로 주문해 주십시오.");
        return false;
    }

    return true;
}

// 바로구매, 장바구니 폼 전송
function fitem_submit(f)
{
    f.action = "<?php echo $action_url; ?>";
    //f.target = "";
	f.windowMode.value = 1;
	
    if (document.pressed == "장바구니") {
        f.sw_direct.value = 0;
    } else { // 바로구매
        f.sw_direct.value = 1;
    }

	if (f.orderableLevel.value == 2 && (!f.isMember.value || f.isMember.value == ''))
	{
		alert("회원만 구매가능 합니다.");
        return false;
	}
	
	if (f.enableOrder.value == '0')
	{
		alert("이벤트 기간이 종료 되어 구매할 수 없습니다.");
        return false;
	}

    // 판매가격이 0 보다 작다면
    if (document.getElementById("it_price").value < 0) {
        alert("전화로 문의해 주시면 감사하겠습니다.");
        return false;
    }

    if($(".sit_opt_list").size() < 1) {
        alert("상품의 선택옵션을 선택해 주십시오.");
        return false;
    }

    var val, io_type, result = true;
    var sum_qty = 0;
    var min_qty = parseInt(<?php echo $it['it_buy_min_qty']; ?>);
    var max_qty = parseInt(<?php echo $it['it_buy_max_qty']; ?>);
    var $el_type = $("input[name^=io_type]");
	var $cateArr = $("input[name^=io_cate]");
	var cate40Qty = 0;

    $("input[name^=ct_qty]").each(function(index) {
        val = $(this).val();

        if(val.length < 1) {
            alert("수량을 입력해 주십시오.");
            result = false;
            return false;
        }

        if(val.replace(/[0-9]/g, "").length > 0) {
            alert("수량은 숫자로 입력해 주십시오.");
            result = false;
            return false;
        }

        if(parseInt(val.replace(/[^0-9]/g, "")) < 1) {
            alert("수량은 1이상 입력해 주십시오.");
            result = false;
            return false;
        }

        io_type = $el_type.eq(index).val();
        if(io_type == "0")
            sum_qty += parseInt(val);

		
		if (parseInt($cateArr.eq(index).val()) == 40)
		{
			cate40Qty += parseInt(sum_qty);
		}
			
    });

    if(!result) {
        return false;
    }

    if(min_qty > 0 && sum_qty < min_qty) {
        alert("선택옵션 개수 총합 "+number_format(String(min_qty))+"개 이상 주문해 주십시오.");
        return false;
    }

    if(max_qty > 0 && sum_qty > max_qty) {
        alert("선택옵션 개수 총합 "+number_format(String(max_qty))+"개 이하로 주문해 주십시오.");
        return false;
    }
	
	if ($("#cate40LimitCnt").val() > 0 && cate40Qty > $("#cate40LimitCnt").val())
	{
		alert("의약품은 통관 시 1회에 최대 "+ $("#cate40LimitCnt").val() +"개까지 통관이 가능합니다.\n의약품 구매 수량을 조정해주세요.");
		return false;

	}
	
	var $el_prc = $("input.io_price");
	var $el_qty = $("input[name^=ct_qty]");
	var it_price = parseInt($("input#it_price").val());
	var $el_type = $("input[name^=io_type]");
	var price, type, qty, total = 0;

	$el_prc.each(function(index) {
		price = parseInt($(this).val());
		qty = parseInt($el_qty.eq(index).val());
		type = $el_type.eq(index).val();

		if(type == "0") { // 선택옵션
			total += (it_price + price) * qty;
		} else { // 추가옵션
			total += price * qty;
		}
	});

	if (document.pressed == "바로구매") {
		if (total > 170000)
		{
			goDetail();
			return false;
		} else {
			goDetail3();
			return false;
		}
	}
	return true;
}

function wrapWindowByMask() {
	//화면의 높이와 너비를 구한다.
	var maskHeight = $(document).height(); 
	var maskWidth = $(window).width();

	//문서영역의 크기 
	//console.log( "document 사이즈:"+ $(document).width() + "*" + $(document).height()); 
	//브라우저에서 문서가 보여지는 영역의 크기
	//console.log( "window 사이즈:"+ $(window).width() + "*" + $(window).height());        

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
	//$('.layerpop').css("top",(($(window).height() - $('.layerpop').outerHeight()) / 2) + $(window).scrollTop());
	//$('.layerpop').css("left",(($(window).width() - $('.layerpop').outerWidth()) / 2) + $(window).scrollLeft());
	//$('.layerpop').draggable();
	$('#layerbox').show();
}

function popupOpen2() {
	$('.layerpop2').css("position", "absolute");
	//영역 가운에데 레이어를 뛰우기 위해 위치 계산 
	//$('.layerpop2').css("top",(($(window).height() - $('.layerpop2').outerHeight()) / 2) + $(window).scrollTop());
	//$('.layerpop2').css("left",(($(window).width() - $('.layerpop2').outerWidth()) / 2) + $(window).scrollLeft());
	//$('.layerpop').draggable();
	$('#layerbox2').show();
}

function popupOpen3() {
	$('.layerpop').css("position", "absolute");
	//영역 가운에데 레이어를 뛰우기 위해 위치 계산 
	//$('.layerpop').css("top",(($(window).height() - $('.layerpop').outerHeight()) / 2) + $(window).scrollTop());
	//$('.layerpop').css("left",(($(window).width() - $('.layerpop').outerWidth()) / 2) + $(window).scrollLeft());
	//$('.layerpop').draggable();
	$('#layerbox3').show();
}

function popupClose() {
	$('#layerbox').hide();
	$('#mask').hide();
}

function popupClose3() {
	$('#layerbox3').hide();
	$('#mask').hide();
}

function popupClose2() {
	$('#layerbox2').hide();
}

function goDetail() {

	/*팝업 오픈전 별도의 작업이 있을경우 구현*/ 

	popupOpen(); //레이어 팝업창 오픈 
	wrapWindowByMask(); //화면 마스크 효과 
}

function goDetail3() {

	/*팝업 오픈전 별도의 작업이 있을경우 구현*/ 

	popupOpen3(); //레이어 팝업창 오픈 
	wrapWindowByMask(); //화면 마스크 효과 
}

function addCartComplete() {
	popupOpen2(); //레이어 팝업창 오픈 
}
</script>
<?php /* 2017 리뉴얼한 테마 적용 스크립트입니다. 기존 스크립트를 오버라이드 합니다. */ ?>
<script src="<?php echo G5_JS_URL; ?>/shop.override.js"></script>

<iframe id="_HIDDEN_FRAME" name="_HIDDEN_FRAME" width="0" height="0" frameborder="no"></iframe>

<!-- Enliple Shop Log Tracker v3.6 start -->
<script type="text/javascript">
<!--
function mobRfShop() {
    var sh = new EN();
    // [상품상세정보]
    sh.setData("sc", "b2c681549212c3200b594a3a135c955a");
    sh.setData("userid", "niconico");
    sh.setData("pcode", "<?php echo $it['it_id'] ?>");
    sh.setData("price", "<?php echo $it['it_price'] ?>");
	sh.setData("pnm", encodeURIComponent(encodeURIComponent("<?php echo $it['it_name'] ?>")));
    sh.setData("img", encodeURIComponent("<?php echo $prdImgPath ?>"));
    sh.setData("dcPrice", ""); // 옵션
    sh.setData("soldOut", ""); //옵션 1:품절,2:품절아님
    sh.setData("mdPcode", ""); //옵션
    sh.setData("cate1", encodeURIComponent(encodeURIComponent("<?php echo $it['ca_name'] ?>"))); //필수
    sh.setSSL(true);
    sh.sendRfShop();

	// 장바구니 버튼 클릭 시 호출 메소드(사용하지 않는 경우 삭제)
    document.getElementById("cartBtn").onmouseup = sendCart;
    function sendCart() {
        sh.sendCart();
    }
    // 찜,Wish 버튼 클릭 시 호출 메소드(사용하지 않는 경우 삭제)
    document.getElementById("wishBtn").onmouseup = sendWish;
    function sendWish() {
        sh.sendWish();
    }

}
//-->
</script>
<script src="https://cdn.megadata.co.kr/js/en_script/3.6/enliple_min3.6.js" defer="defer" onload="mobRfShop()"></script>
<!-- Enliple Shop Log Tracker v3.6 end  -->

<!-- Criteo 상품 태그 -->
<script type="text/javascript" src="//static.criteo.net/js/ld/ld.js" async="true"></script>
<script type="text/javascript">
window.criteo_q = window.criteo_q || [];
var deviceType = /iPad/.test(navigator.userAgent) ? "t" : /Mobile|iP(hone|od)|Android|BlackBerry|IEMobile|Silk/.test(navigator.userAgent) ? "m" : "d";
window.criteo_q.push(
 { event: "setAccount", account: 74645}, // 이 라인은 업데이트하면 안됩니다
 { event: "setEmail", email: "" }, // 유저가 로그인이 안되 있는 경우 빈 문자열을 전달
 { event: "setSiteType", type: deviceType},
 { event: "viewItem", item: "<?php echo $it['it_id'] ?>" });
</script>
<!-- END Criteo 상품 태그 -->

<script type="text/javascript">
    kakaoPixel('2246260085587358355').viewContent({
      id: '<?php echo $it['it_id'] ?>'
    });
</script>
<script type="text/javascript">
	fbq('track', 'ViewContent', {content_ids:"<?php echo $it['it_id'] ?>", content_name:"<?php echo $it['it_name'] ?>",currency: "KRW", value: <?php echo $it['it_price'] ?>,content_type: 'product'});

	$('.sit_btn_cart').on('click', function(){
		fbq('track', 'AddToCart', {content_ids:['<?php echo $it['it_id'] ?>'], content_name:"<?php echo $it['it_name'] ?>", currency: "KRW", value: <?php echo $it['it_price'] ?>, 
			contents: [
			    {
			        id: '<?php echo $it['it_id'] ?>',
					quantity: 1
			}],
			content_type: 'product'});
	});
</script>

<?php
if (!$thumbImgSrc) {
	$thumbImgSrc = $prdImgPath;
}
?>

<!-- Retaku script Start 삭제시 주의하세요-->
<script type = "text/javascript" >
rtq ( "pixel" , "item" ,{
"item_id" :window.rtk_item_id,
"value" : "<?php echo $it['it_price'] ?>" ,
"currency" : "KRW" ,
"content_ids" : [ "" ],
"content_id" : "<?php echo $it['it_id'] ?>" ,
"content_name" : "<?php echo $it['it_name'] ?>" ,
"content_name_tag" : "<?php echo $it['it_name'] ?>" ,
"image_1" : "<?php echo $prdImgPath ?>" ,
"category_1" : "<?php echo $it['ca_id'] ?>" ,
"category_2" : "" ,
"category_3" : "" ,
"category_name_1" : "<?php echo $it['ca_name'] ?>" ,
"category_name_2" : "" ,
"category_name_3" : "" ,
"mobile_image" : "<?php echo $thumbImgSrc ?>" ,
"image_large" : "" ,
"icon_tag" : "<?php echo item_icon_script($it); ?>" ,
"sum_desc_tag" : "" ,
"price" : "<?php echo $it['it_price'] ?>" ,
"product_price_mobile" : "<?php echo $it['it_price'] ?>" ,
"list_price" : "" ,
"discount_amount" : "" ,
"discount_price" : "" ,
"brand" : "" ,
"content_type" : "product",
"is_soldout": "False"
});
</script>
<!--Retaku script End-->


<div itemscope itemtype="http://schema.org/Product">
  <meta itemprop="brand" content="니코니코몰">
  <meta itemprop="name" content="<?php echo $it['it_name'] ?>">
  <meta itemprop="description" content="<?php echo $it['it_name'] ?>">
  <meta itemprop="productID" content="<?php echo $it['it_id'] ?>">
  <meta itemprop="url" content="http://<?php echo $_SERVER["HTTP_HOST"], $_SERVER['REQUEST_URI']; ?>">
  <meta itemprop="image" content="<?php echo $thumbImgSrc; ?>">
  <div itemprop="value" itemscope itemtype="http://schema.org/PropertyValue">
    <span itemprop="propertyID" content="<?php echo $it['ca_id'] ?>"></span>
    <meta itemprop="value" content="<?php echo $it['ca_name'] ?>"></meta>
  </div>
  <div itemprop="offers" itemscope itemtype="http://schema.org/Offer">
    <link itemprop="availability" href="http://schema.org/InStock">
    <link itemprop="itemCondition" href="http://schema.org/NewCondition">
    <meta itemprop="price" content="<?php echo $it['it_price'] ?>">
    <meta itemprop="priceCurrency" content="KRW">
  </div>
</div>