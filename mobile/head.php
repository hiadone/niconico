<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

if(defined('G5_THEME_PATH')) {
    require_once(G5_THEME_PATH.'/head.php');
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

<header id="hd">
    <?php if ((!$bo_table || $w == 's' ) && defined('_INDEX_')) { ?><h1><?php echo $config['cf_title'] ?></h1><?php } ?>

    <div id="skip_to_container"><a href="#container">본문 바로가기</a></div>

    <?php if(defined('_INDEX_')) { // index에서만 실행
        include G5_MOBILE_PATH.'/newwin.inc.php'; // 팝업레이어
    } ?>

    <div id="hd_wrapper">
        <div id="logo"><a href="<?php echo G5_SHOP_URL; ?>/"><img src="<?php echo G5_DATA_URL; ?>/common/mobile_logo_img" alt="<?php echo $config['cf_title']; ?> 메인"></a></div>
        <div id="hd_btn">
            <button type="button" id="btn_hdcate"><img src="/img/main/btnAllmenu_m.png" alt=""><span class="sound_only">분류</span></button>
            <!--button type="button" id="btn_hdsch"><i class="fa fa-search"></i><span class="sound_only">검색열기</span></button>
            <a href="<?php echo G5_SHOP_URL; ?>/mypage.php" id="btn_hduser"><i class="fa fa-user"></i><span class="sound_only">마이페이지</span></a-->
            <a href="<?php echo G5_SHOP_URL; ?>/cart.php" id="btn_hdcart"><img src="/img/main/imgCart.gif" alt=""><span class="sound_only">장바구니</span><span class="cart-count"><?php echo get_boxcart_datas_count(); ?></span></a>

        </div>
    </div>

    <form name="frmsearch1" action="<?php echo G5_SHOP_URL; ?>/search.php" onsubmit="return search_submit(this);">
    <aside id="hd_sch">
        <div class="sch_inner">
            <h2>상품 검색</h2>
            <label for="sch_str" class="sound_only">상품명<strong class="sound_only"> 필수</strong></label>
            <input type="text" name="q" value="<?php echo stripslashes(get_text(get_search_string($q))); ?>" id="sch_str" required class="frm_input" placeholder="검색어를 입력해주세요">
            <button type="submit" value="검색" class="sch_submit"><i class="fa fa-search" aria-hidden="true"></i></button>
        </div>
        <button type="button" class="btn_close"><i class="fa fa-times"></i><span class="sound_only">닫기</span></button>

    </aside>
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

    <?php include_once(G5_MSHOP_PATH.'/category.php'); // 분류 ?>


    <script>
    jQuery(function($){
        $( document ).ready( function() {
            
            function catetory_menu_fn( is_open ){
                var $cagegory = $("#category");

                if( is_open ){
                    $cagegory.show();
                    $("body").addClass("is_hidden");
                } else {
                    $cagegory.hide();
                    $("body").removeClass("is_hidden");
                }
            }

            $(document).on("click", "#btn_hdcate", function(e) {
                // 오픈
                catetory_menu_fn(1);
            }).on("click", ".menu_close", function(e) {
                // 숨김
                catetory_menu_fn(0);
            }).on("click", ".cate_bg", function(e) {
                // 숨김
                catetory_menu_fn(0);
            });

            $("#btn_hdsch").on("click", function() {
                $("#hd_sch").show();
            });

            $("#hd_sch .btn_close").on("click", function() {
                $("#hd_sch").hide();
            });
            
            //타이틀 영역고정
			/*
            var jbOffset = $( '#container').offset();
            $( window ).scroll( function() {
                if ( $( document ).scrollTop() > jbOffset.top ) {
                    $( '#container').addClass( 'fixed' );
                }
                else {
                    $( '#container').removeClass( 'fixed' );
                }
            });
			*/
        });
    });
   </script>
</header>
<?php
    $container_class = array();
    if( defined('G5_IS_COMMUNITY_PAGE') && G5_IS_COMMUNITY_PAGE ){
        $container_class[] = 'is_community';
    }
?>



<div id="wrapper">


<style>
	.gnb_2dli:nth-child(8),.gnb_2dli:nth-child(12) { font-size:11px; }
</style>
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
    <?php if (!defined("_INDEX_")) { ?>
    	<h2 id="container_title" class="top" title="<?php echo get_text($g5['title']); ?>">
    		<a href="javascript:history.back();"><i class="fa fa-chevron-left" aria-hidden="true"></i><span class="sound_only">뒤로가기</span></a> <?php echo get_head_title($g5['title']); ?>
    	</h2>
    <?php } ?>
