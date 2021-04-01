<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

run_event('pre_head');

if(defined('G5_THEME_PATH')) {
    require_once(G5_THEME_PATH.'/head.php');
    return;
}

if (G5_IS_MOBILE) {
    include_once(G5_MOBILE_PATH.'/head.php');
    return;
}

include_once(G5_PATH.'/head.sub.php');
include_once(G5_LIB_PATH.'/latest.lib.php');
include_once(G5_LIB_PATH.'/outlogin.lib.php');
include_once(G5_LIB_PATH.'/poll.lib.php');
include_once(G5_LIB_PATH.'/visit.lib.php');
include_once(G5_LIB_PATH.'/connect.lib.php');
include_once(G5_LIB_PATH.'/popular.lib.php');
?>


<script>
	jQuery(function ($){
		$(".btn_member_mn").on("click", function() {
			$(".member_mn").toggle();
			$(".btn_member_mn").toggleClass("btn_member_mn_on");
		});
		
		var active_class = "btn_sm_on",
			side_btn_el = "#quick .btn_sm",
			quick_container = ".qk_con";

		$(document).on("click", side_btn_el, function(e){
			e.preventDefault();

			var $this = $(this);
			
			if (!$this.hasClass(active_class)) {
				$(side_btn_el).removeClass(active_class);
				$this.addClass(active_class);
			}

			if( $this.hasClass("btn_sm_cl1") ){
				$(".side_mn_wr1").show();
			} else if( $this.hasClass("btn_sm_cl2") ){
				$(".side_mn_wr2").show();
			} else if( $this.hasClass("btn_sm_cl3") ){
				$(".side_mn_wr3").show();
			} else if( $this.hasClass("btn_sm_cl4") ){
				$(".side_mn_wr4").show();
			}
		}).on("click", ".con_close", function(e){
			$(quick_container).hide();
			$(side_btn_el).removeClass(active_class);
		});

		$(document).mouseup(function (e){
			var container = $(quick_container),
				mn_container = $(".shop_login");
			if( container.has(e.target).length === 0){
				container.hide();
				$(side_btn_el).removeClass(active_class);
			}
			if( mn_container.has(e.target).length === 0){
				$(".member_mn").hide();
				$(".btn_member_mn").removeClass("btn_member_mn_on");
			}
		});

		// TOP
		$("#top_btn").on("click", function() {
			$("html, body").animate({scrollTop:0}, '500');
			return false;
		});

		// 컨텐츠 페이지 Tab 메뉴 dataset 설정
		if ($('.tab_list ul li').size() > 0) {
			$('.tab_list ul li').each(function (index, item) {
				$(item).attr('data-tab', 'tab' + (index + 1));
			});
		}

		// 즐겨찾기
		$('.favorite').on('click', function (e) {
			var bookmarkURL = window.location.href;
			var bookmarkTitle = document.title;
			var triggerDefault = false;

			if (window.sidebar && window.sidebar.addPanel) {
				// Firefox version < 23
				window.sidebar.addPanel(bookmarkTitle, bookmarkURL, '');
			} else if ((window.sidebar && (navigator.userAgent.toLowerCase().indexOf('firefox') > -1)) || (window.opera && window.print)) {
				// Firefox version >= 23 and Opera Hotlist
				var $this = $(this);
				$this.attr('href', bookmarkURL);
				$this.attr('title', bookmarkTitle);
				$this.attr('rel', 'sidebar');
				$this.off(e);
				triggerDefault = true;
			} else if (window.external && ('AddFavorite' in window.external)) {
				// IE Favorite
				window.external.AddFavorite(bookmarkURL, bookmarkTitle);
			} else {
				// WebKit - Safari/Chrome
				alert((navigator.userAgent.toLowerCase().indexOf('mac') != -1 ? 'Cmd' : 'Ctrl') + '+D 키를 눌러 즐겨찾기에 등록하실 수 있습니다.');
			}

			return triggerDefault;
		});

		// QUICK
		$("#quick > li > a").on("click", function() {
			$("#quick > li > ul").toggleClass("active");
			return false;
		});

	});
</script>



<!-- 상단 시작 { -->
<div id="hd">
    <h1 id="hd_h1"><?php echo $g5['title'] ?></h1>
    <div id="skip_to_container"><a href="#container">본문 바로가기</a></div>

    <?php if(defined('_INDEX_')) { // index에서만 실행
        include G5_BBS_PATH.'/newwin.inc.php'; // 팝업레이어
	} ?>
     
	<div id="tnb" style="display:none">
    	<div class="inner">
			<ul id="hd_qnb">
	            <li><a href="<?php echo G5_BBS_URL ?>/faq.php">FAQ</a></li>
	            <li><a href="<?php echo G5_BBS_URL ?>/qalist.php">1:1문의</a></li>
	            <li><a href="<?php echo G5_SHOP_URL ?>/personalpay.php">개인결제</a></li>
	            <li><a href="<?php echo G5_SHOP_URL ?>/itemuselist.php">사용후기</a></li> 
	            <li><a href="<?php echo G5_SHOP_URL ?>/itemqalist.php">상품문의</a></li>
	        </ul>
		</div>
	</div>
    <div id="hd_wrapper">
        <div id="logo">
        	<a href="<?php echo G5_SHOP_URL; ?>/"><img src="<?php echo G5_DATA_URL; ?>/common/logo_img" alt="<?php echo $config['cf_title']; ?>"></a>
        </div>

		<div id="hd_menu">
			<button type="button" id="menu_open"><img src="/img/main/btnAllmenu.png" alt="카테고리"></button>
			<div class="favorite"><a href="#"><img src="/img/main/btnBookmark.png" alt="즐겨찾기"></a></div>
		</div> 
		
		<div class="f_right">
			<ul class="hd_login">        
				<?php if ($is_member) {  ?>            
				<li><?php echo $member['mb_name']; ?> <span class="m-rat-label <?php echo $memberLevel[$member['mb_level']]; ?>"><?php echo $memberLevel[$member['mb_level']]; ?></span></li>
				<li><a href="<?php echo G5_BBS_URL ?>/logout.php">로그아웃</a></li>
				<!-- <li><a href="<?php //echo G5_BBS_URL ?>/member_confirm.php?url=<?php //echo G5_BBS_URL ?>/register_form.php">정보수정</a></li> -->
				<?php if ($is_admin) {  ?>
				<li class="tnb_admin"><a href="<?php echo correct_goto_url(G5_ADMIN_URL); ?>">관리자</a></li>
				<?php }  ?>
				<?php } else {  ?>
				<li><a href="<?php echo G5_BBS_URL ?>/login.php">로그인</a></li>
				<li><a href="<?php echo G5_BBS_URL ?>/register.php">회원가입</a><div class="ani animated2 bounce2">+1,000P</div></li>            
				<?php }  ?>		
				<!-- <li><a href="<?php //echo G5_SHOP_URL; ?>/orderinquiry.php">주문조회</a></li> -->
				<li><a href="<?php echo G5_SHOP_URL; ?>/mypage.php">마이페이지</a></li>  
				<li><a href="/bbs/faq.php">고객센터</a></li>
			</ul>

			<div class="hd_sch_wr">
				<div class="shop_cart">
					<a href="<?php echo G5_SHOP_URL; ?>/orderinquiry.php"><img src="/img/common/ic-order.png" height="21px" alt=""><span class="sound_only">주문조회</span></a>
				</div>
				<div class="shop_cart">
					<a href="<?php echo G5_SHOP_URL; ?>/cart.php"><img src="/img/main/imgCart.gif" alt=""><span class="sound_only">장바구니</span><span class="count"><?php echo get_boxcart_datas_count(); ?></span></a>
				</div>
				<fieldset id="hd_sch">
					<legend>쇼핑몰 전체검색</legend>
					<form name="frmsearch1" action="<?php echo G5_SHOP_URL; ?>/search.php" onsubmit="return search_submit(this);">
					<label for="sch_str" class="sound_only">검색어<strong class="sound_only"> 필수</strong></label>
					<input type="text" name="q" value="<?php echo stripslashes(get_text(get_search_string($q))); ?>" id="sch_str" required placeholder="SEARCH">
					<button type="submit" id="sch_submit" value="검색"><img src="/img/main/btnSearch.gif" alt="검색"><span class="sound_only">검색</span></button>
					</form>
					<script>
					function search_submit(f) {
						if (f.q.value.length < 2) {
							alert("검색어는 두글자 이상 입력하십시오.");
							f.q.select();
							f.q.focus();
							return false;
						}
						return true;
					}
					</script>
				</fieldset>				
			</div>
		</div>

        <!-- 쇼핑몰 배너 시작 { -->
        <?php // echo display_banner('왼쪽'); ?>
        <!-- } 쇼핑몰 배너 끝 --> 
    </div>    
</div>
<!-- } 상단 끝 -->


<div id="side_menu">
	<ul id="quick">
		<!--li><a href="/bbs/content.php?co_id=service"><img src="/img/common/btnQuick01.png" alt=""><span>해외직구의 모든것</span></a></li>
		<li><a href="https://pf.kakao.com/_bqbCT" target="_blank"><img src="/img/common/btnQuick04.png" alt=""><span>카카오톡 상담</span></a></li-->

		<li>
			<a href="javascript:void(0)"><img src="/img/common/btnQuick05.png" alt="" width="52px"/>
			<ul class="actvie">
				<li><a href="https://pf.kakao.com/_xkWxkxoxb" target="_blank"><img src="/img/common/ic-kakaoch.png" alt=""><span>카카오톡 채널</span></a></li>
				<li><a href="https://unipass.customs.go.kr/csp/persIndex.do" target="_blank"><img src="/img/common/btnQuick02.png" alt=""><span>개인통관부호 발급</span></a></li>
<!-- 				<li><a href="http://pf.kakao.com/_bqbCT/chat" target="_blank"><img src="/img/common/btnQuick03.png" alt=""><span>카카오톡 상담</span></a></li> -->
				<li><button class="btn_sm_cl2 btn_sm"><img src="/img/common/btnQuick06.png" alt=""><span>최근 본 상품</span></button></li>	
			</ul>
		</li>
		<!--li><button class="btn_sm_cl1 btn_sm"><i class="fa fa-user-o" aria-hidden="true"></i><span class="qk_tit">마이메뉴</span></button></li>
		<li><button class="btn_sm_cl2 btn_sm"><i class="fa fa-archive" aria-hidden="true"></i><span class="qk_tit">오늘 본 상품</span></button></li>
		<li><button class="btn_sm_cl3 btn_sm"><i class="fa fa-shopping-cart" aria-hidden="true"></i><span class="qk_tit">장바구니</span></button></li>
		<li><button class="btn_sm_cl4 btn_sm"><i class="fa fa-heart-o" aria-hidden="true"></i><span class="qk_tit">위시리스트</span></button></li-->
    </ul>
    <button type="button" id="top_btn"><img src="/img/common/btnTop.png" alt=""></i><span class="sound_only">상단으로</span></button>
    <div id="tabs_con">
	    <div class="side_mn_wr1 qk_con">
	    	<div class="qk_con_wr">
	    		<?php echo outlogin('shop_side'); // 아웃로그인 ?>
		        <ul class="side_tnb" style="display:none">
		        	<?php if ($is_member) { ?>
					<li><a href="<?php echo G5_SHOP_URL; ?>/mypage.php">마이쇼핑</a></li>
		            <?php } ?>
					<li><a href="<?php echo G5_SHOP_URL; ?>/orderinquiry.php">주문내역</a></li>
					<li><a href="<?php echo G5_BBS_URL ?>/faq.php">FAQ</a></li>
		            <li><a href="<?php echo G5_BBS_URL ?>/qalist.php">1:1문의</a></li>
		            <li><a href="<?php echo G5_SHOP_URL ?>/personalpay.php">개인결제</a></li>
		            <li><a href="<?php echo G5_SHOP_URL ?>/itemuselist.php">사용후기</a></li>
		            <li><a href="<?php echo G5_SHOP_URL ?>/itemqalist.php">상품문의</a></li>
		            <li><a href="<?php echo G5_SHOP_URL; ?>/couponzone.php">쿠폰존</a></li>
		        </ul>



				<ul class="side_tnb">
					<li><a href="<?php echo G5_SHOP_URL; ?>/cart.php"><img src="/img/sub/iconCategory01.png" alt=""><br>장바구니</a></li>
					<li><a href="<?php echo G5_SHOP_URL; ?>/orderinquiry.php"><img src="/img/sub/iconCategory02.png" alt=""><br>주문조회</a></li>
					<li><a href="<?php echo G5_BBS_URL ?>/qalist.php"><img src="/img/sub/iconCategory03.png" alt=""><br>1:1문의</a></li>
					<li><a href="<?php echo G5_SHOP_URL; ?>/wishlist.php"><img src="/img/sub/iconCategory04.png" alt=""><br>위시리스트</a></li>     
		            <!--li><a href="<?php echo G5_SHOP_URL ?>/personalpay.php">개인결제</a></li>		            
		            <li><a href="<?php echo G5_SHOP_URL ?>/itemqalist.php">상품문의</a></li-->
		        </ul>
	        	<?php // include_once(G5_SHOP_SKIN_PATH.'/boxcommunity.skin.php'); // 커뮤니티 ?>

				<div>
					<h3>카테고리</h3>
					<!-- <ul>
						<li><a href="/shop/list.php?ca_id=10">회원특가</a></li>
						<li><a href="/shop/list.php?ca_id=20">베스트</a></li>
						<li><a href="/shop/list.php?ca_id=30">기획전</a></li>
						<li><a href="/shop/list.php?ca_id=40">건강용품</a></li>
						<li><a href="/shop/list.php?ca_id=50">서플리먼트</a></li>
						<li><a href="/shop/list.php?ca_id=60">뷰티용품</a></li>
						<li><a href="/shop/list.php?ca_id=70">식품/차/커피</a></li>
						<li><a href="/shop/list.php?ca_id=80">생활용품</a></li>
						<li><a href="/shop/list.php?ca_id=90">세트할인</a></li>
						<li><a href="/shop/list.php?ca_id=a0">이벤트</a></li>
					</ul> -->
					<ul>
						<?php
						$mshop_categories = get_shop_category_array(true);
						$gnb_zindex = 999; // gnb_1dli z-index 값 설정용
						$i = 0;
						foreach($mshop_categories as $cate1) {
							if( empty($cate1) ) continue;

							$row = $cate1['text'];
							$gnb_zindex -= 1; // html 구조에서 앞선 gnb_1dli 에 더 높은 z-index 값 부여
							$count = ((int) count($cate1)) - 1;
						?>
						<li style="z-index:<?php echo $gnb_zindex; ?>">
							<a href="<?php echo $row['url']; ?>"><?php echo $row['ca_name']; ?></a>
							<?php
							$j=0;
							foreach($cate1 as $key=>$cate2) {
							if( empty($cate2) || $key === 'text' ) continue;
							
							$row2 = $cate2['text'];
							if ($j==0) echo '<ul class="gnb_2dul" style="z-index:'.$gnb_zindex.'">';
							?>
								<li><a href="<?php echo $row2['url']; ?>"><?php echo $row2['ca_name']; ?></a></li>
							<?php $j++; }   //end for
							if ($j>0) echo '</ul>';
							?>
						</li>
						<?php $i++; }   //end for ?>
					</ul>
				</div>
				<div>
					<h3>고객센터</h3>
					<ul>						
						<li><a href="/bbs/board.php?bo_table=notice">공지사항</a></li>
						<li><a href="<?php echo G5_SHOP_URL; ?>/mypage.php">마이쇼핑</a></li>
						<li><a href="<?php echo G5_SHOP_URL; ?>/orderinquiry.php">주문조회</a></li>
						<li><a href="<?php echo G5_SHOP_URL; ?>/couponzone.php">쿠폰관리</a></li>
						<li><a href="<?php echo G5_BBS_URL ?>/faq.php">FAQ</a></li>
						<li><a href="<?php echo G5_BBS_URL ?>/qalist.php">회원문의</a></li>
						<!-- <li><a href="<?php //echo G5_SHOP_URL ?>/itemuselist.php">상품후기</a></li> -->
						<!-- <li><a href="<?php //echo G5_BBS_URL ?>/board.php?bo_table=unidentified">미확인입금내역</a></li> -->
						<!-- <li><a href="">APP다운로드</a></li> -->
					</ul>
				</div>

				<div class="todayProduct">
					<div class="qk_con_wr">
						<?php include(G5_SHOP_SKIN_PATH.'/boxtodayview.skin.php'); // 오늘 본 상품 ?>
					</div>
				</div>

	        	<?php // include_once(G5_SHOP_SKIN_PATH.'/boxcommunity.skin.php'); // 커뮤니티 ?>
	    		<button type="button" class="con_close"><img src="/img/main/btnClose.png" alt=""><span class="sound_only">나의정보 닫기</span></button>
	    	</div>
	    </div>
	    <div class="side_mn_wr2 qk_con">
	    	<div class="qk_con_wr">
	        	<?php include(G5_SHOP_SKIN_PATH.'/boxtodayview.skin.php'); // 오늘 본 상품 ?>
	    		<button type="button" class="con_close" style="box-sizing:border-box; border:1px solid #f0f0f0; border-left:0;"><img src="/img/main/btnClose.png" alt=""><span class="sound_only">오늘 본 상품 닫기</span></button>
	    	</div>
	    </div>
	    <div class="side_mn_wr3 qk_con">
	    	<div class="qk_con_wr">
	        	<?php include_once(G5_SHOP_SKIN_PATH.'/boxcart.skin.php'); // 장바구니 ?>
	    		<button type="button" class="con_close"><img src="/img/main/btnClose.png" alt=""><span class="sound_only">장바구니 닫기</span></button>
	    	</div>
	    </div>
	    <div class="side_mn_wr4 qk_con">
	    	<div class="qk_con_wr">
	        	<?php include_once(G5_SHOP_SKIN_PATH.'/boxwish.skin.php'); // 위시리스트 ?>
	    		<button type="button" class="con_close"><img src="/img/main/btnClose.png" alt=""><span class="sound_only">위시리스트 닫기</span></button>
	    	</div>
	    </div>
    </div>
</div>


<!-- 전체 콘텐츠 시작 { -->
<div id="wrapper" class="<?php echo implode(' ', $wrapper_class); ?>">
	<?php include_once(G5_SHOP_SKIN_PATH.'/boxcategory.skin.php'); // 상품분류 ?>
    <div id="container_wr">
		<nav class="tabmenu">
			<h2>서브메뉴</h2>
			<ul>
			<?php
			$menu_datas = get_menu_db(0, true);
			$gnb_zindex = 999; // gnb_1dli z-index 값 설정용
			$i = 0;
			foreach( $menu_datas as $row ){
				if( empty($row) ) continue;
				$add_class = (isset($row['sub']) && $row['sub']) ? 'gnb_al_li_plus' : '';
			?>
			
				<?php
				$k = 0;
				foreach( (array) $row['sub'] as $row2 ){

					if( empty($row2) ) continue; 

					if($k == 0)
						echo ''.PHP_EOL;
				?>
					<li class="gnb_2dli"><a href="<?php echo $row2['me_link']; ?>" target="_<?php echo $row2['me_target']; ?>" class="gnb_2da"><?php echo $row2['me_name'] ?></a></li>
				<?php
				$k++;
				}   //end foreach $row2

				if($k > 0)
					echo ''.PHP_EOL;
				?>					

			<?php
			$i++;
			}   //end foreach $row

			if ($i == 0) {  ?>
				<li class="gnb_empty">메뉴 준비 중입니다.<?php if ($is_admin) { ?> <a href="<?php echo G5_ADMIN_URL; ?>/menu_list.php">관리자모드 &gt; 환경설정 &gt; 메뉴설정</a>에서 설정하실 수 있습니다.<?php } ?></li>
			<?php } ?>
			</ul>
		</nav>
   
    <div id="container">
		<?php if (!defined("_INDEX_")) { ?><h2 id="container_title"><span title="<?php echo get_text($g5['title']); ?>"><?php echo get_head_title($g5['title']); ?></span></h2><?php } ?>