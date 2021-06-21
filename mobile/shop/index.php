<?php
include_once('./_common.php');

define("_INDEX_", TRUE);

include_once(G5_MSHOP_PATH.'/_head.php');
?>
<!-- more 패널, 티커 노출 스크립트 -->
<script>
var meta = document.createElement('meta');
meta.setAttribute('name', 'more_page_type');
meta.setAttribute('content', 'main');
document.getElementsByTagName('head')[0].appendChild(meta);
</script>
<script src="<?php echo G5_JS_URL; ?>/swipe.js"></script>
<script src="<?php echo G5_JS_URL; ?>/shop.mobile.main.js"></script>

<?php  echo display_banner('메인', 'mainbanner.10.skin.php'); ?>
<?php  // echo display_banner('왼쪽', 'boxbanner.skin.php'); ?>


	<!-- <div class="btn03">
		<ul>
			<li><a href="/shop/search.php?q=하다라보" style="background:#d3e9f9"><img src="/img/mobile/btn03_01.jpg" alt="고코쥰, 시로쥰. 하다라보 스킨케어"></a></li>
			<li><a href="/shop/search.php?q=타마고" style="background:#f3e7d4"><img src="/img/mobile/btn03_02.jpg" alt="일본 가정식 밥도둑! 타마고 조미료"></a></li>
			<li><a href="/bbs/board.php?bo_table=notice&wr_id=1" style="background:#f0f0f0"><img src="/img/mobile/btn03_03.jpg" alt="Plus 친구가 되면 6,000원을 드립니다! 검색창에 “재팬데이”를 검색"></a></li>
		</ul>
	</div>  -->


<!-- 에임드 시작 -->
<div id="aed_main_m"></div>
<!-- 에임드 끝 -->


    <!--?php if($default['de_mobile_type1_list_use']) { ?-->
	<!-- 요즘 핫한 상품 시작 { -->
    <div class="sct_wrap">
		<header>
			<h2>요즘 핫한 상품</h2>
			<span>HOT ITEM</span>
		</header>
        <?php
        $list = new item_list();
        $list->set_mobile(true);
        $list->set_type(1);
        $list->set_view('it_id', false);
        $list->set_view('it_name', true);
        $list->set_view('it_cust_price', true);
        $list->set_view('it_price', true);
        $list->set_view('it_icon', true);
		$list->set_view('star', true);
      //  $list->set_view('sns', true);

		if ($is_admin) {
			$list->set_isOnlyAdmin(1);
		}

        echo $list->run();
        ?>


		<!--// div class="st_30_wr">
			<!-- 메인상품진열 30 시작
			<div class="bx-wrapper">
				<div class="bx-viewport">
					<ul class="sct sct_30">
						<li class="sct_li">
							<a href="/shop/search.php?q=샤론파스A">
								<div class="sct_img"><img src="/img/main/imgChoice01.jpg" alt="히사미츠 샤론파스A"></div>
								<div class="sct_txt" style="padding-bottom:3px;border-bottom:1px solid #ececec">히사미츠 샤론파스A</div>
								<div class="sct_txt01" style="color:#888">통증 특효약 일본 국민파스</div>
							</a>
						</li>
						<li class="sct_li">
							<a href="/shop/search.php?q=동전파스">
								<div class="sct_img"><img src="/img/main/imgChoice02.jpg" alt="로이히츠보쿠 동전파스"></div>
								<div class="sct_txt" style="padding-bottom:3px;border-bottom:1px solid #ececec">로이히츠보쿠 동전파스</div>
								<div class="sct_txt01" style="color:#888">일본은 몰라도 파스는 안다</div>
							</a>
						</li>
						<li class="sct_li">
							<a href="/shop/search.php?q=아이봉">
								<div class="sct_img"><img src="/img/main/imgChoice03.jpg" alt="아이봉"></div>
								<div class="sct_txt" style="padding-bottom:3px;border-bottom:1px solid #ececec">아이봉</div>
								<div class="sct_txt01" style="color:#888">눈 전체를 맑게 케어!</div>
							</a>
						</li>
						<li class="sct_li">
							<a href="/shop/search.php?q=곤약젤리">
								<div class="sct_img"><img src="/img/main/imgChoice04.jpg" alt="곤약젤리파우치"></div>
								<div class="sct_txt" style="padding-bottom:3px;border-bottom:1px solid #ececec">곤약젤리파우치</div>
								<div class="sct_txt01" style="color:#888">말랑하고 탱글한 과육느낌 그대로!</div>
							</a>
						</li>
						<li class="sct_li">
							<a href="/shop/search.php?q=오타이산">
								<div class="sct_img"><img src="/img/main/imgChoice05.jpg" alt="국민위장약 오타이산"></div>
								<div class="sct_txt" style="padding-bottom:3px;border-bottom:1px solid #ececec">국민위장약 오타이산</div>
								<div class="sct_txt01" style="color:#888">말랑하고 탱글한 과육느낌 그대로!</div>
							</a>
						</li>
					</ul>
				</div>
			</div //-->
			<!-- } 상품진열 30 끝 
		</div //-->
		
    </div>
    <!--?php } ?-->


<!-- 
	<section class="tag_wrap">
		<header>
			<h2>인기 기획전</h2>
		</header>
		
		
	
		<div class="product">
			<div><a href="/shop/search.php?q=곤약 젤리"><img src="/img/main/imgJelly.jpg" alt="곤약 젤리파우치"></a></div>
			<div>
				<div style="background:#f1f0d2"><a href="/shop/search.php?q=샤론파스 Ae"><img src="/img/mobile/imgTag01.jpg" alt="샤론파스 Ae 140매 3개"></a></div>
				<div style="background:#d9ecfb"><a href="/shop/search.php?q=시세이도 센카 퍼펙트 휩"><img src="/img/mobile/imgTag02.jpg" alt="시세이도 센카 퍼펙트 휩 120g"></a></div>
				<div style="background:#e3fdf2"><a href="/shop/search.php?q=바몬드 카레"><img src="/img/mobile/imgTag03.jpg" alt="바몬드 카레 중간매운맛 12회분 230g"></a></div>
				<div style="background:#e9e3fb"><a href="/shop/search.php?q=놋케루 후리카게"><img src="/img/mobile/imgTag04.jpg" alt="놋케루 후리카게 매운 연어명태 100g"></a></div>
			</div>
		</div>
	</section> -->



	<!-- <div class="icon_btn jbMenu">
		<div>
			<a href="/shop/list.php?ca_id=4010"><img src="/img/main/iconTag01.png" alt=""><span>비타민/영양제</span></a>
			<a href="/shop/list.php?ca_id=4080"><img src="/img/main/iconTag02.png" alt=""><span>파스/통증</span></a>
			<a href="/shop/list.php?ca_id=4060"><img src="/img/main/iconTag03.png" alt=""><span>여성/두통/변비</span></a>
			<a href="/shop/list.php?ca_id=4050"><img src="/img/main/iconTag04.png" alt=""><span>장/소화</span></a>
			<a href="/shop/list.php?ca_id=4040"><img src="/img/main/iconTag05.png" alt=""><span>무좀</span></a>
			<a href="/shop/list.php?ca_id=4030"><img src="/img/main/iconTag06.png" alt=""><span>눈코입</span></a>
			<a href="/shop/list.php?ca_id=4020"><img src="/img/main/iconTag07.png" alt=""><span>어린이</span></a>
			<a href="/shop/list.php?ca_id=4070"><img src="/img/main/iconTag08.png" alt=""><span>피부</span></a>
			<a href="/shop/list.php?ca_id=5010"><img src="/img/main/iconTag09.png" alt=""><span>다이어트식품</span></a>
			<a href="/shop/list.php?ca_id=5020"><img src="/img/main/iconTag10.png" alt=""><span>건강식품</span></a>
			<a href="/shop/list.php?ca_id=60"><img src="/img/main/iconTag11.png" alt=""><span>뷰티용품</span></a>
			<a href="/shop/list.php?ca_id=70"><img src="/img/main/iconTag12.png" alt=""><span>식품/차/커피</span></a>
			<a href="/shop/list.php?ca_id=80"><img src="/img/main/iconTag13.png" alt=""><span>생활용품</span></a>
			<a href="/shop/list.php?ca_id=8010"><img src="/img/main/iconTag14.png" alt=""><span>주방용품</span></a>
			<a href="/shop/list.php?ca_id=8030"><img src="/img/main/iconTag15.png" alt=""><span>욕실용품</span></a>
		</div>
	</div> -->

    <?php if($default['de_mobile_type3_list_use']) { ?>
    <div class="sct_wrap">
        <header>
			<h2>월간 베스트상품</h2>
			<!-- <span>BEST ITEM</span> -->
		</header>

		<?php echo popular(); // 인기검색어, 테마의 스킨을 사용하려면 스킨을 theme/basic 과 같이 지정  ?>
        <?php
        $list = new item_list();
        $list->set_list_skin(G5_MSHOP_SKIN_PATH.'/main.type3.skin.php');
        $list->set_mobile(true);
        $list->set_type(3);
        $list->set_view('it_id', false);
        $list->set_view('it_name', true);
        $list->set_view('it_cust_price', true);
        $list->set_view('it_price', true);
        $list->set_view('it_icon', true);
		$list->set_view('star', true);
       // $list->set_view('sns', true);

	    if ($is_admin) {
			$list->set_isOnlyAdmin(1);
		}

        echo $list->run();
        ?>
        <a href="/shop/list.php?ca_id=20" ><button class="more">상품 더보기 <strong>+</strong></button></a>
    </div>
    <?php } ?>

<section id="best_item_use" class="sct_wrap" >
    <header>
        <h2><a href="<?php echo shop_type_url('2'); ?>">베스트 리뷰</a></h2>
    </header>

    <?php
    $list = new item_use_list();
    
    
    $list->set_list_mod(5);
    $list->set_list_row(2);
    $list->set_img_size(300,300);
    $list->set_list_skin(G5_MSHOP_SKIN_PATH.'/main_item_use.10.skin.php');

    $list->set_view('is_subject', true);
    $list->set_view('it_name', true);
    $list->set_view('it_basic', false);
    $list->set_view('it_cust_price', false);
    $list->set_view('it_price', false);
    $list->set_view('it_icon', false);
    $list->set_view('sns', false);
    $list->set_view('star', true);

    if ($is_admin) {
        $list->set_isOnlyAdmin(10);
    }

    echo $list->run();
    ?>

    <?php
        // $sql_common = " from `{$g5['g5_shop_item_use_table']}` a join `{$g5['g5_shop_item_table']}` b on (a.it_id=b.it_id) ";
        // $sql_search = " where a.is_confirm = '1' ";
        
        // $sst  = "a.is_id";
        // $sod = "desc";
        
        // $sql_order = " order by $sst $sod ";

        // $sql = " select count(*) as cnt
        //          $sql_common
        //          $sql_search
        //          $sql_order ";
        // $row = sql_fetch($sql);
        // $total_count = $row['cnt'];

        // $rows = $config['cf_page_rows'];
        // $total_page  = ceil($total_count / $rows);  // 전체 페이지 계산
        // if ($page < 1) { $page = 1; } // 페이지가 없으면 첫 페이지 (1 페이지)
        // $from_record = ($page - 1) * $rows; // 시작 열을 구함

        // $sql = " select *
        //           $sql_common
        //           $sql_search
        //           $sql_order
        //           limit $from_record, $rows ";
        // $result = sql_query($sql);

        // ob_start();
        // include(G5_PATH.'/skin/shop/basic/main.40.skin.php');
        // $content = ob_get_contents();
     //    ob_end_clean();
     //    echo $content;
    ?>
</section>
<!-- 에임드 시작 -->
<div id="aed_main_m2"></div>
<!-- 에임드 끝 -->

	<?php  echo display_banner('하단', 'boxbanner_foot.skin.php'); ?>


        <?php if($default['de_mobile_type4_list_use']) { ?>
    <div class="sct_wrap">
                <header>
                        <h2>추천상품</h2>
                </header>
       <!--  <h2><a href="<?php echo G5_SHOP_URL; ?>/listtype.php?type=2">추천상품</a></h2> -->
        <?php
        $list = new item_list();
        $list->set_mobile(true);
        $list->set_type(4);
        $list->set_view('it_id', false);
        $list->set_view('it_name', true);
        $list->set_view('it_cust_price', true);
        $list->set_view('it_price', true);
        $list->set_view('it_icon', true);
                $list->set_view('star', true);
       // $list->set_view('sns', true);

                if ($is_admin) {
                        $list->set_isOnlyAdmin(1);
                }
                echo $list->run();
        ?>
    </div>
<?php } ?>


	<?php if($default['de_mobile_type2_list_use']) { ?>
    <div class="sct_wrap">
		<header>
			<h2>신상품</h2>
		</header>
       <!--  <h2><a href="<?php echo G5_SHOP_URL; ?>/listtype.php?type=2">추천상품</a></h2> -->
        <?php
        $list = new item_list();
        $list->set_mobile(true);
        $list->set_type(2);
        $list->set_view('it_id', false);
        $list->set_view('it_name', true);
        $list->set_view('it_cust_price', true);
        $list->set_view('it_price', true);
        $list->set_view('it_icon', true);
		$list->set_view('star', true);
       // $list->set_view('sns', true);
        
		if ($is_admin) {
			$list->set_isOnlyAdmin(1);
		}
		echo $list->run();
        ?>
        <a href="/shop/list.php?ca_id=90" ><button class="more">상품 더보기 <strong>+</strong></button></a>
    </div>
<?php } ?>


<style>
	.sct_wrap button.more {
		display:block;
		margin-top: 20px;
		margin-left:auto;
		margin-right:auto;
		padding: 11px 40px 13px;
		color: #fff;
		font-size: 14.5px;
		line-height: 1;
		border: 0;
		border-radius: 30px;
		background: #636363;
	}
</style>

 <?php if($default['de_mobile_type1_list_use']) { ?>
    <div class="sct_wrap">
        <header>
			<h2>의약품</h2>
		</header>
        <?php
			$list = new item_list();
			$list->set_category('40',2);
			$list->set_list_mod(2);
			$list->set_list_row(5);
			$list->set_img_size(282, 282);
			$list->set_list_skin(G5_MSHOP_SKIN_PATH.'/list.10.skin.php');
			$list->set_view('it_img', true);
			$list->set_view('it_id', false);
			$list->set_view('it_name', true);
			$list->set_view('it_basic', true);
			$list->set_view('it_cust_price', false);
			$list->set_view('it_price', true);
			$list->set_view('it_icon', false);
			$list->set_view('star', true);
			$list->set_view('sns', false);
			if ($is_admin) {
				$list->set_isOnlyAdmin(1);
			}
			echo $list->run();
		?>
			<a href="/shop/list.php?ca_id=40"><button class="more">상품 더보기 <strong>+</strong></button></a>
    </div>
    <?php } ?>

	<?php if($default['de_mobile_type1_list_use']) { ?>
    <div class="sct_wrap">
        <header>
			<h2>뷰티용품</h2>
		</header>
        <?php
			$list = new item_list();
			$list->set_category('70',2);
			$list->set_list_mod(2);
			$list->set_list_row(5);
			$list->set_img_size(282, 282);
			$list->set_list_skin(G5_MSHOP_SKIN_PATH.'/list.10.skin.php');
			$list->set_view('it_img', true);
			$list->set_view('it_id', false);
			$list->set_view('it_name', true);
			$list->set_view('it_basic', true);
			$list->set_view('it_cust_price', false);
			$list->set_view('it_price', true);
			$list->set_view('it_icon', false);
			$list->set_view('star', true);
			$list->set_view('sns', false);
			if ($is_admin) {
				$list->set_isOnlyAdmin(1);
			}
			echo $list->run();
		?>
			<a href="/shop/list.php?ca_id=70"><button class="more">상품 더보기 <strong>+</strong></button></a>
    </div>
    <?php } ?>

    <?php if($default['de_mobile_type1_list_use']) { ?>
    <div class="sct_wrap">
        <header>
			<h2>식품</h2>
		</header>
        <?php
			$list = new item_list();
			$list->set_category('60',2);
			$list->set_list_mod(2);
			$list->set_list_row(5);
			$list->set_img_size(282, 282);
			$list->set_list_skin(G5_MSHOP_SKIN_PATH.'/list.10.skin.php');
			$list->set_view('it_img', true);
			$list->set_view('it_id', false);
			$list->set_view('it_name', true);
			$list->set_view('it_basic', true);
			$list->set_view('it_cust_price', false);
			$list->set_view('it_price', true);
			$list->set_view('it_icon', false);
			$list->set_view('star', true);
			$list->set_view('sns', false);
			if ($is_admin) {
				$list->set_isOnlyAdmin(1);
			}
			echo $list->run();
		?>
			<a href="/shop/list.php?ca_id=60"><button class="more">상품 더보기 <strong>+</strong></button></a>
    </div>
    <?php } ?>

	<?php if($default['de_mobile_type1_list_use']) { ?>
    <div class="sct_wrap">
        <header>
			<h2>생활용품</h2>
		</header>
        <?php
			$list = new item_list();
			$list->set_category('50',2);
			$list->set_list_mod(2);
			$list->set_list_row(5);
			$list->set_img_size(282, 282);
			$list->set_list_skin(G5_MSHOP_SKIN_PATH.'/list.10.skin.php');
			$list->set_view('it_img', true);
			$list->set_view('it_id', false);
			$list->set_view('it_name', true);
			$list->set_view('it_basic', true);
			$list->set_view('it_cust_price', false);
			$list->set_view('it_price', true);
			$list->set_view('it_icon', false);
			$list->set_view('star', true);
			$list->set_view('sns', false);
			if ($is_admin) {
				$list->set_isOnlyAdmin(1);
			}
			echo $list->run();
		?>
			<a href="/shop/list.php?ca_id=50"><button class="more">상품 더보기 <strong>+</strong></button></a>
    </div>
    <?php } ?>

<!--//
	<div class="banner pc">
		<a href="/shop/list.php?ca_id=10" style="background:#42a2ab"><img src="/img/mobile/imgEventMember.jpg" alt="회원특가 상품! 재팬데이 회원들께만 드려요!!"></a>
		<a href="/bbs/board.php?bo_table=notice&wr_id=1" style="background:#f5e54a"><img src="/img/mobile/imgEventCacao.jpg" alt="고객님께 돌려드리는 혜택. 카카오톡 친추하면 6,000원 쏩니다!"></a>
		<a href="<?php echo get_pretty_url('content', 'service'); ?>" style="background:#e6e6e6"><img src="/img/mobile/imgEventBuying.jpg" alt="해외직구의 모든 것! 재팬데이가 알려드려요."></a>
	</div>

//-->

	<?php //  echo display_banner('하단', 'boxbanner_foot.skin.php'); ?>

	<div class="icon_bottom">
		<a href="/bbs/board.php?bo_table=notice"><img src="/img/main/iconButton01_01.png" alt=""><span>공지사항</span></a>
		<a href="<?php echo get_pretty_url('content', 'service'); ?>"><img src="/img/main/iconButton01_02.png" alt=""><span>구매대행안내</span></a>
		<a href="<?php echo G5_BBS_URL ?>/faq.php"><img src="/img/main/iconButton01_03.png" alt=""><span>FAQ</span></a>
		<a href="/bbs/board.php?bo_table=qa"><img src="/img/main/iconButton01_04.png" alt=""><span>Q/A</span></a>
		<a href="<?php echo get_pretty_url('content', 'delivery'); ?>"><img src="/img/main/iconButton01_05.png" alt=""><span>배송비안내</span></a>
		<a href="<?php echo get_pretty_url('content', 'holiday'); ?>"><img src="/img/main/iconButton01_06.png" alt=""><span>일본 휴무일 안내</span></a>
		<a href="<?php echo get_pretty_url('content', 'rating'); ?>"><img src="/img/main/iconButton01_07.png" alt=""><span>회원등급혜택</span></a>
		<a href="/bbs/board.php?bo_table=unidentified"><img src="/img/main/iconButton01_08.png" alt=""><span>미확인입금내역</span></a>
	</div>



    <?php include_once(G5_MSHOP_SKIN_PATH.'/main.event.skin.php'); // 이벤트 ?>

    <!-- 커뮤니티 최신글 시작 { -->
    <!--section id="sidx_lat">
        <?php echo latest('shop_basic', 'notice', 3, 30); ?>
    </section-->

<!-- AD-POP SCRIPT / DO NOT ALTER THIS SCRIPT. -->
<!-- COPYRIGHT (C) THE A MEDIA INC. ALL RIGHTS RESERVED. -->
<iframe src='//script.theprimead.co.kr/winggoSetCookiePage.php?code=NDY0Ng%3D%3D&_NMNCODE_=' height='0' width='0'></iframe>
<!-- END OF AD-POP SCRIPT -->

<?php
include_once(G5_MSHOP_PATH.'/_tail.php');
?>